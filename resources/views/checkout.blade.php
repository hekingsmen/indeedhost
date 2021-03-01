@extends('forntend.layouts.shortheader')
@section('content')
      

    
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon_house_alt"></i> Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkput</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->


      <section class="hami-price-plan-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Choose a payment method</h2>
                    </div>
                </div>
            </div>




        <div class="row">

            <div class="col-lg-4 checkout">

               <div class="order-details">

                <h3>Order Summary</h3>

                  <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-condensed">

                      <div>

                        <h6 class="my-0">Cart Subtotal</h6>

                        <!-- <small class="text-muted">Brief description</small> -->

                      </div>

                      <span class="text-muted">{{\Cart::subtotal()}}</span>

                      <input type="hidden" name="{{\Cart::subtotal()}}" name="subtotal">

                    </li>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Tax</h6>
                      </div>
                      <span class="text-muted">{{ Cart::tax() }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">

                      <div>

                        <h6 class="my-0">Discount</h6>

                        <!-- <small class="text-muted">Brief description</small> -->

                      </div>

                      <span class="text-muted">{{\Cart::discount()}}</span>

                      <input type="hidden" name="{{\Cart::discount()}}" name="discount">

                    </li>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">

                      <div>

                        <h6 class="my-0">Total</h6>

                        <!-- <small class="text-muted">Brief description</small> -->

                      </div>

                      <!-- <span class="text-muted">{{\Cart::priceTotal()}}</span> -->
                      <span class="text-muted">{{\Cart::total()}}</span>

                      <input type="hidden" name="{{\Cart::priceTotal()}}" name="totalprice">

                    </li>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">

                  </ul>

               </div>

            </div>

            <div class="col-lg-8 row" style=" padding-top: 12%; padding-left: 6px;">

              <div class="paymentbtn col-lg-6">
                <a href="{{route('Payment','paypal')}}">
                  <img src="{{ asset('assets/img/PayPal-PayNow-Button.png') }}">
                </a>
              </div>

              <div class="paymentbtn col-lg-6"  >
                <a href="javascript:void(0)" class="razorpay">
                  <img src="{{ asset('assets/img/razorpay.png') }}">
                </a>
              </div>

            </div>

         </div>


        </div>

        <!-- Feature Pattern -->
        <div class="feature-pattern">
            <img src="img/core-img/welcome-pattern.png" alt="">
        </div>
    </section> 


    <div class="razoreform" style="display: none;">
  		<button id="rzp-button1">Pay</button>
	</div>

@endsection

@section('scripts')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script type="text/javascript">

  $(".razorpay").on("click", function(){

    $.ajax({
    url: "{{route('Payment','razorpay')}}",
    method: 'get',
    data: {
    },
    success: function(result){
       eval(result);
       $('#rzp-button1').click();
    }});

  });

</script>

@endsection

@push('styles')

<style type="text/css">
  .paymentbtn { 
    width: 180px;
    margin: 18px;
}

.paymentbtn img{
  width:100%;
}
</style>

@endpush
