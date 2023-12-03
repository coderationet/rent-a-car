@extends('front.layouts.app')
@section('title', $title)
@section('content')
    <div class="container payment-page page mx-auto flex gap-5 my-5">
        <div class="card w-full">
            <div class="card-header">
                <h3 class="text-center text-2xl">Payment Options</h3>
            </div>
            <div class="card-body">
                <div class="flex flex-row gap-8">
                    <div class="w-1/2">
                        <!-- Credit Card Info form -->
                        <form class="flex flex-col gap-5">
                            <div class="flex flex-col gap-1">
                                <label for="card-number" class="text-l pl-1">Card Number</label>
                                <input name="card-number" id="card-number" class="w-full border rounded" placeholder="Card Number" >
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="card-name" class="text-l pl-1">Card Name</label>
                                <input type="text" name="card-name" id="card-name" class="w-full border rounded" placeholder="Card Name">
                            </div>
                            <div class="flex flex-row gap-5">
                                <div class="flex flex-col gap-1 w-1/2">
                                    <label for="card-expiry" class="text-l pl-1">Expiry Date</label>
                                    <input type="text" name="card-expiry" id="card-expiry" class="w-full border rounded" placeholder="MM / YY">
                                </div>
                                <div class="flex flex-col gap-1 w-1/2">
                                    <label for="card-cvv" class="text-l pl-1">CVV</label>
                                    <input type="text" name="card-cvv" id="card-cvv" class="w-full border rounded" placeholder="CVV">
                                </div>
                            </div>
                            <div class="flex flex-row gap-5 justify-end">
                                <!-- Pay Button -->
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded">
                                    Pay Now
                                </button>
                            </div>
                            <input type="hidden" name="payment_method" value="credit-card">
                        </form>
                    </div>
                    <div class="hidden md:block w-1/2  ">
                        <div class="cc-card-animation pb-8">
                            <div class="cc-card">
                                <div class="cc-card-inner">
                                    <div class="front">
                                        <img src="{{asset('assets/img/map.png')}}" class="map-img">
                                        <div class="row">
                                            <img src="{{asset('assets/img/chip.png')}}" width="60px">
                                            <img src="{{asset('assets/img/visa.png')}}" width="60px">
                                        </div>
                                        <div class="row cc-card-no">
                                            <p id="cc-number-1">----</p>
                                            <p id="cc-number-2">----</p>
                                            <p id="cc-number-3">----</p>
                                            <p id="cc-number-4">----</p>
                                        </div>
                                        <div class="row cc-card-holder">
                                            <p>CARD HOLDER</p>
                                            <p>VALID TILL</p>
                                        </div>
                                        <div class="row name">
                                            <p id="card-name-holder">--- ---</p>
                                            <p id="card-expiry-holder">-- / --</p>
                                        </div>
                                    </div>
                                    <div class="back">
                                        <img src="{{asset('assets/img/map.png')}}" class="map-img">
                                        <div class="bar"></div>
                                        <div class="row cc-card-cvv">
                                            <div>
                                                <img src="{{asset('assets/img/pattern.png')}}">
                                            </div>
                                            <p id="card-cvv-holder">---</p>
                                        </div>
                                        <div class="row cc-card-text">
{{--                                            <p>this is a virtual card design using HTML and CSS. You can aslo design something like this.</p>--}}
                                        </div>
                                        <div class="row signature">
                                            <p>CUSTOMER SIGNATURE</p>
                                            <img src="{{asset('assets/img/visa.png')}}" width="80px">
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
@endsection
