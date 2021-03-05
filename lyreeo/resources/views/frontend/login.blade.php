@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3  col-md-4 col-sm-4 col-xs-6 home-grid all-projects-grid login-tile">
                <a href="" data-toggle="modal" data-target="#exampleModal">
				<div class="home-box all-boxes human-box home-box-second">
                    <div class="home-box-inner">
                        <h2>{{ __('sentence.log_in')}}</h2>
                        <span> {{ __('sentence.discover_our_projects')}} </span>
                    </div>
                </div>
				</a>
            </div>
        </div>
    </div>
@endsection