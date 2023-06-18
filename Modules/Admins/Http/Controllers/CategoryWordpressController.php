<?php

namespace Modules\Admins\Http\Controllers;

use App\Model\CategoryWp;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

class CategoryWordpressController extends Controller
{
    public function index()
    {
        $categories = CategoryWp::latest()->get();

        return view("admins::category_wordpress.index", [
            'categories' => $categories
        ]);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $category = CategoryWp::find($id);
            CategoryWp::where("parent_id", $id)->update(["parent_id" => 0]);
            $category->delete();
            DB::commit();

            return back()->with("success", "Xóa thành công");
        } catch (\Throwable $th) {
            DB::rollback();

            return back()->with("error", "Vui lòng thử lại");
        }
    }

    public function create()
    {
        $categories = CategoryWp::where('parent_id', 0)->latest()->get();

        return view("admins::category_wordpress.create", [
            'categories' => $categories
        ]);
    }

    public function edit($id)
    {
        $category = CategoryWp::find($id);
        $categories = CategoryWp::all();

        return view("admins::category_wordpress.edit", [
            "category" => $category,
            "categories" => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = CategoryWp::find($id);
        $category->update([
            "name" => $request->name,
            "link" => $request->link,
            "parent_id" => $request->parent_id,
            "position" => $request->position
        ]);

        return back()->with("success", "Thêm thành công");
    }

    public function store(Request $request)
    {
        CategoryWp::create([
            "name" => $request->name,
            "link" => $request->link,
            "parent_id" => $request->parent_id,
            "position" => $request->position
        ]);

        return back()->with("success", "Thêm thành công");
    }
}