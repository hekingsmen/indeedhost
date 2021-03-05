@extends('frontend.layouts.master')
@section('content')
<div class="homepage home-admin home-inner-page">
	<div class="container">
		<div class="row" id="container">

			<div class="col-lg-3  col-md-4 col-sm-4 col-xs-6 home-grid all-projects-grid">
				<div class="home-box all-boxes human-box home-box-second">
					<div class="home-box-top">
						<a class="back-btn" href="{{ route('homepage') }}"><img src="{{ asset('dist/images/arrow-left.png') }}"><img class="arrow-img2" src="{{ asset('dist/images/arrow-left2.png') }}"></a>
					</div>
					<div class="home-box-inner">
						<h2>
							@if(!empty($department->department_name))
								{{ $department->department_name}}
							@else
								{{ $locate}}
							@endif
						</h2>
						<span>{{ count($projects) }} @if(count($projects) == 1) {{ __('sentence.project')}} @else {{ __('sentence.projects')}} @endif</span>
					</div>
				</div>
			</div>

	@if(!empty($projects))
		@foreach($projects as $index => $project)
			<div class="col-lg-3  col-md-4 col-sm-4 col-xs-6 home-grid sortable_divs">
				<div class="home-box home-box-second @if(empty($project->picture) || !is_file(public_path('image/'.$project->picture))) no-background-grid @endif">

						<div class="home_box_grad"></div>
						<div class="overlay_outer_main">
						</div>
					@if(!empty($project->picture) and is_file(public_path('image/'.$project->picture)))
						<!-- <img src="{{ route('productImageDisplayImage',$project->picture)  }}"> -->
						
						<img src="{{ asset('image/'.$project->picture) }}">
					@else
						<!--<img src="{{ asset('dist/images/home-box.png') }}">-->
					@endif
					@if(!empty($forBackLink) && $forBackLink=='fromAllProject' )
						<a class="home-grid-new" href="{{ route('aboutProjectDetail',$project->id) }}"></a>
					@else
						<a class="home-grid-new" href="{{ route('aboutProject',$project->id) }}"></a>
					@endif

					<div class="resource-box-main">
						<div class="home-box-top">
							<div class="home-top-inner">
								@if(!empty($project->avatar))
									<img src="{{ route('image.displayImage',$project->avatar) }}">
								@else
									<img src="{{ asset('/dist/images/user-profile.png') }}">
								@endif

							</div>
							<div class="home-top-inner">
							@if(!empty($project->status))
								<ul>
									@if($isFrontEndValid==1 && $project->is_public==0)
										<li class="block-icon"><img src="{{ asset('dist/images/block-img.png') }}"></li>
									@endif
									<li class="percent-box"><span>{{$project->status->percentage_completion}}%</span></li>
									@if(Auth::user())


								@if($isFrontEndValid==1 && !empty($isFrontEndValid))
									<li class="tooltip-list-inner">
										@php
											$QUALITY = projectStar($project->status->current_quality);
											$TIME = projectTime($project->status->time_planning);
											$COST = projectCost($project->status->cost_situation);
										@endphp
										<img src='{{ asset("$QUALITY") }}'>

										<span class="tooltip"></span>
										<div class="tooltip-mobile">
											<div class="tooltip-main">
											 <div class="tooltip-header">
												<div class="tooltip-heading">
													<img src='{{ asset("$QUALITY") }}'>
													<h2>{{ __('sentence.quality')}}</h2>
												</div>
												<div class="tooltip-cross"><img src="{{ asset('dist/images/check-2.png') }}" alt="cross-img"></div>
											 </div>
											 <div class="tooltip-content">
												<p> @if($project->status->current_quality_explanation ==null || $project->status->current_quality_explanation == '')
												{{ __('sentence.no_content_frontend')}}
												@else
												 {{  substr(strip_tags($project->status->current_quality_explanation), 0, 350)  }}
													@if(strlen(strip_tags($project->status->current_quality_explanation)) > 350)
													... <a href="{{ route('aboutProject',$project->id) }}" target="_blank">{{__('sentence.read_more')}}</a>
													@endif

												@endif
												</p>
											 </div>
											</div>
											<div class="tooltip-overlay"></div>
										</div>
									</li>

									<li class="tooltip-list-inner">
										<img src='{{ asset("$TIME") }}'>
										<span class="tooltip"></span>
										<div class="tooltip-mobile">
											<div class="tooltip-main">
											 <div class="tooltip-header">
												<div class="tooltip-heading">
													<img src='{{ asset("$TIME") }}'>
													<h2>{{ __('sentence.time')}}</h2>
												</div>
												<div class="tooltip-cross"><img src="{{ asset('dist/images/check-2.png') }}" alt="cross-img"></div>
											 </div>
											 <div class="tooltip-content">
												<p>
												@if($project->status->time_planning_explanation ==null || $project->status->time_planning_explanation == '')
												{{ __('sentence.no_content_frontend')}}
												@else
												 {{  substr(strip_tags($project->status->time_planning_explanation), 0, 350) }}
													@if(strlen(strip_tags($project->status->time_planning_explanation)) > 350)
													... <a href="{{ route('aboutProject',$project->id) }}" target="_blank">{{__('sentence.read_more')}}</a>
													@endif
												@endif
												</p>
											 </div>
											</div>
											<div class="tooltip-overlay"></div>
										</div>
									</li>

									<li class="tooltip-list-inner">
										<img src='{{ asset("$COST") }}'>

										<span class="tooltip"></span>
										<div class="tooltip-mobile">
											<div class="tooltip-main">
											 <div class="tooltip-header">
												<div class="tooltip-heading">
													<img src='{{ asset("$COST") }}'>
													<h2>{{ __('sentence.costs')}}</h2>
												</div>
												<div class="tooltip-cross"><img src="{{ asset('dist/images/check-2.png') }}" alt="cross-img"></div>
											 </div>
											 <div class="tooltip-content">
												<p>
												@if($project->status->cost_situation_explanation ==null || $project->status->cost_situation_explanation == '')
												{{ __('sentence.no_content_frontend')}}
												@else
												 {{  substr(strip_tags($project->status->cost_situation_explanation), 0, 350)  }}
													@if(strlen(strip_tags($project->status->cost_situation_explanation)) > 350)
													... <a href="{{ route('aboutProject',$project->id) }}" target="_blank">{{__('sentence.read_more')}}</a>
													@endif
												@endif
												</p>
											 </div>
											</div>
											<div class="tooltip-overlay"></div>
										</div>
									</li>
								@endif


									@endif
								</ul>
							@endif
							</div>


						</div>
						<div class="home-box-inner">
							<h2>{{  substr(strip_tags($project->project_title), 0, 40)  }} @if(strlen(strip_tags($project->project_title)) > 40).... @endif</h2>
							<div class="human-details">
								@php $diffInDays = calculateGoLive($project->projectEndDate); @endphp
								<span>{{ __('sentence.go_live')}}: {{  $diffInDays  }}  @if($diffInDays == 1) {{ __('sentence.day')}} @else {{ __('sentence.days')}} @endif</span>
								<span>{{ __('sentence.latest_update')}}:
									@if(!empty($project->status->updated_at))
										@php
										$date = $project->status->updated_at;
										$date = str_replace('/', '-', $date);
										@endphp
									@else
										@php
										$date = $project->status->created_at ?? $project->created_at;
										$date = str_replace('/', '-', $date);
										@endphp
									@endif
									@if(!empty($date))
										{{ date('d-m-Y', strtotime($date)) }}
									@endif
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="sortme" style="display:none">
					<div class="project_name">{{strip_tags($project->project_title)}}</div>
					<div class="go_live">{{ $diffInDays }}</div>
					<div class="project_manager">{{ $project->project_manager_name }}</div>
					<div class="percentage">{{ (int) $project->status->percentage_completion }}</div>
					<div class="last_update">
						@if(!empty($date))
							{{ date('Y-m-d', strtotime($date)) }}
						@endif
					</div>
				</div>
			</div>
		@endforeach
	@endif

		</div>
	</div>
