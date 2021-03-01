<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="descriptison">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  	<meta content="" name="keywords">
    <!-- Title -->
    <title>Indeed Host</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('ecohost/img/core-img/favicon.png') }}">
    <!-- <link href="{{ asset('assets/img/favicon.png') }}" rel="icon"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('ecohost/style.css') }}">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

</head>
 
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- /Preloader -->

    <!-- Header Area Start -->
    <header class="header-area">
        <!-- Top Header Area Start -->
        <div class="top-header-area">
            <div class="container">
                <div class="row">

                    <div class="col-6">
                        <div class="top-header-content">
                            <a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i> <span>Call Us: 010-4321-9874</span></a>
                            <a href="javascript:void(0)"><i class="fa fa-envelope" aria-hidden="true"></i> <span>Email: skr.illex@nomail.com</span></a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="top-header-content">
                            <!-- Login -->

                        	@guest

            	              @if (Route::has('login'))
				                      <a href="{{ route('login') }}"><i class="fa fa-lock" aria-hidden="true"></i> <span>{{ __('Login') }}</span></a><a href="{{ route('register') }}"><span>{{ __('/ Register') }}</span></a>
				              @endif

                        	@endif


                            @guest
                            	<!-- Language -->
	                            <div class="dropdown">
	                                <a class="btn pr-0 dropdown-toggle" href="#" role="button" id="langdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="img/core-img/eng.png" alt=""> English</a>
	                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langdropdown">
	                                    <a class="dropdown-item" href="#">- Latvian</a>
	                                    <a class="dropdown-item" href="#">- Hindi</a>
	                                    <a class="dropdown-item" href="#">- Bangla</a>
	                                </div>
	                            </div>
                            @else
                             	<div class="dropdown">
	                                <a class="btn pr-0 dropdown-toggle" href="#" role="button" id="langdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}</a>
	                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langdropdown">

                                        @if(Auth::user()->is_admin==1)
                                            <a class="dropdown-item" href="{{route('admin.home')}}"> {{__('Dashboard')}}</a>
                                        @endif
                                        <a class="dropdown-item" href="{{route('Viewprofile')}}"> {{__('Your Profile')}}</a>
	                                    <a class="dropdown-item" href="{{route('userOrder')}}"> {{__('Order History')}}</a>
	                                    <a class="dropdown-item" href="{{ route('logout') }}" 
	                                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();" > {{ __('Logout') }}</a>
	                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
	                                </div>
	                            </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Top Header Area End -->

        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="hamiNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="{{ route('homepage') }}"><img src="{{ asset('ecohost/img/core-img/logo.png') }}" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            
                            <!-- Nav Start -->
                            	@include('forntend.layouts.navbar')
                            <!-- Nav End -->

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->




		@yield('content')
		

		
	   <!-- Footer Area Start -->
    <footer class="footer-area section-padding-80-0">

		@include('forntend.layouts.footer')

    </footer>
    <!-- Footer Area End -->

    <!-- **** All JS Files ***** -->
    <!-- jQuery 2.2.4 -->
    <script src="{{ asset('ecohost/js/jquery.min.js') }}"></script>
    <!-- Popper -->
    <script src="{{ asset('ecohost/js/popper.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('ecohost/js/bootstrap.min.js') }}"></script>
    <!-- All Plugins -->
    <script src="{{ asset('ecohost/js/hami.bundle.js') }}"></script>
    <!-- Active -->
    <script src="{{ asset('ecohost/js/default-assets/active.js') }}"></script>


    @yield('scripts')

</body>

</html>