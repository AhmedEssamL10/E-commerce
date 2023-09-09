@extends('layouts.bradecrum')
@section('title', 'Cart')
@section('desc', 'Fresh and Organic')
@section('contant2')

    <!-- cart -->

    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $productArray)
                                    @foreach ($productArray as $product)
                                        <tr class="table-body-row">
                                            <td class="product-remove">

                                                <a href="{{ route('deleteCartProduct', $product->id) }} "
                                                    class="btn btn-danger">Delete</a>


                                            </td>
                                            <td class="product-image"><img
                                                    src="{{ asset('images/product//' . $product->image) }}" alt="">
                                            </td>
                                            <td class="product-name">{{ $product->en_name }}</td>
                                            <td class="product-price">${{ $product->price }}</td>
                                            <form method="POST" action="{{ route('editCartProduct', $product->id) }}">
                                                @csrf
                                                <td class="product-quantity"><input type="number" name="quantity"
                                                        placeholder="{{ $product->quantity }}">
                                                    <button class="btn btn-warning">Edit</button>
                                                </td>
                                            </form>
                                            <td class="product-total">{{ $product->price * $product->quantity }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Subtotal: </strong></td>
                                    <td>$500</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Shipping: </strong></td>
                                    <td>$45</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td>$545</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            <a href="checkout.html" class="boxed-btn black">Check Out</a>
                        </div>
                    </div>

                    <div class="coupon-section">
                        <h3>Apply Coupon</h3>
                        <div class="coupon-form-wrap">
                            <form action="index.html">
                                <p><input type="text" placeholder="Coupon"></p>
                                <p><input type="submit" value="Apply"></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- end cart -->

@endsection
