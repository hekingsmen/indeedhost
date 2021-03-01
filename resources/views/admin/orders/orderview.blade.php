@extends('admin.layouts.app')

@section('content')

<div class="main-panel">

  <div class="container-fluid my-5 d-flex justify-content-center">

    <div class="card card-1">

        <div class="card-body">

            <div class="row justify-content-between mb-3">

                <div class="col-auto">

                    <h6 class="color-1 mb-0 change-color">List of Plan</h6>

                </div>

            </div>

            @foreach($order->items as $item)

            <div class="row">

                <div class="col">

                    <div class="card card-2">

                        <div class="card-body">

                            <div class="media">

                                <!-- <div class="sq align-self-center "> 

                                  <img class="img-fluid my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" src="https://i.imgur.com/RJOW4BL.jpg" width="135" height="135" /> 

                                </div> -->

                                <div class="media-body my-auto text-right">

                                    <div class="row my-auto flex-column flex-md-row">

                                        <div class="col my-auto">

                                            <h6 class="mb-0">{{ $item->item_name}}</h6>

                                        </div>

                                        <div class="col my-auto"> 

                                            <h6 class="mb-0">&#8377;{{ $item->item_price}}</h6>

                                        </div>

                                        <div class="col my-auto"> 

                                            <h6>

                                                <?php

                                                    if($item->duration == '2'){

                                                        echo "year";

                                                    }



                                                    if($item->duration == '1'){

                                                        echo "month";

                                                    }

                                                ?>

                                            </h6>

                                        </div>

                                        <div class="col my-auto">

                                            @if($item->status == 'process')

                                            <button type="button" id="test1" class="btn btn-info btn-sm process" data-id="{{$item->id}}" data-username="{{$item->username}}" data-domain="{{$item->domain}}" data-password="{{$item->password}}" data-massage ="{{$item->massage}}" data-email="{{$order->email}}" data-toggle="modal" data-target="#myModal">Process<div class="ripple-container"></div></button>

                                            @elseif($item->status == 'completed')

                                            <button type="button" id="test1" class="btn btn-basic btn-sm process" data-id="{{$item->id}}" data-username="{{$item->username}}" data-domain="{{$item->domain}}" data-password="{{$item->password}}" data-massage ="{{$item->massage}}" data-email="{{$order->email}}" data-toggle="modal" data-target="#myModal">Completed<div class="ripple-container"></div></button>

                                            @else

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

            <div class="row mt-4">

                <div class="col">

                    <div class="row justify-content-between">

                        <div class="col-auto">

                            <p class="mb-1 text-dark"><b>Order Details</b></p>

                        </div>

                        <div class="flex-sm-col text-right col">

                            <p class="mb-1"><b>Total</b></p>

                        </div>

                        <div class="flex-sm-col col-auto">

                            <p class="mb-1">&#8377;{{$order->sub_total}}</p>

                        </div>

                    </div>

                    <div class="row justify-content-between">

                        <div class="flex-sm-col text-right col">

                            <p class="mb-1"> <b>Discount</b></p>

                        </div>

                        <div class="flex-sm-col col-auto">

                            <p class="mb-1">&#8377;150</p>

                        </div>

                    </div>

                    <div class="row justify-content-between">

                        <div class="flex-sm-col text-right col">

                            <p class="mb-1"><b>GST 18%</b></p>

                        </div>

                        <div class="flex-sm-col col-auto">

                            <p class="mb-1">843</p>

                        </div>

                    </div>

                    <div class="row justify-content-between">

                        <div class="flex-sm-col text-right col">

                            <p class="mb-1"><b>Delivery Charges</b></p>

                        </div>

                        <div class="flex-sm-col col-auto">

                            <p class="mb-1">Free</p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- <div class="row invoice ">

                <div class="col">

                    <p class="mb-1"> Invoice Number : 788152</p>

                    <p class="mb-1">Invoice Date : 22 Dec,2019</p>

                    <p class="mb-1">Recepits Voucher:18KU-62IIK</p>

                </div>

            </div> -->

        </div>

        <div class="card-footer">

            <div class="jumbotron-fluid">

                <div class="row justify-content-between ">

                    <!-- <div class="col-sm-auto col-auto my-auto"><img class="img-fluid my-auto align-self-center " src="https://i.imgur.com/7q7gIzR.png" width="115" height="115"></div> -->

                    <div class="col-auto my-auto ">

                        <h2 class="mb-0 font-weight-bold">TOTAL PAID</h2>

                    </div>

                    <div class="col-auto my-auto ml-auto">

                        <h1 class="display-3 ">&#8377; {{$order->sub_total}}</h1>

                    </div>

                </div>

                <!-- <div class="row mb-3 mt-3 mt-md-0">

                    <div class="col-auto border-line"> <small class="text-white">PAN:AA02hDW7E</small></div>

                    <div class="col-auto border-line"> <small class="text-white">CIN:UMMC20PTC </small></div>

                    <div class="col-auto "><small class="text-white">GSTN:268FD07EXX </small> </div>

                </div> -->

            </div>

        </div>

    </div>

</div>

</div>



<!-- Modal -->

          <div class="modal fade" id="myModal" role="dialog">

            <div class="modal-dialog">

              <!-- Modal content-->

              <div class="modal-content">

                <div class="modal-header">

                  <h4 class="modal-title">Send Hosting Credentials</h4>

                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <form method="post" action="{{route('admin.orderprocess')}}">

                <div class="modal-body">

                    @csrf

                    <input type="hidden" name="orderid" id="orderid" value="">

                  <div class="">

                    <label for="useremail" class="col-form-label">Email address</label>

                    <input type="email" class="form-control" id="useremail" name="email" >

                  </div>

                  <div class="">

                    <label for="domain" class="col-form-label">Domain</label>

                    <input type="text" class="form-control" id="domain" name="domain" >

                  </div>

                  <div class="">

                    <label for="username" class="col-form-label">Username</label>

                    <input type="text" class="form-control" id="username" name="username" >

                  </div>

                  <div class="">

                    <label for="password" class="col-form-label">Password</label>

                    <input type="text" class="form-control" id="password" name="password" >

                  </div>

                  <div class="">

                    <label for="massage" class="col-form-label">Massage</label>

                    <textarea class="form-control" id="massage" name="massage" rows="3"></textarea>

                  </div>

                  <!-- <div class="form-group">

                    <input type="submit" name="submit" class="form-control">

                  </div> -->

                </div>

                <div class="modal-footer">

                    <button type="submit" name="submit" class="btn btn-info">Submit</button>

                 <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->

                </div>

                </form>

              </div>

            </div>

          </div>

@endsection



@push('scripts')

<script src="{{ asset('dashboard/assets/js/tinymce.min.js') }}" referrerpolicy="origin"></script>



<script>

      tinymce.init({

        selector: 'textarea#message',

        menubar: false

      });



    $(document.body).on('click', '.process', function(event) {

        $('#useremail').val($(this).data('email'));

        $('#orderid').val($(this).data('id'));

        $('#password').val($(this).data('password'));

        $('#domain').val($(this).data('domain'));

        $('#username').val($(this).data('username'));

        $('#massage').val($(this).data('massage'));

    });

</script>

@endpush