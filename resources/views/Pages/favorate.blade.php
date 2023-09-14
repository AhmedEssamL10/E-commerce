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
                            <tbody>

                                @foreach ($favorateProducts as $product)
                                    <tr class="table-body-row">

                                        <td class="product-remove">

                                            <a href=" " class="btn btn-danger">Delete</a>
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
        </div>
    </div>
    </form>
    <!-- end cart -->

@endsection
