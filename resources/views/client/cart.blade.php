@extends('layouts.client.main-client')

@section('content')
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Cart</h2>
                    <p>Very us move be blessed multiply night</p>
                </div>
                <div class="page_link">
                    <a href="index.html">Home</a>
                    <a href="cart.html">Cart</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $p)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{asset('storage/images/'.$p->img.'')}}" alt="" style="height: 150px;" />
                                    </div>
                                    <div class="media-body">
                                        <p>{{$p->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>$ {{$p->price}}</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="number" id="sst" max="12" value=1 class="qty" />
                                    <button class="increase items-count" type="button">
                                        <i class="lnr lnr-chevron-up"></i>
                                    </button>
                                    <button class="reduced items-count" type="button">
                                        <i class="lnr lnr-chevron-down"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <h5 class="total" data-price="{{$p->price}}" data-id="{{$p->id}}">$720.00</h5>
                            </td>
                        </tr>
                        @endforeach

                        <tr class="bottom_button">
                            <td>
                                <a class="gray_btn" href="#">Update Cart</a>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="cupon_text">
                                    <input type="text" placeholder="Coupon Code" />
                                    <a class="main_btn" href="#">Apply</a>
                                    <a class="gray_btn" href="#">Close Coupon</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5 id="sum">$2160.00</h5>
                            </td>
                        </tr>
                        <tr class="shipping_area">
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Shipping</h5>
                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li>
                                            <a href="#">Flat Rate: $5.00</a>
                                        </li>
                                        <li>
                                            <a href="#">Free Shipping</a>
                                        </li>
                                        <li>
                                            <a href="#">Flat Rate: $10.00</a>
                                        </li>
                                        <li class="active">
                                            <a href="#">Local Delivery: $2.00</a>
                                        </li>
                                    </ul>
                                    <h6>
                                        Calculate Shipping
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </h6>
                                    <select class="shipping_select">
                                        <option value="1">Bangladesh</option>
                                        <option value="2">India</option>
                                        <option value="4">Pakistan</option>
                                    </select>
                                    <select class="shipping_select">
                                        <option value="1">Select a State</option>
                                        <option value="2">Select a State</option>
                                        <option value="4">Select a State</option>
                                    </select>
                                    <input type="text" placeholder="Postcode/Zipcode" />
                                    <a class="gray_btn" href="#">Update Details</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="checkout_btn_inner">
                                    <a class="gray_btn" href="#">Continue Shopping</a>
                                    <a class="main_btn" href="#">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    const qtys = document.querySelectorAll('.qty');
    const totals = document.querySelectorAll('.total');
    const btns = document.querySelectorAll('.items-count');
    const sum = document.querySelector('#sum');

    function tongTien() {
        let total = 0;

        for (let index = 0; index < totals.length; index++) {
            let string = totals[index].innerHTML.replace('$ ', '');
            total += Number(string);
        }
        sum.innerHTML = `$ ${total}`;

    }


    let arrTang = [];
    let arrGiam = [];
    for (let index = 0; index < btns.length; index++) {
        if (btns[index].classList.contains('increase')) {
            arrTang.push(btns[index]);
        } else {
            arrGiam.push(btns[index]);
        }

    }
    for (let i = 0; i < arrTang.length; i++) {
        const {
            price
        } = totals[i].dataset;

        const {
            id
        } = totals[i].dataset;
        totals[i].innerHTML = `$ ${Number(price * qtys[i].value)}`;

        // Set sự kiện tăng số lượng 

        arrTang[i].addEventListener('click', () => {
            qtys[i].value++;

            totals[i].innerHTML = `$ ${Number(price * qtys[i].value)}`

            tongTien();
        });

        // Set sự kiện giảm số lượng 

        arrGiam[i].addEventListener('click', () => {
            qtys[i].value--;
            if (qtys[i].value == 0) {
                const confirm = window.confirm('Bạn có chắc muốn xóa sản phẩm này');
                if (confirm) {
                    document.location = 'http://127.0.0.1:8000/cart/delete/' + id;
                } else {
                    qtys[i].value++;
                }
            }
            totals[i].innerHTML = `$ ${Number(price * qtys[i].value)}`

            tongTien();
        });
    }
    tongTien();
</script>
@endsection