@extends('layouts.client.main-client')

@section('content')
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Shop Category</h2>
                    <p>Very us move be blessed multiply night</p>
                </div>
                <div class="page_link">
                    <a href="index.html">Home</a>
                    <a href="category.html">Shop</a>
                    <a href="category.html">Women Fashion</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">

                <div class="latest_product_inner">
                    <div class="row">
                        @foreach($products as $p)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <div class="product-img">
                                    <img class="card-img" src="{{asset('storage/images/'.$p->img.'')}}" alt="" />
                                    <div class="p_icon">
                                        <a href="#">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-heart"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-btm">
                                    <a href="#" class="d-block">
                                        <h4>{{$p->name}}</h4>
                                    </a>
                                    <div class="mt-3">
                                        <span class="mr-4">$ {{$p->price - ($p->price * 0.01 * $p->sale)}}</span>
                                        <del>$ {{$p->price}}</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <nav aria-label="...">
                        <ul class="pagination">
                            <p style="display: none;" id="page">{{$current_page}}</p>
                            <li class="page-item {{$current_page == 1 ? 'disabled' : ''}}">
                                <a class="page-link" onclick="prev()">Previous</a>
                            </li>
                            @for ($i = 0; $i < $length; $i++) <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/list?page={{$i+1}}">{{$i + 1}}</a></li>
                                @endfor
                                <li class="page-item {{$current_page == $length ? 'disabled' : ''}}">
                                    <a class="page-link" onclick="next()">Next</a>
                                </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Browse Categories</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                @foreach($categories as $c)
                                <li class="{{$id == $c->id && $type == 'category' ? 'active' : ''}}">
                                    <a href="http://127.0.0.1:8000/list/category/{{$c->id}}">{{$c->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Product Brand</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                @foreach($brands as $b)
                                <li class="{{$id == $b->id && $type == 'brand' ? 'active' : ''}}">
                                    <a href="http://127.0.0.1:8000/list/brand/{{$b->id}}">{{$b->brand_name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Color Filter</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                @foreach($colors as $a)
                                <li class="{{$id == $a->id && $type == 'color' ? 'active' : ''}}">
                                    <a href="http://127.0.0.1:8000/list/color/{{$a->id}}">{{$a->color_name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Price Filter</h3>
                        </div>
                        <div class="widgets_inner">
                            <div class="range_item">
                                <form action="">
                                    <input type="range" class="form-range " value="0" max="1000" min="0" id="customRange1" name="price" style="width: 100%;" oninput="setValue(this)">
                                    <div class="">
                                        <label for="amount">Price : $<span id="price"></span> - $1000</label>
                                        <div class="text-center">
                                            <button class="btn btn-success" type="submit">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->
<script>
    const price = document.getElementById("price");
    price.innerHTML = 0;

    function setValue(x) {
        price.innerHTML = x.value;
    }

    function next() {
        document.location = 'http://127.0.0.1:8000/list?page=' + (Number(document.getElementById('page').innerHTML) + 1);
    }

    function prev() {
        document.location = 'http://127.0.0.1:8000/list?page=' + (Number(document.getElementById('page').innerHTML) + -1);
    }
</script>
@endsection