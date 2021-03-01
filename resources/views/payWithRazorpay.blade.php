<?php
use Razorpay\Api\Api;
$api = new Api('rzp_test_1X89VZfE2BwKd7', 'AMBOe1vJZfhd1zRpjS1HAm7E');
$order  = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR'));
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>How To Integrate Razorpay Payment Gateway In Laravel 8 - phpcodingstuff.com</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">
                        @if($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong> {{ $message }}
                            </div>
                        @endif
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong> {{ $message }}
                            </div>
                        @endif
                        <div class="card card-default">
                            <div class="card-header">
                                How To Integrate Razorpay Payment Gateway In Laravel 8 - phpcodingstuff.com
                            </div>

                            <div class="card-body text-center">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
<form action="{{ route('payment') }}" method="POST" >
@csrf
<script src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="{{ env('RAZOR_KEY') }}"
    data-amount="100"
    data-currency="INR"
    data-order_id="{{$order->id}}"
    data-buttontext="product_price"
    data-buttonid="product_price"
    data-name="Php Coding Stuff"
    data-description="Rozerpay"
    data-image="{{ asset('/image/phpcodingstuff.png') }}"
    data-prefill.name="name"
    data-prefill.email="email"
    data-theme.color="#ff752950">
</script>
</form>
</html>