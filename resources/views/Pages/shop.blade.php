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
                                <a href="{{ route('favorate.create', $product->id) }}" class="cart-btn add-to-favorite-link"
                                    data-product-id="{{ $product->id }}">
                                    <i class="fas fa-heart-cart"></i> Favorite
                                </a>
                            </span>
                            <div class="favorite-message" style="display: none; color: forestgreen ; font: bold">Product
                                added to favorites!</div>
                            <div class="success-message bs-success" style="display: none; color: forestgreen ; font: bold">
                                Product
                                added
                                successfully!
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination pagination-lg justify-content-center ">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection
@auth
    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.add-to-cart-link , .add-to-favorite-link').on('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior

                    var link = $(this);
                    var productId = link.data('product-id');

                    $.ajax({
                        url: link.attr('href'),
                        method: 'GET',
                        data: {
                            product_id: productId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle the success response
                            console.log(response);
                            if (link.hasClass('add-to-cart-link')) {
                                link.closest('.single-product-item').find('.success-message')
                                    .fadeIn().delay(2000).fadeOut();
                            } else if (link.hasClass('add-to-favorite-link')) {
                                link.closest('.single-product-item').find('.favorite-message')
                                    .fadeIn().delay(2000).fadeOut();
                            }
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
@endauth
