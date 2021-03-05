@extends('admin.layouts.app')
<style>
    .tableHeading{ font-weight: 600; }
    .fontWeight { font-weight: 500; }
    .modal-body.textleft { margin-left: 20px; }
</style>
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Order History</h4>
                                <p class="card-category">List of order history</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th style="font-weight: 500;" >#</th>
                                                <th style="font-weight: 500;">Item Name</th>
                                                <th style="font-weight: 500;">Item Price</th>
                                                <th style="font-weight: 500;">Tax Rate</th>
                                                <th style="font-weight: 500;">Discount</th>
                                                <th style="font-weight: 500;">Total</th>
                                                <th style="font-weight: 500;">STATUS</th>
                                                <th style="font-weight: 500;" >View Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @if(!empty(count($orders)>0))
                                            @foreach( $orders as $index =>$order )
                                                <tr>
                                                    <th class="tableHeading" scope="row">1</th>
                                                    <td class="tableHeading" >{{$order->item_name}}</td>
                                                    <td class="tableHeading" >{{$order->item_price}}</td>
                                                    <td class="tableHeading" >{{$order->taxrate}}</td>
                                                    <td class="tableHeading" >@if(!empty($order->discountRate)) {{$order->discountRate}} @else {{__('0')}} @endif</td>
                                                    <td class="tableHeading"><h6 class="mb-0"> {{$order->total_price}} </h6></td>
                                                    <td class="tableHeading">
                                                        <h6 class="mb-0">
                                                            @if($order->payment_status=='paid')
                                                                <p style="color: green; font-weight: bold;" >  {{ __('PAID') }}
                                                            @else
                                                                <p style="color: red; font-weight: bold;" >  {{ __('UNPAID') }}
                                                            @endif
                                                        </h6>
                                                    </td>
                                                    <td><button type="button" class="btn themebtn" data-toggle="modal" data-target="#order{{$order->id}}"> Order Detail </button></td>













                                    <!-- Modal for order detail view -->
                                    <div class="modal fade" id="order{{$order->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="orderLabel{{$order->id}}" aria-hidden="true">
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
                                                        <div class="col-md-6">
                                                            <b>Plan Title :</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="fontWeight" >{{$order->item_name}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Plan Price :</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="fontWeight" >{{$order->sub_total}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Payment Status :</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if($order->payment_status=='paid')
                                                                <p style="color: green; font-weight: bold;" >  {{ __('PAID') }}</p>
                                                            @else
                                                                <p style="color: red; font-weight: bold;" >  {{ __('UNPAID') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Plan Activation:</b>
                                                        </div>
                                                        <div class="col-md-6" style="display: inline-flex;" >
                                                            @php
                                                                $date = date('d-M-Y', strtotime( str_replace('/', '-', $order->created_at)));
                                                            @endphp
                                                            <p class="fontWeight"  style="color: green;" >{{$date}} <p style="color: black; font-weight: bold;" ></p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Plan Expiry:</b>
                                                        </div>
                                                        <div class="col-md-6" style="display: inline-flex;" >
                                                            @php
                                                                $expired_date = date('d-M-Y', strtotime( str_replace('/', '-', $order->expired_at)));
                                                            @endphp
                                                            <p class="fontWeight"  style="color: red;" >{{$expired_date}}</p>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Primary Domain:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if(!empty($order->domain))
                                                                <input type="text" class="form-control" id="{{$order->id}}domain" value="{{$order->domain}}">
                                                                <span class="fontWeight"  onclick="copyToClipboard('#{{$order->id}}domain')">Copy</span>
                                                            @else
                                                                <span class="fontWeight" >{{__('Not Provided Yet.')}}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>cPanel login username:</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if(!empty($order->username))
                                                                <input type="text" class="form-control" id="{{$order->id}}username" value="{{$order->username}}">
                                                                <span class="fontWeight" onclick="copyToClipboard('#{{$order->id}}username')">Copy</span>
                                                            @else
                                                                <span class="fontWeight" >{{__('Not Provided Yet.')}}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <b>Password :</b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if(!empty($order->password))
                                                                <input type="password" class="form-control" id="{{$order->id}}password" value="{{$order->password}}">
                                                                <span class="fontWeight" onclick="passhideshow('{{$order->id}}password',this)">Show</span>
                                                                <span class="fontWeight" onclick="copyToClipboard('#{{$order->id}}password')">Copy</span>
                                                            @else
                                                                <span class="fontWeight" >{{__('Not Provided Yet.')}}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- modal view for order detail view -->
                                            </tr>
                                            @endforeach
                                        @else

                                        @endif

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush