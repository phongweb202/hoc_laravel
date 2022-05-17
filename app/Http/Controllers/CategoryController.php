<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.category.category_form', []);
    }


    public function saveCreate(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|min:6'
        ], [
            'name.required' => 'Tên danh mục bắt buộc nhập',
            'name.min' => 'Tên danh mục dài hơn 6 ký tự'
        ]);
        if ($validated->fails()) {
            return redirect('admin/category/create')
                ->withErrors($validated)->withInput();
        } else {
            $model = new Category();
            $model->name = $_POST['name'];
            $model->save();
            return redirect('admin/category');
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.category_edit', [
            'category' => $category
        ]);
    }

    public function saveEdit($id, Request $request)
    {

        $validated = Validator::make($request->all(), [
            'name' => 'required|min:6'
        ], [
            'name.required' => 'Tên danh mục bắt buộc nhập',
            'name.min' => 'Tên danh mục dài hơn 6 ký tự'
        ]);
        if ($validated->fails()) {
            return redirect('admin/category/' . $id . '/edit')
                ->withErrors($validated)->withInput();
        } else {
            $model = Category::find($id);
            $model->name = $_POST['name'];
            $model->save();
            return redirect('admin/category');
        }
    }

    public function remove($id)
    {
        $model = Category::destroy($id);
        return redirect('admin/category');
    }
}
