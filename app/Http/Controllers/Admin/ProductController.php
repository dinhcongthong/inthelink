<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\Categories;
use App\Models\Gallery;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkAuthAdmin();
    }
    
    public function index()
    {
        return view('admin.ecommerce.product.index', $this->data);
    }

    public function loadDataTable(Request $request)
    {
        $product_list = Product::withTrashed()
            ->with(['getAuthor:id,user_name', 'getCategory:id,name'])
            ->orderBy('created_at', 'desc')
            ->get([
                'id', 'name', 'author_id', 'price', 'inthelink_commission', 'category_id', 'updated_at'
            ]);


        $data = [];
        foreach ($product_list as $product) {
            $nested['id'] = $product->id;
            $nested['name'] = $product->name;
            $nested['price'] = $product->price;
            $nested['inthelink_commission'] = $product->inthelink_commission;
            $nested['category'] = $product->getCategory->name;
            $nested['author'] = $product->getAuthor->user_name;
            $nested['updated_at'] = $product->updated_at->format('Y-m-d H:i:s');
            $data[] = $nested;
        }

        return Datatables::of($data)->make();
    }

    public function getUpdate($id = 0)
    {
        $category = Categories::all();
        $product = Product::withCount('getImgs')->with('getImgs')->with('getCategory')->findOrNew($id);

        $product->name              = old('name') ?? $product->name;
        $product->price             = old('price') ?? $product->price;
        $product->description       = old('description') ?? $product->description;
        $product->brand             = old('brand') ?? $product->brand;
        // $product->category_id       = old('category_id') ?? $product->category_id;
        $product->seller_info       = old('seller_info') ?? $product->seller_info;
        $product->weight            = old('weight') ?? $product->weight;
        $product->width             = old('width') ?? $product->width;
        $product->height            = old('height') ?? $product->height;
        $product->length            = old('length') ?? $product->length;

        $this->data['category'] = $category;
        $this->data['product'] = $product;
        // return $product;
        return view('admin.ecommerce.product.update', $this->data);
    }

    public function postUpdate(ProductRequest $request, $id = 0)
    {
        // return $request->all();
        $data = $request->except('_token');
        if ($request->has('sub_category_id')) {
            $data['category_id'] = $data['sub_category_id'];
            unset($data['sub_category_id']);
        }

        $data['author_id'] = Auth::user()->id;

        try {
            if ($id != 0) {
                $product = Product::with('getImgs')->findOrFail($id);
                // delete old images
                // if action = update delete all old images
                foreach ($product->getImgs as $item) {
                    if ($request->hasFile('image1') && $item->target_type == 1) {
                        Gallery::deleteImages(Product::PRODUCT_DIR, $item->id);
                    }
                    if ($request->hasFile('image2') && $item->target_type == 2) {
                        Gallery::deleteImages(Product::PRODUCT_DIR, $item->id);
                    }
                    if ($request->hasFile('image3') && $item->target_type == 3) {
                        Gallery::deleteImages(Product::PRODUCT_DIR, $item->id);
                    }
                }
                $product = $product->update($data);
            } else {
                $product = Product::create($data);
                $id = $product->id;
            }

            $gallery_main_id = Gallery::uploadImages(Product::PRODUCT_DIR, array($request->main_image), 0, $id);
            $gallery_img_1_id = Gallery::uploadImages(Product::PRODUCT_DIR, array($request->image1), 1, $id);
            $gallery_img_2_id = Gallery::uploadImages(Product::PRODUCT_DIR, array($request->image2), 2, $id);
            $gallery_img_3_id = Gallery::uploadImages(Product::PRODUCT_DIR, array($request->image3), 3, $id);

            return redirect()->route('admin.ecommerce.product.index', ['success' => true]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing!']);
        }
    }

    public function ProductDetail($id = 0)
    {
        $product = Product::withTrashed()->with('getImgs')->find($id);
        $this->data['product'] = $product;
        return view('admin.ecommerce.product.detail', $this->data);
    }

    public function postAction(Request $request, $id = 0)
    {
        try {
            $product = Product::withTrashed()->findOrFail($id, ['id', 'deleted_at'])
                ->update(['deleted_at' => $request->action == 0 ? now() : null]);
            return back();
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing!']);
        }
    }
}
