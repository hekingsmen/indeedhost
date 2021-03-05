@extends('frontend.layouts.master')
@section('content')
<style type="text/css">
    .modal-homepage .modal-footer button.pop-btn {
        float: left; width: 54%;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">{{ __('Reset Password') }}</div> -->
                <div class="card-body">
            <!--    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>     -->

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{Form::open(array('url'=>route('sendResetPasswordMail'),'enctype'=>'multipart/form-data'))}}
                        <div class="modal-dialog modal-homepage" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                          </div>
                          <div class="modal-body">
                            <ul>
                                <li><span>Email Address</span>
                                    <input id="email" type="email" class="login-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @csrf
                                </li>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </ul>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pop-btn">{{ __('Send Password Reset Link') }}</button>
                          </div>
                        </div>
                      </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
