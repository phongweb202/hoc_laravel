<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class BrandController extends BaseController
{
    public function index()
    {
        $brands = Brand::all();
        return view(
            'admin.brands.index',
            [
                'brands' => $brands
            ]
        );
    }

    public function create()
    {
        return view('admin.brands.brand_form', []);
    }

    public function saveCreate(Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'brand_name' => 'required'
            ],
            [
                'brand_name.required' => 'Tên thương hiệu không được bỏ trống'
            ]
        );

        if ($validated->fails()) {
            return redirect('admin/brands/create')
                ->withErrors($validated)->withInput();
        } else {
            $model = new Brand();
            $model->brand_name = $_POST['brand_name'];
            $model->save();
            return redirect('admin/brands');
        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.brand_edit', [
            'brand' => $brand
        ]);
    }

    public function saveEdit($id, Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'brand_name' => 'required'
            ],
            [
                'brand_name.required' => 'Tên thương hiệu không được bỏ trống'
            ]
        );
        if ($validated->fails()) {
            return redirect('admin/brands/' . $id . '/edit')
                ->withErrors($validated)->withInput();
        } else {
            $model = Brand::find($id);
            $model->brand_name = $_POST['brand_name'];
            $model->save();
            return redirect('admin/brands');
        }
    }

    public function remove($id)
    {
        $model = Brand::destroy($id);
        return redirect('admin/brands');
    }
}
