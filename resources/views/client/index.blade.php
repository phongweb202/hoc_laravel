@extends('layouts.client.main-client')

@section('content')
<section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content row">
                <div class="col-lg-12">
                    <p class="sub text-uppercase">men Collection</p>
                    <h3><span>Show</span> Your <br />Personal <span>Style</span></h3>
                    <h4>Fowl saw dry which a above together place.</h4>
                    <a class="main_btn mt-40" href="#">View Collection</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-area section_gap_bottom_custom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-money"></i>
                        <h3>Money back gurantee</h3>
                    </a>
                    <p>Shall open divide a one</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-truck"></i>
                        <h3>Free Delivery</h3>
                    </a>
                    <p>Shall open divide a one</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-support"></i>
                        <h3>Alway support</h3>
                    </a>
                    <p>Shall open divide a one</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-blockchain"></i>
                        <h3>Secure payment</h3>
                    </a>
                    <p>Shall open divide a one</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="feature_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Featured product</span></h2>
                    <p>Bring called seed first of third give itself now ment</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($featured_product as $f)
            <div class="col-lg-4 col-md-6">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100" src="{{asset('storage/images/'.$f->img.'')}}" alt="" />
                        <div class="p_icon">
                            <a href="http://127.0.0.1:8000/product/{{$f->id}}">
                                <i class="ti-eye"></i>
                            </a>
                            <a href="http://127.0.0.1:8000/product/{{$f->id}}/favorite">
                                <i class="ti-heart"></i>
                            </a>
                            <a onclick="addCart()" href="http://127.0.0.1:8000/cart/add/{{$f->id}}">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="http://127.0.0.1:8000/product/{{$f->id}}" class="d-block">
                            <h4>{{$f->name}}</h4>
                        </a>
                        <div class="mt-3">
                            <span class="mr-4">$ {{$f->price - ($f->price * 0.01 * $f->sale)}}</span>
                            <del>$ {{$f->price}}</del>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="offer_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="offset-lg-4 col-lg-6 text-center">
                <div class="offer_content">
                    <h3 class="text-uppercase mb-40">all men’s collection</h3>
                    <h2 class="text-uppercase">50% off</h2>
                    <a href="#" class="main_btn mb-20 mt-5">Discover Now</a>
                    <p>Limited Time Offer</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="new_product_area section_gap_top section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>new products</span></h2>
                    <p>Bring called seed first of third give itself now ment</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="new_product">
                    <h5 class="text-uppercase">collection of 2019</h5>
                    <h3 class="text-uppercase">{{$hot_product->name}}</h3>
                    <div class="product-img">
                        <img class="img-fluid" src="{{asset('storage/images/'.$hot_product->img.'')}}" alt="" />
                    </div>
                    <h4>$120.70</h4>
                    <a href="#" class="main_btn">Add to cart</a>
                </div>
            </div>

            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row">
                    @foreach($new_product as $p)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-product">
                            <div class="product-img">
                                <img class="img-fluid w-100" src="{{asset('storage/images/'.$p->img.'')}}" alt="" />
                                <div class="p_icon">
                                    <a href="http://127.0.0.1:8000/product/{{$p->id}}">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="http://127.0.0.1:8000/product/{{$p->id}}/favorite">
                                        <i class="ti-heart"></i>
                                    </a>
                                    <a onclick="addCart()" href="http://127.0.0.1:8000/cart/add/{{$p->id}}">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-btm">
                                <a href="http://127.0.0.1:8000/product/{{$p->id}}" class="d-block">
                                    <h4>{{$p->price}}</h4>
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
            </div>
        </div>
    </div>
</section>

<section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Inspired products</span></h2>
                    <p>Bring called seed first of third give itself now ment</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($inspired_products as $p)
            <div class="col-lg-3 col-md-6">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100" src="{{asset('storage/images/'.$p->img.'')}}" alt="" />
                        <div class="p_icon">
                            <a href="http://127.0.0.1:8000/product/{{$p->ma_sp}}">
                                <i class="ti-eye"></i>
                            </a>
                            <a href="http://127.0.0.1:8000/product/{{$p->ma_sp}}/favorite">
                                <i class="ti-heart"></i>
                            </a>
                            <a onclick="addCart()" href="http://127.0.0.1:8000/cart/add/{{$p->ma_sp}}">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="http://127.0.0.1:8000/product/{{$p->ma_sp}}" class="d-block">
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
    </div>
</section>

<section class="blog-area section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>latest blog</span></h2>
                    <p>Bring called seed first of third give itself now ment</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{asset('storage/img/b1.jpg')}}" alt="">
                    </div>
                    <div class="short_details">
                        <div class="meta-top d-flex">
                            <a href="#">By Admin</a>
                            <a href="#"><i class="ti-comments-smiley"></i>2 Comments</a>
                        </div>
                        <a class="d-block" href="single-blog.html">
                            <h4>Ford clever bed stops your sleeping
                                partner hogging the whole</h4>
                        </a>
                        <div class="text-wrap">
                            <p>
                                Let one fifth i bring fly to divided face for bearing the divide unto seed winged divided light
                                Forth.
                            </p>
                        </div>
                        <a href="#" class="blog_btn">Learn More <span class="ml-2 ti-arrow-right"></span></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{asset('storage/img/b2.jpg')}}" alt="">
                    </div>
                    <div class="short_details">
                        <div class="meta-top d-flex">
                            <a href="#">By Admin</a>
                            <a href="#"><i class="ti-comments-smiley"></i>2 Comments</a>
                        </div>
                        <a class="d-block" href="single-blog.html">
                            <h4>Ford clever bed stops your sleeping
                                partner hogging the whole</h4>
                        </a>
                        <div class="text-wrap">
                            <p>
                                Let one fifth i bring fly to divided face for bearing the divide unto seed winged divided light
                                Forth.
                            </p>
                        </div>
                        <a href="#" class="blog_btn">Learn More <span class="ml-2 ti-arrow-right"></span></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{asset('storage/img/b3.jpg')}}" alt="">
                    </div>
                    <div class="short_details">
                        <div class="meta-top d-flex">
                            <a href="#">By Admin</a>
                            <a href="#"><i class="ti-comments-smiley"></i>2 Comments</a>
                        </div>
                        <a class="d-block" href="single-blog.html">
                            <h4>Ford clever bed stops your sleeping
                                partner hogging the whole</h4>
                        </a>
                        <div class="text-wrap">
                            <p>
                                Let one fifth i bring fly to divided face for bearing the divide unto seed winged divided light
                                Forth.
                            </p>
                        </div>
                        <a href="#" class="blog_btn">Learn More <span class="ml-2 ti-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function addCart() {
        alert('Add product to cart sucessfully');
    }
</script>
@endsection