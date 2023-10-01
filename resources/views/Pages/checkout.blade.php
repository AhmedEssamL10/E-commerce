@extends('layouts.bradecrum')
@section('title', 'Checkout')
@section('desc', 'Order your products')
@section('contant2')
    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form action="index.html">
                                                <p><input type="text" placeholder="Name"
                                                        value="{{ Auth::user()->name }}"></p>
                                                <p><input type="email" placeholder="Email"
                                                        value="{{ Auth::user()->email }}"></p>
                                                <p><input type="text" placeholder="Address"
                                                        value="{{ Auth::user()->addresses->first()->city }} -{{ Auth::user()->addresses->first()->region }}-{{ Auth::user()->addresses->first()->street }}-{{ Auth::user()->addresses->first()->building }}-{{ Auth::user()->addresses->first()->floor }} ">
                                                </p>
                                                <p><input type="tel" placeholder="Phone"
                                                        value="{{ Auth::user()->phone }}"></p>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Shipping Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shipping-address-form">
                                            <p>City: {{ Auth::user()->addresses->first()->city }}
                                                <br>
                                                Region:
                                                {{ Auth::user()->addresses->first()->region }}
                                                <br>
                                                Street: {{ Auth::user()->addresses->first()->street }}
                                                <br>
                                                Building number: {{ Auth::user()->addresses->first()->building }}
                                                <br>
                                                Floor number: {{ Auth::user()->addresses->first()->floor }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Card Details
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-details">
                                            <p>Your card details goes here.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Order Review
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-details">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="cart-table-wrap">
                                                        <table class="cart-table">
                                                            <thead class="cart-table-head">
                                                                <tr class="table-head-row">

                                                                    <th class="product-image">Product Image</th>
                                                                    <th class="product-name">Name</th>
                                                                    <th class="product-price">Price</th>
                                                                    <th class="product-price">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $sum = 0;
                                                                @endphp
                                                                @foreach ($products as $product)
                                                                    <tr class="table-body-row">

                                                                        <td class="product-image"> <a
                                                                                href="{{ route('product_details', $product->id) }}">
                                                                                <img src="{{ asset('images/product//' . $product->image) }}"
                                                                                    alt=""></a>
                                                                        </td>
                                                                        <td class="product-name">{{ $product->en_name }}
                                                                        </td>
                                                                        <td class="product-price">${{ $product->price }}
                                                                        </td>
                                                                        <td class="product-price">
                                                                            {{ $product->quantity }}
                                                                        </td>
                                                                        @php
                                                                            $sum = $sum + $product->price * $product->quantity;
                                                                        @endphp
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-body">
                                <tr>
                                    <td>Product</td>
                                    <td>quantity</td>
                                    <td>Total</td>
                                </tr>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->en_name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>${{ $product->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody class="checkout-details">
                                <thead>
                                    <tr>
                                        <th>Shipping</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>$50</td>
                                    <td>{{ $sum + 50 }}</td>
                                </tr>
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('orderHistpryCreate') }}" class="boxed-btn">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->
@endsection
