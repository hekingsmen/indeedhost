@extends('frontend.layouts.master')
@section('content')
	<div class="container"> 
		<div class="row">
			@if(!empty($department) && count($department)>0 )
				@foreach($department as $index => $unit)	
					<div class="col-md-3 col-sm-4 col-xs-6 home-grid">
						<a href="{{ route('projectOverview',$unit->id) }}">
						<div class="home-box all-boxes">
						<span class="all-img"></span>
							@if(empty($unit->picture))
									<img src="{{asset('dist/images/home-box.png')}}">
								@else
									<img src="{{asset('dist/images/home-box.png')}}">
							@endif
							<div class="home-box-inner">
								<h2>{{ $unit->department_name }}</h2>
								<span>{{$unit->project_count}} Projects</span>
							</div>
						</div>
						</a>
					</div>
				@endforeach
			@else
				<div class="col-md-12 home-grid" style="text-align: center;" >
						<div class="home-box">
							<h2>No Project Found Yet</h2>
						</div>
				</div>
			@endif

			<!-- <div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="human-resource.html"></a>
					<div class="home-box-inner">
						<h2>Human Resources</h2>
						<span>9 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Sales</h2>
						<span>7 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Marketing</h2>
						<span>8 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Finance</h2>
						<span>11 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Department Lorem</h2>
						<span>10 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Department Ipsum</h2>
						<span>6 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Department Dolor</h2>
						<span>9 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Department Lorem</h2>
						<span>5 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Department Ipsum</h2>
						<span>7 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Department Dolor</h2>
						<span>8 Projects</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 home-grid">
				<div class="home-box">
					<img src="{{ asset('dist/images/home-box.png') }}">
					<a href="javascript:void(0)"></a>
					<div class="home-box-inner">
						<h2>Department Lorem</h2>
						<span>9 Projects</span>
					</div>
				</div>
			</div>	 -->		

		</div>
	</div>
@endsection