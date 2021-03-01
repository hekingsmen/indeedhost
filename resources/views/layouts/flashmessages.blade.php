
@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
  {{ $message }}
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger" role="alert">
  {{ $message }}
</div>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning" role="alert">
  {{ $message }}
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alert-info" role="alert">
  {{ $message }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-light" role="alert">
  {{ $message }}
</div>
@endif
<!-- <div class="alert alert-dark" role="alert">
  A simple dark alert—check it out!
</div>
<div class="alert alert-primary" role="alert">
  A simple primary alert—check it out!
</div>
<div class="alert alert-secondary" role="alert">
  A simple secondary alert—check it out!
</div> -->

@push('scripts')
<script type="text/javascript">
	$(".alert").fadeTo(2000, 500).slideUp(500, function(){
	    $(".alert").slideUp(500);
	});
</script>
@endpush