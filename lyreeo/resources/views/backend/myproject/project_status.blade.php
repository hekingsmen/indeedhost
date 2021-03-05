@extends('backend.layouts.master')
@section('content') 
<?php
	$judges = getStatusColors();
	$startDate = $endDate = null;
	if(isset($projectsStatus['real_start_date']) and $projectsStatus['real_start_date'] != null){
		$projectsStatus['real_start_date'] = \Carbon\Carbon::parse($projectsStatus['real_start_date'])->format('d/m/y');
		$projectsStatus['realistic_end_date'] = \Carbon\Carbon::parse($projectsStatus['realistic_end_date'])->format('d/m/y');
	}
	
?>
	<div class="lyerco_right_table business-unit col-md-9 col-sm-9">
		<div class="table_heading_text define_float">
			<h2>{{__('sentence.project_detail_manage.project_status')}}</h2>
		</div>
		<form name="ActiveProjectCreate" class="ajax-submit" method="post" action="{{ route('updateProjectStatus') }}" id="ActiveProject_Form">

		{{Form::model($projectsStatus, array('url'=>route('updateProjectStatus'), 'class'=>'row-table ajax-submit'))}}

		<div class="project-header-main">
			<div class="project-heading-list col-md-6">
				<ul>
					<li><h6>{{__('sentence.project_detail_manage.project_title')}}:</h6><span>{{ $project->project_title }}</span></li>
					<li><h6>{{__('sentence.project_detail_manage.department')}}:</h6><span>{{ $project->fk_businessUnitId }}</span></li>
					<li><h6>{{__('sentence.project_detail_manage.project_manager')}}:</h6><span>{{ $project->project_manager }}</span></li>
				</ul>
			</div>
		</div>
		
		{{Form::hidden('id', null)}}
		{{Form::hidden('fk_projectId', $project->id)}}

		<div class="project-details-main project-status">
			<h2>{{__('sentence.project_detail_manage.project_upadate')}}</h2>
			<div class="project-textarea">
				<p>{{__('sentence.project_detail_manage.what_is_the_current_overall_status_of_the_project')}}</p>
				{{Form::textarea('overall_status', null ,array('placeholder'=>__('sentence.project_detail_manage.what_is_the_current_overall_status_of_the_project_placeholder')))}}
			</div>
			<div class="project-textarea percent-section">
				<p>{{__('sentence.project_detail_manage.what_is_the_overall_percentage_of_completion')}}</p>
				{{Form::number('percentage_completion', null ,array('class'=>'percent-field percentage-choose'))}}<span>%</span>
			</div>
			<div class="project-textarea percent-section">
				<p>{{__('sentence.project_detail_manage.what_is_the_real_start_realistic_end_of_the_project')}}</p>
				{{Form::text('real_start_date', null, array("placeholder"=>__('sentence.project_manage.start_placeholder'),"class"=>"percent-field datepicker"))}}

				{{Form::text('realistic_end_date', null, array("placeholder"=>__('sentence.project_manage.end_placeholder'),"class"=>"percent-field datepicker"))}}
			</div>																	
		</div>

		<div class="project-details-main project-members status-main">
			<h2>{{__('sentence.project_detail_manage.time')}}</h2>
			<div class="project-textarea percent-section">
				<div class="quality-text">
					<p>{{__('sentence.project_detail_manage.how_is_the_current_time_planning_of_the_project')}}</p>
					<div class="select-admin">
						<select id="current_quality" name="time_planning" >
							@foreach($judges as $key => $judge)
									<option value="{{$key}}" @if(!empty($projectsStatus->time_planning) && $projectsStatus->time_planning==$key) selected="true"  @endif >{{$judge}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="project-textarea">
					<p>{{__('sentence.project_detail_manage.Why_What_is_needed_to_get_back_on_track_time')}}</p>
					{{Form::textarea('time_planning_explanation', null,array('placeholder'=>__('sentence.project_detail_manage.Why_What_is_needed_to_get_back_on_track_placeholder_time')))}}
				</div>						
			</div>	
		</div>

		<div class="project-details-main project-members status-main">
			<h2>{{__('sentence.project_detail_manage.quality')}}</h2>
			<div class="project-textarea percent-section">
			  <div class="quality-text">
					<p>{{__('sentence.project_detail_manage.how_is_the_current_quality_of_the_project')}}</p>
					<div class="select-admin" >
						<select id="current_quality" name="current_quality" >
							@foreach($judges as $key => $judge)
							  	<option value="{{$key}}" @if(!empty($projectsStatus->current_quality) && $projectsStatus->current_quality==$key) selected="true"  @endif >{{$judge}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="project-textarea">
					<p>{{__('sentence.project_detail_manage.Why_What_is_needed_to_get_back_on_track_quality')}}</p>
					{{Form::textarea('current_quality_explanation', null,array('placeholder'=>__('sentence.project_detail_manage.Why_What_is_needed_to_get_back_on_track_placeholder_quality')))}}
				</div>						
			</div>	
		</div>

		<div class="project-details-main project-members status-main">
			<h2>{{__('sentence.project_detail_manage.cost')}}</h2>
			<div class="project-textarea percent-section">
			   <div class="quality-text">
					<p>{{__('sentence.project_detail_manage.how_is_the_current_cost_of_the_project')}}</p>
					<div class="select-admin">
						<select id="admin" name="cost_situation" >
						  @foreach($judges as $key => $judge)
								<option value="{{$key}}" @if(!empty($projectsStatus->cost_situation) && $projectsStatus->cost_situation==$key) selected="true"  @endif >{{$judge}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="project-textarea">
					<p>{{__('sentence.project_detail_manage.Why_What_is_needed_to_get_back_on_track_cost')}}</p>
					{{Form::textarea('cost_situation_explanation', null,array('placeholder'=>__('sentence.project_detail_manage.Why_What_is_needed_to_get_back_on_track_placeholder_cost')))}}
				</div>
			</div>	
		</div>					
		<!--Button-->
		<button type="submit" class="save-deatils">{{__('sentence.project_detail_manage.save')}}</button>
	
	{{Form::close()}}
	</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$(function() {
		$( ".datepicker" ).datepicker({
			dateFormat:'dd/mm/y'
		});
	});
</script>	  
@endsection