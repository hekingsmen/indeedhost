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
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                		</div>
                	</div>
                </div>
                    
                <form method="POST" action="{{ route('password.email') }}">

                    @csrf
                    
                    <div class="row child" >
                    	<div class="col-12 col-lg-6" style=" margin: 0 auto;" >
                            
                            <label for="email" class="col-md-4 form-control-label" for="name">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control mb-30 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                  
                                @error('email')
                                    <span class="invalid-feedback" style="margin-bottom: 14px"  role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>


                    <div class="row child" style="text-align: end;" >
                    	<div class="col-12 col-lg-6 child " style=" margin: 0 auto;" >
                    		<div class="col-12">
                            	<button type="submit" class="btn hami-btn btn-3 mt-15">{{ __('Send Password Reset Link') }}</button>
                    		</div>
                    	</div>
                    </div>


                </form>

                    <div class="row child" style="margin-bottom: 5px;" >
                        <div class="col-12 col-lg-6 child " style=" margin: 0 auto;" >
                            <div class="col-12">
                                <a href="{{ route('login') }}"  class="ohoverchangecolor text-center" >{{ __('Login') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="row child"  >
                        <div class="col-12 col-lg-6 child " style=" margin: 0 auto;" >
                            <div class="col-12">
                                <a href="{{ route('register') }}" class="ohoverchangecolor text-center" >{{ __('Register') }}</a>
                            </div>
                        </div>
                    </div>

   

                    
            </div>
        </div>
    </div>


@endsection

@push('styles')
<style type="text/css">
.ohoverchangecolor a:hover
{
    color:#white;
}
</style>

@endpush