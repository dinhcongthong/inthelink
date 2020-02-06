<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Models\InfluencerCommissionHistory;
use App\Models\InthelinkInfo;
use App\Models\Order;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkAuthAdmin();
    }

    //ecommerce-orderstatus
    public function OrderStatus()
    {
        return view('admin.order_status.index', $this->data);
    }

    public function OrderStatusTables(Request $request, $action = 'all')
    {
        $start_date = $request->startDate;
        $end_date = $request->endDate;

        $order = Order::withTrashed()->with('getCustomer:id,user_name');
        if (!\is_null($start_date) && !\is_null($end_date)) $order = $order->whereDate('created_at', '<=', $end_date)->whereDate('created_at', '>=', $start_date);
        if ($action == 'pending') $order = $order->whereStatus(Order::PENDING_STATUS);
        if ($action == 'confirmed') $order = $order->whereStatus(Order::CONFIRMED_STATUS);
        if ($action == 'on-going') $order = $order->whereStatus(Order::ON_GOING_STATUS);
        if ($action == 'delivered') $order = $order->whereStatus(Order::DELIVERED_STATUS);
        if ($action == 'cancelled') $order = $order->whereStatus(Order::CANCELLED_STATUS);
        $order = $order->get(['id', 'user_id', 'product_name', 'created_at', 'total_amount', 'payment_method', 'status', 'updated_at']);
        $data = [];
        foreach ($order as $item) {
            $nested['id'] = $item->id;
            $nested['customer'] = $item->getCustomer->user_name;
            $nested['product_name'] = $item->product_name;
            $nested['order_date'] = $item->created_at->format('Y-m-d');
            $nested['total'] = number_format($item->total_amount);
            $nested['payment_method'] = $item->payment_method;
            $nested['status'] = $item->status;
            $nested['updated_at'] = $item->updated_at->format('Y-m-d H:i:s');
            $data[] = $nested;
        }

        return Datatables::of($data)->make();
    }

    public function postUpdateOrderStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        try {
            $order = Order::withTrashed()->findOrFail($id);
            if ($status == Order::CANCELLED_STATUS) {
                $payment_status = InfluencerCommissionHistory::whereOrderId($order->id)->first()->update([
                    'status' => InfluencerCommissionHistory::CANCELLED_STATUS,
                    'commission' => 0
                ]);
            }
            $order = $order->update(['status' => $status]);
            return response()->json([
                'status' => \ORDER_STATUS[$status],
                'updated_at' => now()->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return \back()->withInput()->withErrors(['Errors' => 'Have errors when proccessing!']);
        }
    }

    //payment-influencer
    public function influencer()
    {
        return view('admin.payment.influencer', $this->data);
    }
    
    public function influencerDetail($order_id = 0)
    {
        $order = Order::withTrashed()
            ->with('getCustomer')
            ->with('getInfluencer')
            ->with('getInfluencerHistory')
            ->findOrFail($order_id);
        $this->data['order'] = $order;
        $this->data['inthelink'] = InthelinkInfo::first();
        return view('admin.payment.influencer-detail', $this->data);
    }

    public function revenue()
    {
        return view('admin.payment.revenue', $this->data);
    }

    // use for influencer and revenue. Depend on action
    public function revenueTables(Request $request, $action = 'revenue')
    {
        $start_date = $request->startDate;
        $end_date = $request->endDate;

        $order = Order::withTrashed()->with(['getInfluencer' => function ($q) {
            $q->with('getUser:id,user_name')->select('id', 'user_id', 'commission');
        }])
            ->whereHas('getInfluencer')
            ->whereHas('getCustomer');
        if ($action != 'revenue') {
            $order = $order->with('getInfluencerHistory')->whereHas('getInfluencerHistory');
        }
        // filter by daterangepicker for revenue
        if (!\is_null($start_date) && !\is_null($end_date)) {
            $order = $order->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        }
        $order = $order->get(['id', 'product_name', 'influencer_id', 'user_id', 'profit', 'created_at', 'total_amount', 'status']);
        $data = [];
        foreach ($order as $item) {
            $nested['order_id'] = $item->id;
            $nested['commission'] = $item->getInfluencer->commission;
            $nested['customer'] = $item->getCustomer->user_name;
            $nested['order_date'] = $item->created_at->format('Y-m-d H:i:s');
            $nested['total_amount'] = number_format($item->total_amount);
            if ($action != 'revenue') {
                $nested['order_status'] = $item->status;
                $nested['payment_status'] = $item->getInfluencerHistory->status;
                $nested['payment_date'] = $item->getInfluencerHistory->payment_date ?? '0000-00-00 00:00';
                $nested['influencer'] = $item->getInfluencer->getUser->user_name;
                $nested['influencer_id'] = $item->getInfluencer->id;
                $nested['profit'] = $item->getInfluencerHistory->commission_money;
            } else {
                $nested['order_status'] = ORDER_STATUS[$item->status];
                $nested['profit'] = $item->profit;
                $nested['product'] = $item->product_name;
            }
            $data[] = $nested;
        }

        return Datatables::of($data)->make();
    }
}
