<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('admin.layouts.head')
<body class="">
  	<div class="wrapper ">
  		@include('admin.layouts.flashmessages')
  		@include('admin.layouts.sidebar')
  		@yield('content')
	</div>
    @include('admin.layouts.footer')
</body>
</html>
