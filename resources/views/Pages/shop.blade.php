@extends('layouts.bradecrum')
@section('title', 'Shop')
@section('desc', 'Fresh and Organic')
@section('contant2')
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".strawberry">Strawberry</li>
                            <li data-filter=".berry">Berry</li>
                            <li data-filter=".lemon">Lemon</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center strawberry">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('product_details', $product->id) }}"><img
                                        src="{{ asset('images/product//' . $product->image) }}" height="200"
                                        alt=""></a>
                            </div>
                            <h3>{{ $product->en_name }}</h3>
                            <p class="product-price"><span>Price</span> {{ $product->price }}$ </p>
                            <span>
                                <a href="{{ route('AddToCart', $product->id) }}" class="cart-btn"><i
                                        class="fas fa-shopping-cart"></i>Cart
                                </a>
                                <a href="" class="cart-btn"><i class="fas fa-heart-cart"></i>Favorate </a>
                            </span>
                        </div>
                    </div>
                @endforeach


            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="pagination-wrap">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li><a href="#">1</a></li>
                            <li><a class="active" href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection
