<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class SellerController extends Controller
{   

    protected $seller;

    function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $this->seller = Auth::user()->seller;
        //     if (!$this->seller) {
        //         return abort(403);
        //     }
        //     return $next($request);
        // });
    }
    public function posts()
    {
        if (request()->has('filter') && request('filter') != '' ) {
            $posts = Posts::where('title',request('filter'))->paginate(5);
        }else{
            $posts = Posts::paginate(5);
        }
        $response = [
            'total' => $posts->total(),
            'per_page' => $posts->perPage(),
            'current_page' => $posts->currentPage(),
            'last_page' => $posts->lastPage(),
            'from' => $posts->firstItem(),
            'to' => $posts->lastItem(),
            'data' => $posts->toArray()['data']
        ];
        return response()->json($response);
        
    }

    /* home */
    public function Overview()
    {   
        return view('seller/overview'); 
    }

    /* product */
    public function Products()
    {
        return view('seller/product/index');    
    }
    public function Products_create()
    {
        $categories = Categories::where('parent_id',0)->get();
        return view('seller/product/product_create',['categories' => $categories]);    
    }


    /* shop */
    public function Shop()
    {
        return view('seller/shop/index');    
    }

    /* Orders */
    public function Orders()
    {
        return view('seller/order/index');
    }

    /* bank */
    public function Bank()
    {
        return view('seller/bank/index');    
    }

    /* categories */
    public function Categories(Request $request)
    {
        $categories = Categories::where('parent_id',$request->p_id)->get();
        return response()->json(['categories'=> $categories]);
    }
}