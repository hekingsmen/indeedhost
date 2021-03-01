@extends('layouts.app')

@section('content')

<section class="shop checkout section">

   <div class="container">

    <h3>Choose a Payment Method</h3>

      <!-- <form class="form" method="POST" action="#">

         @csrf -->

         <div class="row">

            <div class="col-lg-8 row">

              <div class="paymentbtn col-lg-3">

                <a href="{{route('Payment','paypal')}}">

                <img src="{{ asset('assets/img/PayPal-PayNow-Button.png') }}">

              </a>

              </div>

              <div class="paymentbtn col-lg-3">

                <a href="javascript:void(0)" class="razorpay">

                <img src="{{ asset('assets/img/razorpay.png') }}">

              </a>

              </div>

              {{--

               <div class="checkout-form">

                  <h2>Make Your Checkout Here</h2>

                  <p>Please register in order to checkout more quickly</p>

                  <!-- Form -->

                  <div class="row">

                     <div class="col-lg-6 col-md-6 col-12">

                        <div class="form-group">

                           <label>First Name<span>*</span></label>

                           <input type="text" class="form-control" name="first_name" placeholder="" value="">

                        </div>

                     </div>

                     <div class="col-lg-6 col-md-6 col-12">

                        <div class="form-group">

                           <label>Last Name<span>*</span></label>

                           <input type="text" class="form-control" name="last_name" placeholder="" value="">

                        </div>

                     </div>

                     <div class="col-lg-6 col-md-6 col-12">

                        <div class="form-group">

                           <label>Email Address<span>*</span></label>

                           <input type="email" class="form-control" name="email" placeholder="" value="">

                        </div>

                     </div>

                     <div class="col-lg-6 col-md-6 col-12">

                        <div class="form-group">

                           <label>Phone Number <span>*</span></label>

                           <input type="number" class="form-control" name="phone" placeholder="" required="" value="">

                        </div>

                     </div>

                     <div class="col-lg-6 col-md-6 col-12">

                        <div class="form-group">

                           <label>Country<span>*</span></label>

                           <select name="country" class="form-control" id="country">

                            @foreach($country as $con)

                              <option value="{{$con->id}}">{{$con->name}}</option>

                            @endforeach

                           </select>

                        </div>

                     </div>

                     <div class="col-lg-6 col-md-6 col-12">

                        <div class="form-group">

                           <label>Address Line 1<span>*</span></label>

                           <input type="text" class="form-control" name="address1" placeholder="" value="">

                        </div>

                     </div>

                     <div class="col-lg-6 col-md-6 col-12">

                        <div class="form-group">

                           <label>Address Line 2</label>

                           <input type="text" class="form-control" name="address2" placeholder="" value="">

                        </div>

                     </div>

                     <div class="col-lg-6 col-md-6 col-12">

                        <div class="form-group">

                           <label>Postal Code</label>

                           <input type="text" class="form-control" name="post_code" placeholder="" value="">

                        </div>

                     </div>

                  </div>

                  <!--/ End Form -->

               </div>

               --}}

            </div>

            <div class="col-lg-4 col-12 checkout">

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

                    <!--  <div class="content">

                        <h2>Payments</h2>

                        <div class="checkbox">

                           <form-group>

                              <input name="payment_method" type="radio" value="cod"> <label> Cash On Delivery</label><br>

                              <input name="payment_method" type="radio" value="paypal"> <label> PayPal</label> 

                           </form-group>

                        </div>

                        <button type="submit" class="btn themebtn">proceed to checkout</button>

                     </div>

                    </li> -->

                  </ul>

                  <!--/ End Button Widget -->

               </div>

            </div>

         </div>

      <!-- </form> -->

   </div>

</section>

<div class="razoreform" style="display: none;">

  <button id="rzp-button1">Pay</button>

</div>

@endsection

@push('scripts')

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

@endpush

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