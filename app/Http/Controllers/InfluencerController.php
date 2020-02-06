<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Categories;
use App\Models\Gallery;
use App\Models\Influencers;
use App\Models\Product;
use App\Models\ProductSelected;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;

class InfluencerController extends Controller
{
    protected $user;

    function __construct()
    {
        parent::__construct();
        $this->checkAuthUserPage('influencer');
    }

    private function getInfluencer($getUser = false)
    {
        $this->data['user'] = $this->user;

        $influencer = Influencers::where('user_id', Auth::user()->id);

        if ($getUser) {
            $influencer = $influencer->with(['getUser:id,user_name,mobile,email,birthday', 'getIdentityFontThumb', 'getIdentityBackThumb'])
            ->has('getUser');
        }

        return $influencer->firstOrFail();
    }

    private function checkCategoryChilds($product, $filter)
    {
        if (($filter)) {
            $category_ids = Categories::where('parent_id', $filter)->pluck('id')->toArray();
            if (!empty($category_ids)) {
                $product = $product->whereIn('category_id', $category_ids);
            } else {
                $product = $product->where('category_id', $filter);
            }
        }
    }

    public function products(Request $request)
    {
        $key = strrpos($request->category, '-');
        $product_filter = substr($request->category, $key + 1);

        $keyword = $request->keyword;

        $product_list = Product::with(['getCategory:id,name,parent_id'])
            ->withCount('getEvaluations')
            ->has('getCategory');

        if (!is_null($keyword)) {
            $product_list = $product_list->where('name', 'like', "{$keyword}%");
        }

        $this->checkCategoryChilds($product_list, $product_filter);

        $product_list = $product_list
            ->with(['getImgs'])
            ->has('getImgs')
            ->orderBy('updated_at', 'desc')
            ->paginate(15)->setPath(route('influencer.products', ['category' => $request->category]));

            // return $product_list;
            
        $category_list = Categories::withCount('getProducts')->where('parent_id', Categories::PARENTS_ID)
            ->with(['getChilds' => function ($q) {
                $q->withCount('getProducts');
            }])
            ->orderBy('order', 'asc')
            ->get();

        // set product count
        foreach ($category_list as $key => $item) {
            $count = $item->get_products_count;
            foreach ($item->getChilds as $child) {
                $count = $count + $child->get_products_count;
            }
            $category_list[$key]['parents_products_count'] = $count;
        }

        $this->data['product_list'] = $product_list;
        $this->data['category_list'] = $category_list;
        $product_filter = $product_filter ? $product_filter : 0;
        $this->data['category_selected'] = optional(Categories::find($product_filter, ['id', 'name']))->name;

        $this->data['influencer_id'] = Influencers::whereUserId($this->user->id)->first('id')->id;
        return view('influencer.product.index', $this->data);
    }

    public function getSelected()
    {
        $selected_list = ProductSelected::whereUserId(Auth::user()->id)
            ->with(['getProduct' => function ($q) {
                $q->select('id', 'name', 'category_id', 'description', 'price')
                    ->with(['getMainImg', 'getCategory:id,name']);
            }])
            ->orderBy('updated_at', 'desc')
            ->get();

        $this->data['selected_list'] = $selected_list;
        $this->data['influencer_id'] = Influencers::whereUserId($this->user->id)->first('id')->id;

        return view('influencer.selected.index', $this->data);
    }

    public function updateSelected(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId
        ];

        $productionSelected = ProductSelected::whereProductId($data['product_id'])
            ->whereUserId($data['user_id'])
            ->first();

        $result = 0;
        try {
            if (is_null($productionSelected)) {
                ProductSelected::create($data);
                $result = 1;
            } else {
                $productionSelected->delete();
            }

            return \response()->json([
                'result' => $result,
                'status' => 1
            ]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function sellHistory()
    {
        return view('influencer.sell-history.index', $this->data);
    }

    public function sellHistoryTable(Request $request)
    {
        $influencer = Influencers::whereUserId($this->user->id)->first();

        $product_sold = Product::withTrashed()
            ->with(['getOrders' => function ($q) use ($influencer) {
                $q->select('id', 'user_id', 'influencer_id', 'product_id', 'quantity', 'product_name', 'created_at', 'status', 'total_amount')
                    ->with(['getCustomer:id,user_name,mobile'])
                    ->with('getInfluencer:id,commission')
                    ->with('getInfluencerHistory:id,order_id,commission_money,status,payment_date')
                    ->has('getInfluencerHistory')
                    ->whereInfluencerId($influencer->id)
                    ->orderBy('updated_at', 'desc');
            }])
            ->withCount('getOrders')
            ->whereHas('getOrders')
            ->with('getImgs')
            ->get(['id', 'name']);

        $data = [];
        foreach ($product_sold as $product) {
            if ($product->get_orders_count > 0) {
                $nested['product_name'] = $product->name;
                foreach ($product->getOrders as $key => $order) {
                    $nested['order_id'] = $order->id;
                    $nested['customer'] = $order->getCustomer->user_name;
                    $nested['phone'] = $order->getCustomer->mobile;
                    $nested['quantity'] = $order->quantity;
                    $nested['sold_date'] = $order->created_at->format('Y-m-d');
                    $nested['order_status'] = $order->status;
                    $nested['total_amount'] = number_format($order->total_amount) . ' VND';
                    $nested['commission'] = number_format($order->getInfluencerHistory->commission_money) . ' VND' . ' (' . $order->getInfluencer->commission . '%)';
                    $nested['payment_status'] = $order->getInfluencerHistory->status;
                    $nested['payment_date'] = $order->getInfluencerHistory->payment_date ?? '0000-00-00 00:00';
                    $data[] = $nested;
                }
            }
        }

        return  Datatables::of($data)->make();
        // return $data;
    }

    public function profile(Request $request)
    {
        $influencer = $this->getInfluencer(true);
        $this->data['user'] = $this->user;
        $this->data['influencer'] = $influencer;
        return view('influencer.profile.index', $this->data);
    }
}
