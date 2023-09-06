@extends('layouts.bradecrum')
@section('title', 'Product Details')
@section('desc', 'Fresh and Organic')
@section('contant2')
    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="{{ asset('images/product//' . $product->image) }}" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>{{ $product->en_name }}</h3>
                        <p class="single-product-pricing"><span>Price</span> ${{ $product->price }}</p>
                        <p class="single-product-pricing"><span>Quantity</span> {{ $product->quantity }} pieces</p>
                        <p>{{ $product->en_details }}</p>
                        <div class="single-product-form">
                            <form action="index.html">
                                <input type="number" placeholder="0">
                            </form>
                            <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->

    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Related</span> Products</h3>

                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product1)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('product_details', $product1->id) }}"><img
                                        src="{{ asset('images/product//' . $product1->image) }}" height="200"
                                        alt=""></a>
                            </div>
                            <h3>{{ $product1->en_name }}</h3>
                            <p class="product-price"><span>Price</span> ${{ $product1->price }} </p>
                            <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end more products -->
@endsection