</div>
@endsection

@section('scripts') 
	<script>
	$('#sort_by').val('project_name');
	
		function sort() {
			var sortBy = $('#sort_by').val();
		    showLoader();
			sortData(sortBy);
			 hideLoader();
			/*setTimeout(function() {
				 hideLoader();
                sortData(sortBy);
            }, 1000);*/
			
		}
		
		function sortData(sortBy){
			$('.sortable_divs').sort(function(a, b) {
				var data = $(a).find('.sortme .'+sortBy).html();
				var data1 = $(b).find('.sortme .'+sortBy).html();
				var project_name1 = $(a).find('.sortme .project_name').html().toUpperCase();
				var project_name2 = $(b).find('.sortme .project_name').html().toUpperCase();
				
				if(sortBy == "last_update" || sortBy == "percentage" || sortBy == "go_live") {
					if(sortBy == "last_update" ) {
						if (data > data1) {
							return -1;
						} else {
							if(data == data1){
								if (project_name1 < project_name2) {  
									return -1;
								} else { 
									return 1;
								}
							} else{
								return 1;
							}
							
						}
					} else{
						return parseInt(data1) - parseInt(data);
					}
				} else{
					data = data.toUpperCase();
					data1 = data1.toUpperCase();
					if (data < data1) {
						return -1;
					} else {
						
						if(data == data1){
							if (project_name1 < project_name2) { 
									return -1;
							} else { 
									return 1;
							}
						} else{
								return 1;
						}
						return 1;
					}
				}
				/*if (data < data1) {
					return -1;
				} else {
					return 1;
				}*/
			}).appendTo('#container');
		}
	</script>
@endsection