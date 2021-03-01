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
                                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->


     <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <!-- Related News Area -->
            <div class="related-news-area section-padding-80-0">
                <h2>My Profile</h2>
            </div>

            <div class="row" >
                <div class="col-12">
                    @include('layouts.flashmessages')
                </div>
            </div> 

            <div class="hami-contact-form mt-80 mb-30">
                
                <!-- <form action="{{route('Viewprofilepost')}}" method="post"> -->
                {{Form::model(array('url'=>route('Viewprofilepost'), 'class'=>'ajax-submit'))}}
                    <input type="hidden" name="user_id" value="{{$user->id}}">

                    <div class="row">
                        
                        <div class="col-12 col-lg-6">
                            <label class="form-control-label" for="name">Full Name</label>
                            <input type="text" id="name" class="form-control mb-30" name="name" placeholder="Full name" value="{{$user->name}}">
                            @if($errors->has('name'))
                              <div class="error" style="color: red; margin-bottom: 12px;" >{{ $errors->first('name') }}</div>
                          @endif
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-control-label" for="phone_number">Phone Number</label>
                            <input type="text" id="phone_number" class="form-control mb-30" name="phone_number" placeholder="Phone Number" value="{{$user->phone_number}}">
                            @if($errors->has('phone_number'))
                              <div class="error" style="color: red; margin-bottom: 12px;" >{{ $errors->first('phone_number') }}</div>
                          @endif
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-control-label" for="primary_number">Primary Phone</label>
                            <input type="text" id="primary_number" class="form-control mb-30" name="primary_number" placeholder="Primary Phone" value="{{$user->primary_number}}">
                            @if($errors->has('primary_number'))
                              <div class="error" style="color: red; margin-bottom: 12px;">{{ $errors->first('primary_number') }}</div>
                          @endif
                        </div>

                        

                        <div class="col-12 col-lg-6">
                            <label class="form-control-label" for="email">Email address</label>
                            <input type="email" id="email" class="form-control mb-30" name="email" placeholder="Email address" value="{{$user->email}}">
                            @if($errors->has('email'))
                              <div class="error" style="color: red; margin-bottom: 12px;">{{ $errors->first('email') }}</div>
                          @endif
                        </div>

                        <div class="col-12 col-lg-6">
                            <h2>Contact Information</h2>
                        </div>

                        <div class="col-12 col-lg-12">
                            <label class="form-control-label" for="input-address">Address</label>
                            <textarea id="address" name="address" class="form-control mb-30" placeholder="Address" > {{$user->address}} </textarea>
                            @if($errors->has('address'))
                              <div class="error" style="color: red; margin-bottom: 12px;">{{ $errors->first('address') }}</div>
                          @endif
                        </div>

                        <div class="col-12 col-lg-4">
                            <label class="form-control-label" for="city">City</label>
                            <input type="text" id="city" class="form-control mb-30" name="city" placeholder="City" value="{{$user->city}}">
                            @if($errors->has('city'))
                              <div class="error" style="color: red; margin-bottom: 12px;">{{ $errors->first('city') }}</div>
                          @endif
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="form-control-label" for="country">Country</label>
                            <input type="text" id="country" class="form-control mb-30" name="country" placeholder="Country" value="{{$user->country}}">
                            @if($errors->has('country'))
                              <div class="error" style="color: red; margin-bottom: 12px;">{{ $errors->first('country') }}</div>
                          @endif
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="form-control-label" for="postal_code">Postal code</label>
                            <input type="text" id="postal_code" class="form-control mb-30" name="postal_code" placeholder="Postal code" value="{{$user->postal_code}}">
                            @if($errors->has('postal_code'))
                              <div class="error" style="color: red; margin-bottom: 12px;">{{ $errors->first('postal_code') }}</div>
                          @endif
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn hami-btn btn-3 mt-15">Save profile</button>
                        </div>
                    </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection