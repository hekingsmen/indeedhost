@extends('layouts.app')
@section('content')

<style type="text/css">td{text-align: center;}td.product-des{text-align: left;}</style>

<div class="shopping-cart section">

   <div class="container">

      <div class="row">

         <div class="col-12">

            <!-- Shopping Summery -->

            <track>

             @if (count(Cart::content()))

            <table class="table shopping-summery">

               <thead>

                  <tr class="main-hading">

                     <th>PLAN NAME</th>

                     <th class="text-center">PRICE</th>

                     <th class="text-center">TAX (%)</th>

                     <th class="text-center">DISCOUNT (%)</th>

                     <th class="text-center">TOTAL</th>

                     <th class="text-center"><i class="icofont-ui-delete"></i></th>

                  </tr>

               </thead>

               <tbody id="cart_item_list">

               @foreach (Cart::content() as $item)

                <tr>

                     <td class="product-des" data-title="Description">

                        <p class="product-name">
                            <a href="#" target="_blank">{{$item->name}}</a>
                        </p>

                     </td>

                     <td class="price" data-title="Price"><span>{{$item->price}}</span></td>

                     <td class="price" data-title="Price"><span>{{$item->taxRate}}</span></td>

                     <td class="price" data-title="Price"><span>{{$item->discountRate}}</span></td>

                     <td class="total-amount cart_single_price" data-title="Total"><span class="money">{{$item->total}}</span></td>
                     
                     <td class="action" data-title="Remove"><a href="{{route('deletecart',$item->rowId)}}"><i class="icofont-ui-delete"></i></a></td>

                  </tr>

                @endforeach

               </tbody>

            </table>

            @else

            <div class="alert alert-info text-center m-0" role="alert">

                Your Cart is <b>empty</b>.

            </div>

            @endif

            <!--/ End Shopping Summery -->

         </div>

      </div>

      @if (count(Cart::content()))

      <div class="row">

         <div class="col-md-4 order-md-2 mb-4">

              <h4 class="d-flex justify-content-between align-items-center mb-3">

                <span class="text-muted">You Pay</span>

              </h4>

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
                  <a class="btn themebtn" href="{{route('checkout')}}">Checkout Now</a>
                </li>

              </ul>

            </div>

      </div>

      @endif

   </div>

</div>

@endsection

