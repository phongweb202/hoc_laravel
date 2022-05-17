<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class SiteController extends Controller
{
    public function index()
    {
        $featured_product =
            Product::select()
            ->orderBy('view', 'desc')
            ->limit(3)
            ->get();
        $new_product =
            Product::select()
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
        $hot_product = $new_product[0];
        $inspired_products =
            Product::join('infomation_products', 'products.id', '=', 'infomation_products.product_id')
            ->selectRaw('img,products.id ma_sp,price,sale')
            ->where('quality_checking', 0)
            ->get();

        unset($new_product[0]);
        return view(
            'client.index',
            [
                'featured_product' => $featured_product,
                'new_product' => $new_product,
                'hot_product' => $hot_product,
                'inspired_products' => $inspired_products,

            ]
        );
    }
    public function detail($id)
    {
        $product = Product::find($id);
        $comments = DB::table('comments')
            ->select()
            ->where('product_id', $id)
            ->get();
        $toString = fn ($time) => new Carbon($time);
        return view(
            'client.product_detail',
            [
                'product' => $product,
                'comments' => $comments,
                'toString' => $toString
            ]
        );
    }

    public function saveComment($id, Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'full_name' => 'required',
                'address_email' => 'required',
                'phone_number' => 'required',
                'message' => 'required'
            ],
            [
                'full_name.required' => 'Tên bắt buộc nhập',
                'address_email.required' => 'Địa chỉ email bắt buộc nhập',
                'phone_number.required' => 'Số điện thoại bắt buộc nhập',
                'message.required' => 'Nội dung bắt buộc nhập'
            ]
        );
        if ($validated->fails()) {
            return redirect('product/' . $id . '')
                ->withErrors($validated)
                ->withInput();
        }
        $time = Carbon::now();
        $data = [
            'full_name' => $request->input('full_name'),
            'address_email' => $request->input('address_email'),
            'phone_number' => $request->input('phone_number'),
            'time' => $time,
            'message' => $request->input('message'),
            'product_id' => $id
        ];
        DB::table('comments')->insert($data);
        return redirect('http://127.0.0.1:8000/product/' . $id . '');
    }

    public function setfavoriteProduct($id)
    {
        $arr = json_decode(Cookie::get('favorite'));
        if (isset($arr[0])) {
            if (!in_array($id, $arr)) {
                // $response->withCookie(cookie('favorite', json_encode([...$arr, $id]), 2880));
                Cookie::queue('favorite', json_encode([...$arr, $id]), 2880);
            }
        } else {
            Cookie::queue('favorite', json_encode([$id]), 2880);
        }
        // return $response;
        return redirect('http://127.0.0.1:8000/');
    }
    public function listProducts($type = null, $id = null)
    {
        $products = null;
        $brands = Brand::all();
        $categories = Category::all();
        $colors = Color::all();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $length = ceil(count(Product::all()) / 8);
        if ($current_page > $length) {
            $current_page = $length;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = $start = ($current_page - 1) * 8;
        $products = Product::select();
        if (isset($type) && isset($id)) {
            if ($type == 'category') {
                $products = $products->where('category_id', $id);
            }
            if ($type == 'brand') {
                $products = $products->where('brand_id', $id);
            }
            if ($type == 'color') {
                $data = [];
                $colorDetails = ProductColorDetail::where('color_id', $id)->get();
                foreach ($colorDetails as $c) {
                    array_push($data, $c->product_id);
                }
                $products = $products->whereIn('id', $data);
            }
        }

        if (isset($_GET['price'])) {
            $products = $products->where('price', '>=', $_GET['price'])->where('price', '<=', 1000);
        }

        $products = $products->offset($start)->limit(8)->get();

        return view('client.list_products', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'colors' => $colors,
            'length' => $length,
            'current_page' => $current_page,
            'id' => $id,
            'type' => $type
        ]);
    }

    public function listFavorite()
    {
        $list_id = json_decode(cookie::get('favorite'));
        $products = Product::whereIn('id', $list_id)->get();
        return view('client.favourite_page', [
            'products' => $products
        ]);
    }


    public function addCart($id, $quantity = 1)
    {
        $arr = json_decode(Cookie::get('cart'));

        if (isset($arr[0])) {
            $data = [['id' => $id, 'quantity' => $quantity], ...$arr];
            foreach ($arr as $a) {
                if ($id == $a->id) {
                    $a->quantity += $quantity;
                    $data = $arr;
                }
            }
            Cookie::queue('cart', json_encode($data), 21600);
            return redirect('http://127.0.0.1:8000/')->with('status', 'Add product to cart succefully');
        } else {
            Cookie::queue('cart', json_encode([['id' => $id, 'quantity' => $quantity]]), 21600);
            return redirect('http://127.0.0.1:8000/')->with('status', 'Add product to cart succefully');
        }
    }
    public function cart()
    {
        $carts = json_decode(Cookie::get('cart'));
        $data_id = [];
        foreach ($carts as $c) {
            array_push($data_id, $c->id);
        }
        $products = Product::whereIn('id', $data_id)->get();

        return view('client.cart', [
            'products' => $products
        ]);
    }

    public function deleteCart($id)
    {
        $new_carts = [];
        $old_carts = json_decode(Cookie::get('cart'));
        for ($i = 0; $i < count($old_carts); $i++) {
            if ($id != $old_carts[$i]->id) {
                array_push($new_carts, $old_carts[$i]);
            }
        }

        Cookie::queue('cart', json_encode($new_carts), 21600);

        return redirect('http://127.0.0.1:8000/cart');
    }
}
