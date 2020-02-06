<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Models\Categories;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkAuthAdmin();
    }
    public function getChilds(Request $request)
    {
        $parent_id = $request->id;

        $category = Categories::withTrashed()->with('getChilds')->findOrFail($parent_id);
        return $category->getChilds;
    }

    public function index()
    {
        return view('admin.ecommerce.category.index', $this->data);
    }

    public function overViewTable()
    {
        $category = Categories::withTrashed()->with('getChilds')->get(['id', 'name', 'updated_at', 'deleted_at']);
        $data = [];
        foreach ($category as $cate) {
            $nested['id'] = $cate->id;
            $nested['name'] = $cate->name;
            $nested['is_show'] = !is_null($cate->deleted_at) ? false : true;
            $nested['updated_at'] = $cate->updated_at->format('Y-m-d H:i:s');
            $data[] = $nested;
        }
        return Datatables::of($data)->make();
        // return \response()->json(['data' => $data]);
    }
    public function detail($id = 0)
    {
        $this->data['id'] = $id;
        return view('admin.ecommerce.category.detail', $this->data);
    }

    // pending
    public function loadDetailTable(Request $request)
    {
    }

    // pending
    public function subDetail()
    {
    }

    public function subIndex()
    {
        return view('admin.ecommerce.category.sub-index', $this->data);
    }

    public function loadSubTables()
    {
        $sub_category = Categories::withTrashed()
            ->where('parent_id', '<>', Categories::PARENTS_ID)
            ->whereHas('getParent')
            ->with('getParent')->get();
        $data = [];
        foreach ($sub_category as $sub) {
            $nested['id'] = $sub->id;
            $nested['name'] = $sub->name;
            $nested['parent_name'] = $sub->getParent->name;
            $nested['is_show'] = !is_null($sub->deleted_at) ? false : true;
            $nested['updated_at'] = $sub->updated_at->format('Y-m-d H:i:s');
            $data[] = $nested;
        }

        return Datatables::of($data)->make();
    }
    public function getUpdate($id = 0)
    {
        $category = Categories::findOrNew($id);

        $this->data['parent_list'] = Categories::whereParentId(0)->get(['id', 'name']);
        $this->data['category'] = $category;
        return view('admin.ecommerce.category.update', $this->data);
    }

    public function postUpdate(Request $request, $id = 0)
    {
        try {
            $category = Categories::findOrNew($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->parent_id = $request->parent_id ?? Categories::PARENTS_ID;
            $category->save();

            if ($request->show == 0) {
                $category->delete();
            }
            return redirect()->route('admin.ecommerce.category.index');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return \back()->withInput()->withErrors(['Errors' => 'Have errors when proccessing!']);
        }
    }

    // pending
    public function CategoryLastProducts()
    {
        return view('admin.ecommerce.category.index-products', $this->data);
    }

    // pending
    public function CategoryProduct()
    {
        return view('admin.ecommerce.category.product', $this->data);
    }
}
