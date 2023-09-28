@extends('layouts.bradecrum')
@section('title', 'Shop')
@section('desc', 'Fresh and Organic')
@section('contant2')
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row product-lists">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center strawberry">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('product_details', $product->id) }}">
                                    <img src="{{ asset('images/product//' . $product->image) }}" height="210" alt="">
                                </a>
                            </div>
                            <h3>{{ $product->en_name }}</h3>
                            <p class="product-price"><span>Price:</span> {{ $product->price }}$</p>
                            <span>
                                <a href="{{ route('AddToCart', $product->id) }}" class="cart-btn add-to-cart-link">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </a>
                                <a href="{{ route('favorate.create', $product->id) }}" class="cart-btn">
                                    <i class="fas fa-heart-cart"></i> Favorite
                                </a>
                            </span>
                            <div class="success-message" style="display: none; color: forestgreen ; font: bold">Product
                                added
                                successfully!</div>

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
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart-link').on('click', function(event) {
                event.preventDefault(); // Prevent default link behavior

                var link = $(this);
                var productId = link.data('product-id');

                $.ajax({
                    url: link.attr('href'),
                    method: 'POST',
                    data: {
                        product_id: productId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Handle the success response
                        console.log(response);
                        link.closest('.single-product-item').find('.success-message').fadeIn()
                            .delay(2000).fadeOut();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
