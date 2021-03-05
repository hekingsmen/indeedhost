@extends('frontend.layouts.master')
@section('content')
	<div class="container">
		<div class="row">


			<div class="col-md-3 col-sm-4 col-xs-6 home-grid">
				<a href="{{route('allProjectsViews')}}">
				<div class="home-box all-boxes">
				<span class="all-img"></span>
					
						<img src="{{asset('dist/images/home-box.png')}}">
					<div class="home-box-inner">
						<h2>{{ __('sentence.all_project')}}</h2>
						<span>{{$totalProjects}} @if($totalProjects == 1) {{ __('sentence.project')}} @else {{ __('sentence.projects')}} @endif</span>
					</div>
				</div>
				</a>
			</div>

			@if(!empty($department) && count($department)>0 )
				@foreach($department as $index => $unit)
					<div class="col-md-3 col-sm-4 col-xs-6 home-grid">
						<a href="{{ route('projectOverview',$unit->id) }}">
						<div class="home-box ">
						<span class="all-img"></span>
							@if(!empty($unit->picture) and is_file(public_path('image/'.$unit->picture))) 
									<img src="{{asset('image/'.$unit->picture)}}">
								@else
								
							@endif
							<div class="home-box-inner">
								<h2>{{ $unit->department_name }}</h2>
								<span>{{$unit->project_count}} @if($unit->project_count == 1) {{ __('sentence.project')}} @else {{ __('sentence.projects')}} @endif</span>
							</div>
						</div>
						</a>
					</div>
				@endforeach
			@endif
			<div class="archive-text">
			  <a  href="{{ route('allArchivedProjects') }}">{{__('sentence.frontend_archive_projects')}}</a>
			</div>
		</div>
	</div>
@endsection