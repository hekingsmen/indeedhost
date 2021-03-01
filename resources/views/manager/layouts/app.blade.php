<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('manager.layouts.head')
<body class="">
  	<div class="wrapper ">
  		@include('manager.layouts.flashmessages')
  		@include('manager.layouts.sidebar')
  		@yield('content')
	</div>
    @include('manager.layouts.footer')
</body>
</html>
