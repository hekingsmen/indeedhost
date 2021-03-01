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
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Reset Password') }}</li>
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
        

            <!-- Leave A Reply -->
            <div class="hami-contact-form mt-80 mb-30 container">

                <div class="row child" >
                	<div class="col-12 col-lg-6 child " style=" margin: 0 auto;" >
                		<div class="col-12">
                        	@include('layouts.flashmessages')
                		</div>
                	</div>
                </div>
                
                {{Form::model(array('url'=>route('Viewprofilepost'), 'class'=>'ajax-submit'))}}
                    
                    <div class="row child" >
                    	<div class="col-12 col-lg-6" style=" margin: 0 auto;" >
                            
                            <label for="name" class="col-md-4 form-control-label" for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control mb-30 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                  
                                @error('name')
                                    <span class="invalid-feedback" style="margin-bottom: 14px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>


                    <div class="row child" >
                        <div class="col-12 col-lg-6" style=" margin: 0 auto;" >
                            
                            <label for="email" class="col-md-4 form-control-label" for="name">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control mb-30 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                            
                                @error('email')
                                    <span class="invalid-feedback" style="margin-bottom: 14px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>


                    <div class="row child" >
                        <div class="col-12 col-lg-6" style=" margin: 0 auto;" >
                            
                            <label for="password" class="col-md-4 form-control-label" for="name">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control mb-30 @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                            
                                @error('password')
                                    <span class="invalid-feedback " style="margin-bottom: 14px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>


                    <div class="row child" >
                        <div class="col-12 col-lg-6" style=" margin: 0 auto;" >
                            <label for="password-confirm" class="col-md-4 form-control-label" for="name">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control mb-30" name="password_confirmation"  autocomplete="new-password">
                            
                                @error('password')
                                    <span class="invalid-feedback" style="margin-bottom: 14px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>


                    <div class="row child" style="text-align: end;" >
                    	<div class="col-12 col-lg-6 child " style=" margin: 0 auto;" >
                    		<div class="col-12">
                            	<button type="submit" class="btn hami-btn btn-3 mt-15">{{ __('Register') }}</button>
                    		</div>
                    	</div>
                    </div>


                {{ Form::close() }}

                    <div class="row child"  >
                        <div class="col-12 col-lg-6 child " style=" margin: 0 auto;" >
                            <div class="col-12">
                                <a href="{{ route('login') }}" class="text-center" >Already Registered ?</a>
                            </div>
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>


@endsection

@push('styles')
<style type="text/css">

</style>

@endpush