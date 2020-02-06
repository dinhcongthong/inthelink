<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CheckoutRequest;
use App\Models\DeliveryAddress;
use App\Models\DeliveryUnit;
use App\Models\InfluencerCommissionHistory;
use App\Models\Influencers;
use App\Models\InthelinkInfo;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductEvaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    protected $customer;

    function __construct()
    {
        parent::__construct();
        $this->checkAuthUserPage('customer');
        $this->data['inthelink'] = InthelinkInfo::first();
    }

    public function getCheckout(Request $request)
    {
        $id = $request->id;
        $address = DeliveryAddress::whereUserId(Auth::user()->id)->whereSetDefault(DeliveryAddress::SET_DEFAULT)->first();

        $product = Product::with('getImgs')->find($id, ['id', 'name', 'price']);

        $this->data['product'] = $product;
        $this->data['address'] = $address;
        $this->data['quantity'] = $request->quantity;
        $this->data['delivery_unit'] = DeliveryUnit::all();

        return view('customer.checkout.index', $this->data);
    }

    public function postPaymentMomo(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $partnerCode = config('api_momo_key.partnerCode');
        $accessKey = config('api_momo_key.accessKey');
        $secretKey = config('api_momo_key.secretKey');
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->total_amount;
        $orderId = $request->orderId;
        $returnUrl = route('customer.ordered');
        $notifyurl = route('customer.ordered');
        // $returnUrl = "http://localhost:8000/paymomo/result.php";
        // $notifyurl = "http://localhost:81/payment/php/PayMoMo/ipn_momo.php";

        // supplier info
        $extraData = "merchantName=Inthelink";

        $requestId = time() . "";
        $requestType = "captureMoMoWallet";
        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        $result = execPostRequest($endpoint, \json_encode($data));
        $jsonResult = json_decode($result, true);

        if ($jsonResult['errorCode'] == 4) {
            return $jsonResult['message'];
        }

        return redirect($jsonResult['payUrl']);
    }

    public function postCheckout(CheckoutRequest $request)
    {
        // delivery fee = 20 000 VND
        $product = Product::with('getCategory:id,name')->with('getImgs')->findOrFail($request->product_id);
        $delivery_fee = 20000;
        $total = $request->total;
        $price = $product->price;
        $quantity = $request->quantity;

        // calculate money
        $influencer_id = $request->influencer_id;
        $influencer_commission = Influencers::findOrFail($influencer_id, ['id', 'commission'])->commission;
        $influencer_commission_money = round(($total * $influencer_commission) / 100, 0, PHP_ROUND_HALF_UP);

        $delivery_unit = DeliveryUnit::findOrFail($request->delivery_unit_id)->name;

        // inthelink profit
        $profit = round(($price * $quantity * $product->inthelink_commission) - ($price * $quantity * $influencer_commission) - $delivery_fee, 0, PHP_ROUND_HALF_UP);

        if (\PAYMENT_METHOD[$request->payment_method] == 'Momo' && $total > 10000000) {
            return back()->withInput()->withErrors(['errors' => 'Sorry Momo can not proccess with amount > 10,000,000']);
        }

        $data = [
            'user_id' => $this->user->id,
            'influencer_id' => $influencer_id,
            'product_id' => $request->product_id,
            'delivery_addr' => $request->delivery_addr,
            'delivery_unit' => $delivery_unit,
            'person_incharge' => $request->person_incharge,
            'phone_incharge' => $request->phone_incharge,
            'product_name' => $product->name,
            'category_name' => $product->getCategory->name,
            'price' => $price,
            'quantity' => $quantity,
            'total_amount' => $total,
            'profit' => $profit,
            // default payment method is banking
            'payment_method' => $request->payment_method,
            'note' => $request->note,
            'date_receive_est' => $request->date_est
        ];

        DB::beginTransaction();
        try {
            $order = Order::create($data);
            $commission_history_data = [
                'influencer_id' => $influencer_id,
                'commission_money' => $influencer_commission_money,
                'order_id' => $order->id
            ];
            if ($influencer_commission_money > 0) {
                $commission_history = InfluencerCommissionHistory::create($commission_history_data);
            }

            // save address info
            if ($request->has('save_addr_info')) {
                $address = DeliveryAddress::updateOrCreate(
                    ['user_id' => $this->user->id],
                    [
                        'name' => $request->person_incharge,
                        'address' => $request->delivery_addr,
                        'phone' => $request->phone_incharge
                    ]
                );
            }
            DB::commit();

            return \redirect()->route('customer.ordered')->with(['status' => 'You just ordered successful!']);
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());
            return \back()->withInput()->withErrors(['errors' => 'Have errors when proccessing!']);
        }
    }

    public function getOrdered(Request $request)
    {
        // update payment status if momo pay was successful
        if ($request->has('errorCode')) {
            if ($request->errorCode == '0') {
                try {
                    Order::findOrFail($request->orderId)->update(['payment_status' => Order::PAID]);
                    return redirect()->route('customer.ordered')->with(['status' => '#' . $request->orderId . '. Your order just paid by momo was successful!']);
                } catch (\Exception $ex) {
                    Log::error($ex->getMessage());
                    return back()->withErrors(['errors' => 'Have errors when proccessing']);
                }
            } else {
                return back()->withErrors(['errors' => 'Have errors when payment momo']);
            }
        }

        // getOrder data
        $ordered = Order::with(['getProduct'])
            ->with('getEvaluation:id')
            ->whereUserId($this->user->id);

        $status = $request->status;
        $statusArr = [
            'pending' => 0,
            'confirmed' => 1,
            'on-going' => 2,
            'delivered' => 3,
            'cancelled' => 4
        ];

        if (!is_null($status)) {
            $ordered = $ordered->whereStatus($statusArr[$status]);
        }
        
        $ordered = $ordered->orderBy('created_at', 'desc')->paginate(10)->setPath(route('customer.ordered', ['status' => $status]));
        $this->data['ordered'] = $ordered;

        return view('customer.order.index', $this->data);
    }

    public function postCancelOrder(Request $request, $id)
    {
        try {
            $order = Order::with('getInfluencerHistory')->findOrFail($id);

            $influencerHistory = InfluencerCommissionHistory::findOrFail($order->getInfluencerHistory->id)->update([
                'status' => InfluencerCommissionHistory::CANCELLED_STATUS,
                'commission_money' => 0
            ]);
            $order = $order->update(['status' => Order::CANCELLED_STATUS]);
            return 1;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function postEvaluation(Request $request)
    {
        $order_id = $request->orderId;
        $data = [
            'user_id' => $this->user->id,
            'product_id' => $request->productId,
            'content' => $request->content,
            'stars_number' => $request->starRate
        ];
        try {
            $productEvaluation = ProductEvaluation::create($data);
            $order = Order::findOrFail($order_id)->update(['evaluation_id' => $productEvaluation->id, 'status' => Order::DELIVERED_STATUS]);
            return 1;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return 0;
        }
    }

    public function orderDetail($id = 0)
    {
        $order = Order::with(['getProduct' => function ($q) {
            $q->select('id', 'name')->withTrashed()->with(['getImgs', 'getMainImg']);
        }])
            ->whereUserId($this->user->id)
            ->findOrFail($id);

        $this->data['order'] = $order;
        return view('customer.order.detail', $this->data);
    }

    public function getProfile()
    {
        return view('customer.profile.index', $this->data);
    }

    // pending
    public function loadAccNumber(Request $request)
    {
        $fields_method = ['bank_info', 'momo_info', 'zalopay_info'];
        $payment_method = $fields_method[$request->payment_method];
        $inthelink = InthelinkInfo::first(['momo_info', 'zalopay_info', 'bank_info'])[$payment_method];
        return $inthelink;
    }

    // pending
    public function addressSetDefault(Request $request)
    {
        $delivery_id = $request->deliveryId;

        $delivery = DeliveryAddress::findOrFail($delivery_id);
        $updateFalse = DeliveryAddress::whereUserId($delivery->user_id)->update(['set_default' => false]);

        $setDefault = $delivery->update(['set_default' => true]);
        if (!$setDefault) {
            return \response()->json([
                'status' => 500,
                'result' => 'Have errors when proccessing!'
            ]);
        }

        $this->Address();

        return \response()->json([
            'status' => 200,
            'view' => view('customer.addresses.render', $this->data)->render(),
            'result' => 'Update Delivery was successful!'
        ]);
    }

    // pending
    public function postAddress(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|max:19',
            'address' => 'required',
        ]);
        // id, pageName
        $data = [
            'name' => $request->name,
            'set_default' => $request->default,
            'user_id' => $this->user->id,
            'id' => $request->id,
            'address' => $request->address,
            'phone' => $request->phone
        ];

        $type = is_null($data['id']) ? 'new' : 'edit';

        try {
            // change data type
            if ($data['set_default'] == "true") {
                $updateFalse = DeliveryAddress::whereUserId($this->user->id)->update(['set_default' => false]);
                $data['set_default'] = true;
            } else {
                $data['set_default'] = false;
            }

            if ($type == 'edit') {
                $delivery = DeliveryAddress::whereId($request->id)->update($data);
            } else {
                $delivery = DeliveryAddress::create($data);
                if (DeliveryAddress::whereUserId($this->user->id)->count() == 1) {
                    DeliveryAddress::find($delivery->id)->update(['set_default' => true]);
                }
            }
            // set data for view
            $this->Address();

            return \response()->json([
                'status' => 200,
                'type' => $type,
                'view' => view('customer.addresses.render', $this->data)->render()
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return \response()->json(['status' => 500, 'result' => 'Have errors when proccessing!']);
        }
    }

    public function Address()
    {
        $address = DeliveryAddress::whereUserId($this->user->id)->get();
        $this->data['address'] = $address;
        return view('customer.addresses.index', $this->data);
    }

    public function deleteAddress(Request $request)
    {
        try {
            $delivery = DeliveryAddress::whereUserId($this->user->id)->findOrFail($request->id)->delete();
            $check_default = DeliveryAddress::whereUserId($this->user->id)->where('set_default', true)->first();
            if (is_null($check_default)) {
                $set_default_first = DeliveryAddress::whereUserId($this->user->id)->first()->update(['set_default' => true]);
            }

            $this->Address();

            return \response()->json([
                'status' => 200,
                'view' => view('customer.addresses.render', $this->data)->render(),
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
