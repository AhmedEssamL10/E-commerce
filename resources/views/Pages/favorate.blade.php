@extends('layouts.bradecrum')
@section('title', 'Favorate')
@section('desc', 'Fresh and Organic')
@section('contant2')
    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>

                                </tr>
                            </thead>
                            <tbody id="products">

                                @foreach ($favorateProducts as $product)
                                    <tr class="table-body-row" id="product-row-{{ $product->id }}">

                                        <td class="product-remove">

                                            <a href="{{ route('favorate.delete', $product->id) }}"
                                                class="btn btn-danger delete-from-favorate"
                                                data-product-id="{{ $product->id }}">Delete</a>
                                        </td>
                                        <td class="product-image"> <a href="{{ route('product_details', $product->id) }}">
                                                <img src="{{ asset('images/product//' . $product->image) }}"
                                                    alt=""></a>
                                        </td>
                                        <td class="product-name">{{ $product->en_name }}</td>
                                        <td class="product-price">${{ $product->price }} </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
            <div class="cart-buttons" style="padding-left: 75%">
                <a href="{{ route('shop') }}" class="boxed-btn black">Shop</a>
                <a href="{{ route('favorate.deleteAll') }}" class="boxed-btn black deleteAll-from-favorate">Delete all</a>
            </div>
        </div>

    </div>
    </form>
    <!-- end cart -->

@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-from-favorate , .deleteAll-from-favorate').on('click', function(event) {
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
                        if (link.hasClass('delete-from-favorate')) {
                            $('#product-row-' + productId).remove();
                        }
                        if (link.hasClass('deleteAll-from-favorate')) {
                            $('#products').remove();
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
