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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon_house_alt"></i>Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

   <!-- Features Area Start -->
    <section class="hami-price-plan-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Your Cart</h2>
                        <!-- <p>Our revolutionary Cloud solution is powerful, simple, and surprisingly affordable.</p> -->
                    </div>
                </div>
            </div>

            <div class="row">

         		<div class="col-12">


             			@if (count(Cart::content()))

            				<table class="table shopping-summery">

               					<thead>
				                  <tr class="main-hading">
				                     <th>PLAN NAME</th>
				                     <th class="text-center">PRICE (&#8377;)</th>
									  <th class="text-center">DURATION (Months)</th>
				                     <th class="text-center">TAX (%)</th>
				                     <th class="text-center">DISCOUNT </th>
				                     <th class="text-center">TOTAL (&#8377;)</th>
									 <th class="text-center">VIEW MORE</th>
				                     <th class="text-center"><i class="fa fa-trash"></i></th>
				                  </tr>

				               </thead>

				               <tbody id="cart_item_list">

					               @foreach (Cart::content() as $item)
									   @if($item->name!='child_entry')
						                <tr>
						                     <td class="product-des" style="text-align: left;" data-title="Description">
						                        <p class="product-name"> <a href="javascript:void(0);" target="_blank">{{$item->name}}</a> </p>
						                     </td>
						                     <td class="price" style="text-align: center;" data-title="Price"><span>{{$item->price}}</span></td>
											<td class="price" style="text-align: center;" data-title="Price"><span>
													{{$item->options['plan_duration']}}
												</span></td>
						                     <td class="price" style="text-align: center;" data-title="Price"><span>{{$item->taxRate}}</span></td>
						                     <td class="price" style="text-align: center;" data-title="Price">

											 	@if( $item->options['type'] == 'percentage' )
													 <span>{{$item->discountRate}}</span> %
												 @elseif( $item->options['type'] == 'flat' )
													 &#8377; <span>{{$item->options['discount']}}</span>
												 @endif

											 </td>
						                     <td class="total-amount cart_single_price" style="text-align: center;" data-title="Total"><span class="money">{{$item->total}}</span></td>

											<td class="total-amount cart_single_price" style="text-align: center;" data-title="Total"><span class="money"> <a class="showDetails_{{$item->rowId}}" href="javascript:void(0);" >View</a> </span></td>

						                     <td class="css-me action" data-title="Remove" style="text-align: center;"><a href="{{route('deletecart',$item->rowId)}}">
						                     	<i class="fa fa-trash"></i></a>
						                     </td>
						                </tr>

											@foreach(Cart::content() as $row)
												@if( $item->id == $row->id && $row->rowId != $item->rowId )

														<tr style="background: lightblue; vertical-align: middle;  border: deepskyblue; text-align: center " class="showOnClick" >
															<td  class="price" style="text-align: center;" data-title="Price"><span> discount: {{$row->options['discount'] }} </span></td>

															<td  class="price" style="text-align: center;" data-title="Price"><span>Code : {{$row->options['code'] }}</span></td>

															<td  class="price" style="text-align: center;" data-title="Price"><span>Discount Amount: {{$row->options['discountAmount'] }} </span></td>
														</tr>

												@endif
											@endforeach


									@endif
					                @endforeach

				               </tbody>

            				</table>

            			@else

            				<div class="alert alert-info text-center m-0" role="alert">

                				Your Cart is <b>empty</b>.
            				</div>

            			@endif

         		</div>


      		</div>


			@if (count(Cart::content()))

	      		<div class="row">
		         	<div class="col-md-4 order-md-2 mb-4">

						<h2>You Pay</h2>

			            <ul class="list-group mb-3">

			                <li class="list-group-item d-flex justify-content-between lh-condensed">
			                  <div>
			                    <h6 class="my-0">Discount</h6>
			                    <!-- <small class="text-muted">Brief description</small> -->
			                  </div>
			                  <span class="text-muted"><p style="color: green; font-weight: bold; display: inline-flex;" >-</p> {{\Cart::discount()}}</span>
			                </li>

			                <li class="list-group-item d-flex justify-content-between lh-condensed">
			                  <div>
			                    <h6 class="my-0">Cart Subtotal</h6>
			                    <!-- <small class="text-muted">Brief description</small> -->
			                  </div>
			                  <span class="text-muted">{{\Cart::subtotal()}}</span>
			                </li>

			                <li class="list-group-item d-flex justify-content-between lh-condensed">
			                  <div>
			                    <h6 class="my-0">Tax</h6>
			                  </div>
			                  <span class="text-muted"><p style="color: green; font-weight: bold; display: inline-flex;" >+</p>{{ Cart::tax() }}</span>
			                </li>

			                <li class="list-group-item d-flex justify-content-between lh-condensed">
			                  <div>
			                    <h6 class="my-0">Total</h6>
			                    <!-- <small class="text-muted">Brief description</small> -->
			                  </div>
			                  <!-- <span class="text-muted">{{\Cart::priceTotal()}}</span> -->
			                  <span class="text-muted">{{\Cart::total()}}</span>
			                </li>

							<li class="list-group-item d-flex justify-content-between lh-condensed">
{{--								<a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--								   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" > {{ __('Apply Code') }}</a>--}}

								<form id="logout-form" action="javascript:void(0)" method="POST" class="">
									@csrf
									<a class="btn themebtn applyCode" id="applyCode" href="javascript:void(0)" data-code="xvcbv" onclick="applyCode(  ); " >Apply Code</a>
									<input type="text" name="offerCode" id="offerCode" value="">
									<div class="isValidCodeOrNot"  id="isValidCodeOrNot"></div>
								</form>

							</li>

			                <li class="list-group-item d-flex justify-content-between lh-condensed">
			                  <a class="btn themebtn" href="{{route('checkout')}}">Checkout Now</a>
			                </li>
			            </ul>

		            </div>
	      		</div>

	      	@endif

        </div>

    </section>

@endsection




@section('scripts')

	<script>

		function opearteDiscountDetails(){

		}

	function applyCode(){

		var code = $('#applyCode').attr('data-code');
		var route ="{{ route('apply.code') }}";

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.post(
				route,
				{code:code},
				function (data) {
					if(data.success==true){
						$("#isValidCodeOrNot").empty();
						$( "#isValidCodeOrNot" ).append( "<strong style='color: green;' > "+ data.msg +" </strong>" );
						removeMsg();

					}else{
						$("#isValidCodeOrNot").empty();
						$( "#isValidCodeOrNot" ).append( "<strong style='color: red;' > "+ data.msg +" </strong>" );
						removeMsg();
					}

					if(data.reload==true){
						reload();
					}

				}
		);

	}


	function reload(){
		location.reload().delay(3000);
	}


	$(document).ready(function() {
		$("#offerCode").keyup(function() {
			var code = $(this).val();
			$('.applyCode').attr("data-code",code);
		});
	})

	function removeMsg(){
		setTimeout(function(){
			$("#isValidCodeOrNot").empty();
		}, 5000);
	}



</script>

@endsection
