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
                            <tbody id="products">
                                @php
                                    $sum = 0;
                                @endphp
                                @foreach ($products as $product)
                                    <tr class="table-body-row" id="product-row-{{ $product->id }}">
                                        <td class="product-remove">

                                            <a href="{{ route('deleteCartProduct', $product->id) }} "
                                                class="btn btn-danger delete-from-cart"
                                                data-product-id="{{ $product->id }}">Delete</a>
                                        </td>
                                        <td class="product-image"><img
                                                src="{{ asset('images/product//' . $product->image) }}" alt="">
                                        </td>
                                        <td class="product-name">{{ $product->en_name }}</td>
                                        <td class="product-price">${{ $product->price }}</td>
                                        <form method="POST" action="{{ route('editCartProduct', $product->id) }}"
                                            id="editform">
                                            @csrf
                                            <td class="product-quantity"><input type="number" name="quantity"
                                                    class="quantity-input" placeholder="{{ $product->quantity }}">
                                                <button class="btn btn-warning edit-quantity">Edit</button>
                                            </td>
                                        </form>
                                        <td class="product-total">${{ $product->price * $product->quantity }}</td>
                                        @php
                                            $sum = $sum + $product->price * $product->quantity;
                                        @endphp
                                    </tr>
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
                                    <td>${{ $sum }}</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Shipping: </strong></td>
                                    <td>$45</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td>${{ $sum + 45 }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            <a href="{{ route('checkout') }}" class="boxed-btn black">Check Out</a>
                            <a href="{{ route('deleteAllCartProducts') }}"
                                class="boxed-btn black deleteAll-from-cart">Delete
                                all</a>
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
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-from-cart , .deleteAll-from-cart').on('click', function(event) {
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
                        if (link.hasClass('delete-from-cart')) {
                            $('#product-row-' + productId).remove();
                        }
                        if (link.hasClass('deleteAll-from-cart')) {
                            $('#products').remove();
                        }
                        updateTotal(); // Update the total after deleting a product

                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.edit-quantity').on('click', function(event) {
                event.preventDefault(); // Prevent default button behavior

                var row = $(this).closest('tr');
                var productId = row.attr('id').split('-')[2];
                var quantity = row.find('.quantity-input').val();

                $.ajax({
                    url: "{{ route('editCartProduct', ':id') }}".replace(':id', productId),
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        quantity: quantity
                    },
                    success: function(response) {
                        // Handle the success response

                        console.log(response);
                        row.find('.product-total').text(response.total);
                        updateTotal(); // Update the total after editing the quantity
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.quantity-input').on('input', function() {
                var row = $(this).closest('tr');
                var price = parseFloat(row.find('.product-price').text().replace('$', ''));
                var quantity = $(this).val();
                var productTotal = price * quantity;
                row.find('.product-total').text('$' + productTotal);
                updateTotal(); // Update the total after changing the quantity
            });

            function updateTotal() {
                var sum = 0;
                $('.product-total').each(function() {
                    sum += parseFloat($(this).text().replace('$', ''));
                });
                var subtotal = sum;
                var total = (parseFloat(subtotal) + 45);

                $('#subtotal').text('$' + subtotal);
                $('#total').text('$' + total);
            }
        });
    </script>
@endsection
