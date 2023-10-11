@extends('layouts.bradecrum')
@section('title', 'Profile')
@section('contant2')
    <!-- check out section -->
    @include('layouts.messages')
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Edit your account information
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
                                                <p><input type="tel" placeholder="Phone"
                                                        value="{{ Auth::user()->phone }}"></p>
                                                <div class="order-details-wrap">
                                                    <button class="btn btn-primary">Submet</button>
                                                </div>
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
                                            Change your password
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form method="POST" action="{{ route('changePassword') }}">
                                                @csrf
                                                <p><input type="password" name="old_password" placeholder="Old Password">
                                                </p>
                                                <p><input type="password" name="password" placeholder="New Password"></p>
                                                @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="password" name="password_confirmation"
                                                        placeholder="Confirm new Password"></p>
                                                @error('password_confirmation')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="order-details-wrap">
                                                    <button class="btn btn-primary">Change</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card single-accordion">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        MODIFY YOUR ADDRESS BOOK ENTRIES
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="billing-address-form">
                                        @if (Auth::user()->addresses->first() == null)
                                            <form method="POST" action="{{ route('addressCreate') }}">
                                                @csrf
                                                <p><input type="text" placeholder="City" name="city"
                                                        value="{{ old('city') }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="text" placeholder="Region" name="region"
                                                        value="{{ old('region') }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="text" placeholder="Street" name="street"
                                                        value="{{ old('street') }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="text" placeholder="Building" name="building"
                                                        value="{{ old('building') }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="text" placeholder="Floor" name="floor"
                                                        value="{{ old('floor') }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <button class="btn btn-primary">Add</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('addressEdit') }}">
                                                @csrf
                                                <p><input type="text" placeholder="Address" name="city"
                                                        value="{{ Auth::user()->addresses->first()->city }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="text" placeholder="Address" name="region"
                                                        value="{{ Auth::user()->addresses->first()->region }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="text" placeholder="Address" name="street"
                                                        value="{{ Auth::user()->addresses->first()->street }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="text" placeholder="Address" name="building"
                                                        value="{{ Auth::user()->addresses->first()->building }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <p><input type="text" placeholder="Address" name="floor"
                                                        value="{{ Auth::user()->addresses->first()->floor }}">
                                                </p>
                                                @error('detiles_ar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <button class="btn btn-primary">Update</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card single-accordion">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Order History
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="shipping-address-form">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="cart-table-wrap">
                                                <table class="cart-table">
                                                    <thead class="cart-table-head">
                                                        <tr class="table-head-row">
                                                            <th class="product-name">Name</th>
                                                            <th class="product-price">Price</th>
                                                            <th class="product-quantity">Quantity</th>
                                                            <th class="product-total">Total</th>
                                                            <th class="product-total">date</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($orders as $order)
                                                        <tbody>
                                                            <tr class="table-body-row">
                                                                <td class="product-name">{{ $order->product->en_name }}
                                                                </td>
                                                                <td class="product-name">${{ $order->product->price }}
                                                                </td>
                                                                <td class="product-name">{{ $order->quantity }}
                                                                </td>
                                                                <td class="product-name">
                                                                    ${{ $order->quantity * $order->product->price }}
                                                                </td>
                                                                <td class="product-name">{{ $order->created_at }}
                                                                </td>
                                                            </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <div class="pagination pagination-lg justify-content-center ">
                                                        {{ $orders->links() }}
                                                    </div>
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
    </div>
    </div>
    <!-- end check out section -->
@endsection
