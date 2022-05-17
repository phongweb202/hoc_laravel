<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.product.product_form', [
            'categories' => $categories,
            'brands' => $brands,
            'colors' => $colors
        ]);
    }

    public function saveCreate(Request $request)
    {
        $colors = Color::all();

        $validated = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required|min:0',
                'quantity' => 'required|min:0'
            ],
            [
                'name.required' => 'Tên sản phẩm không được bỏ trống',
                'price.required' => 'Giá sản phẩm không được để trống',
                'price.min' => 'Giá sản phẩm phải lớn hơn 0',
                'quantity.required' => 'Số lượng sản phẩm không được để trống',
                'quantity.min' => 'Số lượng sản phẩm phải lớn hơn 0'
            ]
        );

        if ($validated->fails()) {
            return redirect('admin/products/create')
                ->withErrors($validated)
                ->withInput();
        }

        $path = $request->file('img')->store('public/images');
        $path = str_replace('public/images/', "", $path);
        $model = new Product();
        $model->name = $request->input('name');
        $model->price = $request->input('price');
        $model->sale = $request->input('sale');
        $model->quantity = $request->input('quantity');
        $model->img = $path;
        $model->category_id = $request->input('category_id');
        $model->brand_id = $request->input('brand_id');
        $model->status = $request->input('status');
        $model->short_desc = $request->input('short_desc');
        $model->describe_specific = $request->input('describe_specific');
        $model->save();
        $arr = [];
        for ($i = 0; $i < count($colors); $i++) {
            if ($request->input('color' . $i . '')) {
                array_push(
                    $arr,
                    [
                        'product_id' => $model->id,
                        'color_id' =>  $request->input('color' . $i . '')
                    ]
                );
            }
        }
        DB::table('product_color_detail')->insert($arr);
        $info = [
            'width' => $request->input('width'),
            'height' => $request->input('height'),
            'depth' => $request->input('depth'),
            'quality_checking' => $request->input('quality_checking'),
            'freshness_duration' => $request->input('freshness_duration'),
            'product_id' => $model->id
        ];
        DB::table('infomation_products')->insert($info);
        return redirect('/admin/products');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands  = Brand::all();
        $colors = Color::all();
        $product_colors = ProductColorDetail::where('product_id', $id)->get();
        function check($thamSo, $duLieu)
        {
            $check = false;
            for ($i = 0; $i < count($duLieu); $i++) {
                if ($thamSo->id === $duLieu[$i]->color_id) {
                    $check = true;
                    break;
                }
            }
            return $check;
        };
        $check = fn ($thamSo, $duLieu) => check($thamSo, $duLieu);
        return view('admin.product.product_edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'colors' => $colors,
            'product_colors' => $product_colors,
            'check' => $check
        ]);
    }

    public function saveEdit(Request $request, $id)
    {
        $colors = Color::all();
        $validated = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required|min:0',
                'quantity' => 'required|min:0'
            ],
            [
                'name.required' => 'Tên sản phẩm không được bỏ trống',
                'price.required' => 'Giá sản phẩm không được để trống',
                'price.min' => 'Giá sản phẩm phải lớn hơn 0',
                'quantity.required' => 'Số lượng sản phẩm không được để trống',
                'quantity.min' => 'Số lượng sản phẩm phải lớn hơn 0'
            ]
        );
        if ($validated->fails()) {
            return redirect('admin/product/' . $id . '/edit')
                ->withErrors($request)
                ->withInput();
        }

        $model = Product::find($id);

        $path = $model->img;
        if ($request->file('img')) {
            $path = $request->file('img')->store('public/images');
            $path = str_replace('public/images/', "", $path);
        }
        $model->name = $request->input('name');
        $model->price = $request->input('price');
        $model->sale = $request->input('sale');
        $model->quantity = $request->input('quantity');
        $model->img = $path;
        $model->category_id = $request->input('category_id');
        $model->brand_id = $request->input('brand_id');
        $model->status = $request->input('status');
        $model->short_desc = $request->input('short_desc');
        $model->describe_specific = $request->input('describe_specific');
        $model->save();
        $product_colors = ProductColorDetail::where('product_id', $id)->delete();
        $arr = [];

        for ($i = 0; $i < count($colors); $i++) {
            if ($request->input('color' . $i . '')) {
                array_push(
                    $arr,
                    [
                        'product_id' => $model->id,
                        'color_id' =>  $request->input('color' . $i . '')
                    ]
                );
            }
        }
        if (count($arr) > 0) {
            DB::table('product_color_detail')->insert($arr);
        }
        $info = [
            'width' => $request->input('width'),
            'height' => $request->input('height'),
            'depth' => $request->input('depth'),
            'quality_checking' => $request->input('quality_checking'),
            'freshness_duration' => $request->input('freshness_duration'),
            'product_id' => $model->id
        ];
        DB::table('infomation_products')->where('product_id', $id)->update($info);
        return redirect('admin/products');
    }
    public function remove($id)
    {
        $model = Product::destroy($id);
        return redirect('admin/products');
    }

    public function infomain_form($id)
    {
        return view('admin.product.product_infomation', []);
    }
}
