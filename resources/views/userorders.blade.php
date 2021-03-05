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
                                <li class="breadcrumb-item active" aria-current="page">Order History</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Price Plan Area Start -->
    <section class="hami-price-plan-area section-padding-100-0" >
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Your order history</h2>
                        <!-- <p>You want custom hosting plan. No hidden charge.</p> -->
                    </div>
                </div>
            </div>


               <div class="row">

      <div class="col">

          <table class="table shopping-summery">
              <thead>

                  <tr class="main-hading">

                     <th>PLAN NAME</th>

                     <th class="text-center">PRICE</th>

                     <th class="text-center">TAX (%)</th>

                     <th class="text-center">DISCOUNT (%)</th>

                     <th class="text-center">TOTAL</th>

                     <th class="text-center">STATUS</th>

                     <th class="text-center"></th><th class="text-center"></th>

                     <th class="text-center">VIEW DETAIL</th>

                  </tr>

               </thead>
             </table>
          @foreach($orders as $order)

         <div class="card card-2">

            <div class="card-body">

               <div class="media">

                  <div class="media-body my-auto text-right">

                     <div class="row my-auto flex-column flex-md-row">

                        <div class="col my-auto">
                           <h6 class="mb-0">{{$order->item_name}}</h6>
                        </div>

                        <div class="col my-auto">
                           <h6 class="mb-0">{{$order->item_price}}</h6>
                        </div>

                        <div class="col my-auto">
                           <h6 class="mb-0">{{$order->taxrate}}</h6>
                        </div>

                        <div class="col my-auto">
                          <h6 class="mb-0">
                            @if(!empty($order->discountRate)) {{$order->discountRate}} @else {{__('0')}} @endif
                          </h6>
                        </div>

                        <div class="col my-auto">
                          <h6 class="mb-0"> {{$order->total_price}} </h6>
                        </div>
                        
                        <div class="col my-auto">
                           <h6 class="mb-0">
                            @if($order->payment_status=='paid')
                            <p style="color: green; font-weight: bold;" >  {{ __('PAID') }}
                            @else 
                            <p style="color: red; font-weight: bold;" >  {{ __('UNPAID') }}
                            @endif
                           </h6>
                        </div>

                        <div class="col my-auto">
                          <button type="button" class="btn themebtn" data-toggle="modal" data-target="#order{{$order->id}}"> Order Detail </button>
                        </div>

                     </div>


                     	<!-- Modal for order detail view -->
        <div class="modal fade" id="order{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="orderLabel{{$order->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                   

                  <div class="modal-header">
                      <h5 class="modal-title" id="orderLabel{{$order->id}}">Order Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        	<span aria-hidden="true">&times;</span>
                        </button>
                  </div>

                  <div class="modal-body textleft">

                      <div class="row">
                          <div class="col-md-4">
                             <b>Plan Title :</b>
                          </div>

                          <div class="col-md-8">
                              <p>{{$order->item_name}}</p>
                          </div>
                      </div>


        							<div class="row">
        								<div class="col-md-4">
        									<b>Plan Price :</b>
        								</div>

        								<div class="col-md-8">
        									<p>{{$order->sub_total}}</p>
        								</div>
        							</div>


                      <div class="row">
                          <div class="col-md-4">
                          	<b>Payment Status :</b>
                          </div>

                          <div class="col-md-8">

        									@if($order->payment_status=='paid')
        										<p style="color: green; font-weight: bold;" >  {{ __('PAID') }}  </p>
        									@else 
        										<p style="color: red; font-weight: bold;" >  {{ __('UNPAID') }}  </p>
        									@endif
        								
                          </div>
                      </div>



                      <div class="row">
                          <div class="col-md-4">
                              <b>Plan Activation & Expiry:</b>
                          </div>

                          <div class="col-md-8" style="display: inline-flex;" >
                            
        									@php  
        										$date = date('d-M-Y', strtotime( str_replace('/', '-', $order->created_at)));
        										$expired_date = date('d-M-Y', strtotime( str_replace('/', '-', $order->expired_at)));
        									@endphp

                          	<p style="color: green;" >{{$date}} <p style="color: black; font-weight: bold;" >&nbsp / &nbsp</p>  <p style="color: red;" >{{$expired_date}}</p></p>
                              
                          </div>
                      </div>


        							<div class="row">
        								<div class="col-md-4">
        								   <b>Primary Domain:</b>
        								</div>

        								<div class="col-md-8">
        								    <input type="text" class="form-control" id="{{$order->id}}domain" value="{{$order->domain}}">
        								    <span onclick="copyToClipboard('#{{$order->id}}domain')">Copy</span>
        								</div>
        							</div>




        							<div class="row">
        								<div class="col-md-4">
        									<b>cPanel login username:</b>
        								</div>

        								<div class="col-md-8">
        									<input type="text" class="form-control" id="{{$order->id}}username" value="{{$order->username}}">
        									<span onclick="copyToClipboard('#{{$order->id}}username')">Copy</span>
        								</div>
        							</div>


        							<div class="row">
        								<div class="col-md-4">
        									<b>Password :</b>
        								</div>

        								<div class="col-md-8">
        									<input type="password" class="form-control" id="{{$order->id}}password" value="{{$order->password}}">
        									<span onclick="passhideshow('{{$order->id}}password',this)">Show</span>
        									<span onclick="copyToClipboard('#{{$order->id}}password')">Copy</span>
        								</div>
        							</div>

                  </div>

					       </div>
                </div>
            </div>
                     	<!-- modal view for order detail view -->



                  </div>

               </div>

            </div>

         </div>

         @endforeach
         
      </div>

   </div>

        </div>

    </section>




        @if(!empty($order))

            <div class="modal fade" id="order{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="orderLabel{{$order->id}}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="orderLabel{{$order->id}}">Order Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body textleft">

                            <div class="row">
                                <div class="col-md-4">
                                    <b>Plan Title :</b>
                                </div>

                                <div class="col-md-8">
                                    <p>{{$order->item_name}}</p>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <b>Plan Price :</b>
                                </div>

                                <div class="col-md-8">
                                    <p>{{$order->sub_total}}</p>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <b>Payment Status :</b>
                                </div>

                                <div class="col-md-8">

                                    @if($order->payment_status=='paid')
                                        <p style="color: green; font-weight: bold;" >  {{ __('PAID') }}  </p>
                                    @else
                                        <p style="color: red; font-weight: bold;" >  {{ __('UNPAID') }}  </p>
                                    @endif

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <b>Plan Activation & Expiry:</b>
                                </div>

                                <div class="col-md-8" style="display: inline-flex;" >

                                    @php
                                        $date = date('d-M-Y', strtotime( str_replace('/', '-', $order->created_at)));
                                        $expired_date = date('d-M-Y', strtotime( str_replace('/', '-', $order->expired_at)));
                                    @endphp

                                    <p style="color: green;" >{{$date}} <p style="color: black; font-weight: bold;" >&nbsp / &nbsp</p>  <p style="color: red;" >{{$expired_date}}</p></p>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <b>Primary Domain:</b>
                                </div>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="{{$order->id}}domain" value="{{$order->domain}}">
                                    <span onclick="copyToClipboard('#{{$order->id}}domain')">Copy</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <b>cPanel login username:</b>
                                </div>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="{{$order->id}}username" value="{{$order->username}}">
                                    <span onclick="copyToClipboard('#{{$order->id}}username')">Copy</span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <b>Password :</b>
                                </div>

                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="{{$order->id}}password" value="{{$order->password}}">
                                    <span onclick="passhideshow('{{$order->id}}password',this)">Show</span>
                                    <span onclick="copyToClipboard('#{{$order->id}}password')">Copy</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    @endif










@endsection
   


 @push('scripts')

 <script type="text/javascript">

   function copyToClipboard(element) {
   	alert('he');

     $(element).select();

     document.execCommand("copy");

     alert('Copied');

   }



  function passhideshow(element,that) {

    //alert(element);

    var x = document.getElementById(element);

    if (x.type === "password") {

      x.type = "text";

      //that.innerHTML='';

      that.innerHTML='Hide';

    } else {

      x.type = "password";

      that.innerHTML='Show';

    }

  }



 </script>

 @endpush

@push('styles')
<style type="text/css">
	
	.section-padding-100-0 {
	    padding-top: 50px;
	    padding-bottom: 0;
	}

   .textleft{
    	text-align: left;
   }

</style>
@endpush
