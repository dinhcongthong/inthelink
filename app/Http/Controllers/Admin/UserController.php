<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Models\Gallery;
use App\Models\InfluencerCommissionHistory;
use App\Models\Influencers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkAuthAdmin();
    }

    //users-influencers
    public function influencer()
    {
        return view('admin.users.influencer.index', $this->data);
    }

    // this function spend for all influencer's status
    public function influencerTable($status = 'all')
    {
        $influencer = Influencers::with(['getUser:id,user_name,mobile,email'])
            ->whereHas('getUser');
        if ($status == 'waiting') $influencer = $influencer->whereStatus(Influencers::WAITING);
        if ($status == 'accepted') $influencer = $influencer->whereStatus(Influencers::ACCEPTED);
        if ($status == 'declined') $influencer = $influencer->whereStatus(Influencers::DECLINED);
        $influencer = $influencer->get();

        $data = [];
        foreach ($influencer as $item) {
            $nested['id'] = $item->id;
            $nested['name'] = $item->getUser->user_name;
            $nested['phone_number'] = $item->getUser->mobile;
            $nested['email'] = $item->getUser->email;
            $nested['join_date'] = $item->created_at->format('Y-m-d');
            $nested['commission'] = $item->commission;
            $nested['status'] = $item->status;
            $nested['reason_block'] = $item->reason_block;
            $data[] = $nested;
        }
        return  Datatables::of($data)->make();
    }

    public function InfluencerDetail($id = 0)
    {
        $influencer = Influencers::with('getUser')->with('getHistorySale')->findOrFail($id);
        $product = Product::withTrashed()
            ->with(['getOrders' => function ($q) use ($influencer) {
                $q->select('id', 'product_id', 'product_name', 'updated_at')
                    ->where('influencer_id', $influencer->id)
                    ->orderBy('updated_at', 'desc');
            }])
            ->with('getCategory:id,name')
            ->whereHas('getOrders')
            ->with('getImgs')
            ->get(['id', 'name', 'category_id', 'price']);

        $this->data['product'] = $product;
        $this->data['influencer'] = $influencer;

        return view('admin.users.influencer.detail', $this->data);
    }

    public function influencerOrderTable(Request $request)
    {
        $order = Order::with('getCustomer:id,user_name')
            ->with(['getInfluencer:id,commission', 'getInfluencerHistory'])
            ->where('product_id', $request->product_id)
            ->where('influencer_id', $request->influencer_id)
            ->get(['id', 'user_id', 'influencer_id', 'profit', 'total_amount', 'quantity', 'created_at', 'product_id']);
        $data = [];
        foreach ($order as $item) {
            $nested['id'] = $item->id;
            $nested['customer'] = $item->getCustomer->user_name;
            $nested['quantity'] = $item->quantity;
            $nested['total_amount'] = $item->total_amount;
            $nested['commission_money'] = $item->getInfluencerHistory->commission_money;
            $nested['payment_date'] = $item->getInfluencerHistory->payment_date;
            $nested['commission'] = $item->getInfluencer->commission;
            $data[] = $nested;
        }
        return  Datatables::of($data)->make();
    }

    // when click accept button status is == 2
    // view detail will show save button if status = 1
    public function postInfluencerApproved(Request $request)
    {
        $id = $request->id;
        $influencer = Influencers::with('getUser:id,user_name')->findOrFail($id);
        $user = User::withTrashed()->find($influencer->getUser->id);

        try {
            if ($request->status != Influencers::ACCEPTED) {
                $user->update(['reason_block' => $request->reason_block]);
                User::withTrashed()->find($influencer->getUser->id)->delete();
            } else {
                $user->restore();
            }
            $influencer = $influencer->update([
                'commission' => $request->commission,
                'status' => $request->status,
                'reason_block' =>  $request->reason_block,
            ]);
            if ($influencer) {
                if ($request->status == Influencers::DECLINED) {
                    return response()->json([
                        'status' => $request->status,
                        'updated_at' => now()->format('Y-m-d'),
                        'reason' => $request->reason_block
                    ]);
                }
                return $request->status;
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing']);
        }
    }

    // influencer detail payment table
    public function influencerPaymentTable($influ_id = 0)
    {
        $order = Order::where('influencer_id', $influ_id)
            ->with(['getInfluencerHistory', 'getInfluencer'])
            ->get(['id', 'influencer_id', 'profit', 'total_amount', 'profit', 'updated_at', 'status']);
        $data = [];
        foreach ($order as $item) {
            $nested['id'] = $item->id;
            $nested['commission'] = $item->getInfluencerHistory->commission_money . ' (' . $item->getInfluencer->commission . '%)';
            $nested['total_amount'] = number_format($item->total_amount);
            $nested['payment_date'] = $item->getInfluencerHistory->payment_date ?? '0000-00-00 00:00';
            // if status == 1 ? completed : paynow
            $nested['order_status'] = $item->status;
            $nested['payment_status'] = $item->getInfluencerHistory->status;
            $data[] = $nested;
        }

        return Datatables::of($data)->make();
    }

    public function postInfluencerPaymentStatus(Request $request)
    {
        $order_id = $request->orderId;
        $status = $request->status;
        $influencer_id = $request->influencer_id;
        try {
            $history = InfluencerCommissionHistory::whereOrderId($order_id)
                ->whereInfluencerId($influencer_id)
                ->firstOrFail();

            if ($status == InfluencerCommissionHistory::COMPLETED_STATUS) {
                $history = $history->update(['status' => $status, 'payment_date' => now()->format('Y-m-d H:i:s')]);
                $payment_date = now()->format('Y-m-d H:i:s');
            } else {
                $history = $history->update(['status' => $status]);
                $payment_date = '0000-00-00 00:00';
            }
            if ($history) {
                return response()->json([
                    'status' => $status,
                    'payment_date' =>  $payment_date
                ]);
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing']);
        }
    }

    //users-manage
    public function ManageUsers()
    {
        return view('admin.users.manage.index', $this->data);
    }

    // this function user for all user and user was blocked depend on action
    public function userTables($action = 'index')
    {
        $user = User::withTrashed()->with('influencer:id,user_id');
        if ($action != 'index') {
            $user = $user->where('deleted_at', '!=', null);
        }

        $user = $user->get();
        
        $data = [];
        foreach ($user as $user) {
            $nested['id'] = $user->id;
            if ($user->user_type == 'influencer') {
                $nested['influencer_id'] = $user->influencer->id;
            }
            $nested['user_name'] = $user->user_name;
            $nested['phone'] = $user->mobile;
            $nested['email'] = $user->email;
            $nested['gender'] = GENDER[$user->gender];
            $nested['reason_block'] = $user->reason_block;
            $nested['join_date'] = $user->created_at->format('Y-m-d');
            $nested['level'] = $user->user_type;
            $nested['active'] = !is_null($user->deleted_at) ? false : true;
            $data[] = $nested;
        }
        
        return  Datatables::of($data)->make();
    }

    public function postChangeRole(Request $request)
    {
        $id = $request->id;
        $role = USER_ROLES[$request->role];
        try {
            $user = User::withTrashed()->findOrFail($id)->update(['user_type' => $role]);
            return 1;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing']);
        }
    }

    public function postUpdateStatus(Request $request)
    {
        $id = $request->id;

        $status = 0;
        $user = User::withTrashed()->findOrFail($id);

        try {
            if ($user->trashed()) {
                $user->restore();
                $status = 1;
            } else {
                if ($user->user_type == 'influencer') {
                    Influencers::whereUserId($user->id)->first()->update(['status' => Influencers::DECLINED]);
                }
                $user->update(['reason_block' => $request->reason_block, 'deleted_at' => now()]);
            }
            return response()->json(['status' => $status]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing']);
        }
    }

    //users-blocklist
    public function Blocklist()
    {
        return view('admin.users.block.index', $this->data);
    }

    public function postChangeCommissionPercent(Request $request)
    {
        try {
            $influencer_id = Influencers::findOrFail($request->influencer_id)->update(['commission' => $request->commission]);
            return 1;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing']);
        }
    }

    public function CustomerDetail($id = 0)
    {
        $user = User::withTrashed()->with('getAvatar')->findOrFail($id, ['id', 'user_name', 'email', 'mobile', 'gender', 'birthday']);
        $this->data['user'] = $user;
        return view('admin.users.manage.customer', $this->data);
    }
}
