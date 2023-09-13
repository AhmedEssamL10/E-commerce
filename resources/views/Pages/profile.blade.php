@extends('layouts.bradecrum')
@section('title', 'Profile')

@section('contant2')
    <!-- check out section -->
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
                                            <form action="index.html">

                                                <p><input type="password" placeholder="Old Password"></p>
                                                <p><input type="password" placeholder="New Password"></p>
                                                <p><input type="password" placeholder="Confirm new Password"></p>

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
                                        <form action="index.html">
                                            @if (Auth::user()->addresses->first->city == null)
                                                <p><input type="text" placeholder="Add Address" name="address">
                                                    <button class="btn btn-primary">Add</button>
                                        </form>
                                    @else
                                        <form action="index.html">
                                            <?php $i = 1; ?>
                                            @foreach (Auth::user()->addresses as $address)
                                                <p>Address {{ $i }}</p>
                                                <p><input type="text" placeholder="Address" name="address"
                                                        value="{{ $address->city }}">
                                                </p>

                                                <?php $i++; ?>
                                            @endforeach
                                            <button class="btn btn-primary">Change</button>
                                            @endif





                                        </form>
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
                                        <p>Your shipping address form is here.</p>
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
