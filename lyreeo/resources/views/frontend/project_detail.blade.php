@extends('frontend.layouts.master')
@section('content')
<div class="about-us">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-5 about-box-main">
				<div class="about-sidebar">
					<div class="sidebar-inner">
						<div class="about-box">

						@if(!empty($projectDetail->picture) and is_file(public_path('image/'.$projectDetail->picture)))
							<img src="{{ route('image.displayImage',$projectDetail->picture) }}" alt="client">
						@else
							<img src="{{ asset('dist/images/home-box.png') }}">
						@endif

							<div class="about-box-top">
								@php $routeName = getCurrentRouteName(); @endphp
								@if(!empty($routeName) && $routeName=='aboutProjectDetail' )
									<a class="back-btn" href="{{ route('allProjectsViews',$projectDetail->fk_businessUnitId) }}">
								@else
									<a class="back-btn" href="{{ route('projectOverview',$projectDetail->fk_businessUnitId) }}">
								@endif

								<img src="{{ asset('dist/images/arrow-left.png') }}">
								<img class="arrow-img2" src="{{ asset('dist/images/arrow-left2.png') }}"></a>
							</div>

							<div class="about-box-inner">
								<h2>{{$projectDetail->project_title}}</h2>
							</div>
						</div>
					</div>


					<div class="sidebar-inner sidebar-bottom">
						<div class="sidebar-list">
							<div class="list-inner">
								<h6>{{ __('sentence.managed_by')}}:</h6>
								<span class="tooltip-new">{{ $projectDetail->project_manager->name }}</span>
								@if($projectDetail->project_manager->job_title != null and $projectDetail->project_manager->job_title != '')
								<div class="tooltip-new-main-mobile tooltip-new-list">
									<div class="tooltip-new-main">
										<div class="tooltip-cross-new">
											<img src="{{ url('dist/images/check-2.png') }}" alt="cross-img" class="tooltip-close">
										</div>
										<div class="tooltip-header">									
											<h2>{{$projectDetail->project_manager->job_title}}</h2>																				
										</div>
										
									</div>
								    <div class="tooltip-overlay-new"></div>
								</div>
								@endif
							</div>
							<div class="list-inner">
								@if(!empty($projectDetail->project_manager->avatar))
									<img src="{{ route('image.displayImage',$projectDetail->project_manager->avatar) }}" class="tooltip-new" alt="client">
								@else
									<img src="{{ asset('dist/images/user-profile.png') }}" class="tooltip-new">
								@endif	
								@if($projectDetail->project_manager->job_title != null and $projectDetail->project_manager->job_title != '')
								<div class="tooltip-new-main-mobile">
									<div class="tooltip-new-main">
										<div class="tooltip-header">									
											<h2>{{$projectDetail->project_manager->job_title}}</h2>									
											<div class="tooltip-cross-new">
												<img src="{{ url('dist/images/check-2.png') }}" alt="cross-img" class="tooltip-close">
											</div>
										</div>
										
									</div>
								    <div class="tooltip-overlay-new"></div>
								</div>
								@endif
							</div>
						</div>
						<div class="sidebar-list sidebar-text">
							<div class="list-inner">
								<h6>{{ __('sentence.project_members')}}:</h6>
								<span>
									@if(!empty($allMembers))
										{{$allMembers}}
									@else
										{{ __('sentence.no_members')}}
									@endif
								</span>								
							</div>
						</div>

						<div class="sidebar-list">
							<ul>

								<?php
								$startDate = $projectDetail->estimated_start_date;
								$endDate = $projectDetail->estimated_end_date;
								if(isset($projectDetail->status->real_start_date) and $projectDetail->status->real_start_date != null) {
									$startDate = $projectDetail->status->real_start_date;
									$endDate = $projectDetail->status->realistic_end_date;
								}

								?>
									<li><h6>{{ __('sentence.start')}}:</h6><span>
											{{ date('d-m-Y', strtotime($startDate)) }}
									</span></li>


								
									<li><h6>{{ __('sentence.end')}}:</h6><span>
											{{ date('d-m-Y', strtotime($endDate)) }}
									</span></li>

								<li><h6>{{ __('sentence.sponsor')}}:</h6><span>{{ $projectDetail->sponsor_name }}</span></li>

								
									<li><h6>{{ __('sentence.progress')}}:</h6><span>
										{{ $projectDetail->status->percentage_completion }}%
									</span></li>
							


								<!-- For Logged In User -->
								@if(Auth::user())
									@if(Auth::user() && $isFrontEndValid==1 )
										<li><h6>{{ __('sentence.public')}}:</h6><span>
											@if($projectDetail->is_public==1) {{ __('sentence.yes')}} @else {{ __('sentence.no')}} @endif
										</span></li>
									
										
											<li><h6>{{ __('sentence.group_project')}}:</h6><span>
												@if($projectDetail->is_group==1) {{ __('sentence.yes')}} @else {{ __('sentence.no')}} @endif
											</span></li>
										
									@endif
								@endif


								@if(!empty($projectDetail->status->updated_at))
									<li><h6>{{ __('sentence.last_update')}}:</h6><span>
										{{ date('d-m-Y', strtotime($projectDetail->status->updated_at)) }}
									</span></li>
								@else
									<li><h6>{{ __('sentence.last_update')}}:</h6><span>
										{{ date('d-m-Y', strtotime($projectDetail->status->created_at ?? $projectDetail->created_at)) }}
									</span></li>
								@endif
							</ul>
						</div>
					</div>



				</div>
			</div>

		<div class="col-lg-8 col-md-8 col-sm-7 about-right">
			<div class="about-content">
				<h2>{{ __('sentence.about')}}</h2>
				<p>
					@if(!empty($projectDetail->project_description))
						{!! nl2br($projectDetail->project_description) !!}
					@else
						{{ __('sentence.no_content_frontend')}}
					@endif
				</p>
			</div>


			@if(Auth::user() && $projectDetail->is_active==1 && $isFrontEndValid==1 && !empty($projectDetail->status) )
				<div class="about-details">
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					  <div class="panel-body">
						<div class="about-content-inner">
							<h2>{{ __('sentence.current_situation')}}</h2>
							<p>
								@if(!empty($projectDetail->current_situation))
									{!! nl2br($projectDetail->current_situation) !!}
								@else
									{{ __('sentence.no_content_frontend')}}
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.project_objective')}}</h2>
							<p>
								@if(!empty($projectDetail->project_objective))
									{!! nl2br($projectDetail->project_objective) !!}
								@else
									{{ __('sentence.no_content_frontend')}}
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.PREREQUISITES_DEPENDENCIES_AND_EXCLUSIONS')}}</h2>
							<p>
								@if(!empty($projectDetail->prerequisite_dependencies_exclusions))
									{!! nl2br($projectDetail->prerequisite_dependencies_exclusions) !!}
								@else
									{{ __('sentence.no_content_frontend')}}
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.alternatives_options')}}</h2>
							<p>
								@if(!empty($projectDetail->alternative_or_options))
									{!! nl2br($projectDetail->alternative_or_options)  !!}
								@else
									{{ __('sentence.no_content_frontend')}}
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.milestones')}}</h2>
							<p>
								@if(!empty($projectDetail->milestones))
									{!! nl2br($projectDetail->milestones) !!}
								@else
									{{ __('sentence.no_content_frontend')}}
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.required_resources_financial_human_material')}}</h2>
							<p>
								@if(!empty($projectDetail->required_resources))
									{!! nl2br($projectDetail->required_resources) !!}
								@else
									{{ __('sentence.no_content_frontend')}}
								@endif
							</p>
						</div>
					  </div>
					</div>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						  <span>+</span><span class="minus-icon"></span>{{ __('sentence.show_details')}}
						</a>
					</div>
				</div>


				<div class="feedback-section">
					<h2>{{ __('sentence.project_managers_feedback')}}</h2>
					<div class="about-content-inner">
							<h2>{{ __('sentence.overall_status')}}</h2>
							<p>
								@if(!empty($projectDetail->status->overall_status))
									{!! nl2br($projectDetail->status->overall_status) !!}
								@else
									{{ __('sentence.no_content_frontend')}}
								@endif
							</p>
						</div>
						@php
							$QUALITY = projectStar($projectDetail->status->current_quality);
							$TIME = projectTime($projectDetail->status->time_planning);
							$COST = projectCost($projectDetail->status->cost_situation);
						@endphp
					<div class="col-md-4 col-sm-6 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src='{{ asset("$TIME") }}'>
								</div>
								<h2>{{ __('sentence.time')}}</h2>
							</div>
							<div class="feedback-content">
								<p>
									@if(!empty($projectDetail->status->time_planning_explanation))
											{!! nl2br($projectDetail->status->time_planning_explanation) !!}
										@else
											{{ __('sentence.no_content_frontend')}}
									@endif
								</p>
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src='{{ asset("$QUALITY") }}'>
								</div>
								<h2>{{ __('sentence.quality')}}</h2>
							</div>
							<div class="feedback-content">
								<p>
									@if(!empty($projectDetail->status->current_quality_explanation))
											{!! nl2br($projectDetail->status->current_quality_explanation) !!}
										@else
											{{ __('sentence.no_content_frontend')}}
									@endif
								</p>
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src='{{ asset("$COST") }}'>
								</div>
								<h2>{{ __('sentence.costs')}}</h2>
							</div>
							<div class="feedback-content">
								<p>
									@if(!empty($projectDetail->status->cost_situation_explanation))
										{!! nl2br($projectDetail->status->cost_situation_explanation) !!}
									@else
										{{ __('sentence.no_content_frontend')}}
									@endif
								</p>
							</div>
						</div>
					</div>

				</div>

			@endif

				<div class="project-details-main about-documents">
					<h2>{{ __('sentence.attached_files')}}</h2>
					<div class="project-tagsarea">
						@php  $i=0; @endphp
						@if(!empty($projectDetail->files) && count($projectDetail->files)>0 )
							@foreach($projectDetail->files as $file)
								<div class="add-tags">
									@if($file->is_public==0 && $isFrontEndValid==1)
									   @php  $i=1; @endphp
										<p><a href="{{ route('getDownloadFile',$file->id) }}" >{{ $file->document }}</a> <span><img src="{{url('dist/images/block.png')}}"></span></p>
									@elseif($file->is_public==1)
									    @php  $i=1; @endphp
										<p><a href="{{ route('getDownloadFile',$file->id) }}" >{{ $file->document }}</a> <span></p>
									@endif
								</div>
							@endforeach
						@endif
						@if($i == 0)
							<div class="add-tags">
								<p>{{ __('sentence.no_attached_files')}}</p>
							</div>
					
						@endif
					</div>
				</div>


			</div>			
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
	 $('.tooltip-new').click(function(){ 
		$(this).parent().addClass('tooltip-new-body'); 
	 });	
	$('.tooltip-close').click(function(){
		$(this).parent().parent().parent().parent().parent().removeClass('tooltip-new-body');
		$(this).parent().parent().parent().parent().removeClass('tooltip-new-body'); 
	 });
});
</script>
@endsection