@extends('frontend.layouts.layout')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            @auth
            @else
                <div class="step-one">
                    <h2 class="heading">Checkout options</h2>
                </div>
                <div class="checkout-options"> <!-- checkout options -->
                    {{-- <h3>New User</h3> --}}
                    {{-- <p>Checkout options</p> --}}
                    <ul class="nav">
                        <li>
                            <label for="register">
                                <input type="checkbox" value="register" name="register" id="register"
                                    onclick="toggeleShooperInformation()"> Register Account
                            </label>
                        </li>
                    </ul>
                </div><!--/checkout-options-->
                <div class="register-req">
                    <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Member
                    </p>
                </div><!--/register-req-->
            @endauth


            <div class="shopper-informations" style="display: none">
                <div class="row">
                    <div class="col-sm-8 signup-form">
                        <form action="/register" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div pss="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" placeholder="Johnathan Doe" name="name"
                                    class="form-control form-control-line">

                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" placeholder="johnathan@admin.com"
                                    class="form-control form-control-line" name="email" id="email">

                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="********"
                                    class="form-control form-control-line">

                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirmation Password</label>

                                <input type="password" name="password_confirmation" placeholder="********"
                                    class="form-control form-control-line">

                            </div>

                            <div class="form-group">
                                <label for="phone">Phone No</label>
                                <input type="text" name="phone" placeholder="+84 363203112"
                                    class="form-control form-control-line">

                            </div>

                            <div class="form-group">
                                <button class="btn btn-default" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea name="message" placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                            <label><input type="checkbox"> Shipping to bill address</label>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($cart))
                <div class="review-payment">
                    <h2>Review & Payment</h2>
                </div>

                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description"></td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr data-cart-id="{{ $item['id'] }}">
                                    <td class="cart_product">
                                        <a href=""><img src="{{ asset('storage/products/85x84/' . $item['image']) }}"
                                                alt="Product Image..."></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{ $item['name'] }}</a></h4>
                                    </td>
                                    <td class="cart_price">
                                        <p>${{ $item['price'] }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="cart_quantity_up"> + </a>
                                            <input class="cart_quantity_input" type="text" name="quantity"
                                                value="{{ $item['quantity'] }}" autocomplete="off" size="2">
                                            <a class="cart_quantity_down"> - </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">${{ $item['price'] * $item['quantity'] }}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="2">
                                    <table class="table table-condensed total-result">
                                        {{-- <tr>
                                        <td>Cart Sub Total</td>
                                        <td>$59</td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>$2</td>
                                    </tr> --}}
                                        <tr class="shipping-cost">
                                            <td>Shipping Cost</td>
                                            <td>Free</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><span id="total">{{ $total }}</span></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <button class="btn btn-default" form="order-form" id="btnOrder">
                                                    Order
                                                </button>
                                                <form id="order-form" action="/checkout/sendmail" method="POST"
                                                    class="hidden">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Payment options --}}
            {{-- <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div> --}}
        </div>
    </section> <!--/#cart_items-->

    <script>
        const cbRegister = document.getElementById('register');
        const btnOrder = document.getElementById('btnOrder');

        btnOrder.addEventListener('click', function(e) {
            if (!window.isLoggedIn) {
                e.preventDefault();
                alert('Please login to order');
                return;
            }

            document.getElementById('order-form').submit();
        })

        function toggeleShooperInformation() {
            const shopperInformation = document.querySelector('.shopper-informations');

            if (cbRegister.checked) {
                shopperInformation.style.display = 'block';
            } else {
                shopperInformation.style.display = 'none';
            }
        }
    </script>
    <script src="{{ asset('frontend/js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/handle-cart.js') }}"></script>
@endsection
