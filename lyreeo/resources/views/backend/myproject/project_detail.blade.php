@extends('backend.layouts.master')
<style type="text/css"> #options li { line-height:25px; color:blue; cursor:pointer; }.border-red-error{ background: #fff !important; } .border-red{ background: #fdeaea; } </style>

@section('content')
	<div class="h2_tool">
		<span class="tooltip"></span>
		<div class="tooltip-mobile">
			<div class="tooltip-main" id="tooltipMain" style="display: none;">
				<div class="tooltip-header">
					<div class="tooltip-cross"><img src="{{ asset('dist/images/check-2.png') }}" alt="cross-img"></div>
				</div>
				<div class="tooltip-content">
					<p  id="tooltip_content"> </p>
				</div>
			</div>
			<div class="tooltip-overlay"></div>
		</div>
	</div>
			<div class="lyerco_right_table business-unit col-md-9 col-sm-9 project-a">
				<div class="table_heading_text define_float">
					<h2>{{$project->project_title}} </h2>
				</div>
				<div class="project-header-main">
					<div class="project-heading-list col-md-7">
						<ul>
						<li><h6>{{__('sentence.project_detail_manage.project_title')}}:</h6><span>{{$project->project_title}}</span></li>
						<li><h6>{{__('sentence.project_detail_manage.department')}}:</h6><span>{{$project->businessName}}</span></li>
						<li><h6>{{__('sentence.project_detail_manage.project_manager')}}:</h6><span>{{$projectManager}}</span></li>
						<li><h6>{{__('sentence.project_detail_manage.project_sponsor')}}:</h6><span>{{$project->sponsor_name}}</span></li>
						<li><h6>{{__('sentence.project_detail_manage.sponsor_email')}}:</h6><span>{{$project->sponsor_email}}</span></li>
						</ul>
					</div>
					<div class="project-heading-list col-md-5">
						<ul>
						<li><h6>{{__('sentence.project_detail_manage.public')}}:</h6><span>@if($project->is_public==1) {{__('sentence.project_detail_manage.yes')}} @else {{__('sentence.project_detail_manage.no')}} @endif</span></li>
						<li><h6>{{__('sentence.project_detail_manage.group')}}:</h6><span>@if($project->is_group==1) {{__('sentence.project_detail_manage.yes')}} @else {{__('sentence.project_detail_manage.no')}} @endif</span></li>
						<li><h6>{{__('sentence.project_detail_manage.active')}}:</h6><span>@if($project->is_active==1) {{__('sentence.project_detail_manage.yes')}} @else {{__('sentence.project_detail_manage.no')}} @endif</span></li>
						<li><h6>{{__('sentence.project_detail_manage.planned_start')}}:</h6><span>{{ \Carbon\Carbon::parse($project->estimated_start_date)->format('d/m/y') }}</span></li>
						<li><h6>{{__('sentence.project_detail_manage.planned_end')}}:</h6><span>{{ \Carbon\Carbon::parse($project->estimated_end_date)->format('d/m/y') }}</span></li>
						</ul>
					</div>
				</div>
 
				<!-- <form name="ActiveProjectCreate" class="ajax-submit" method="post" action="{{ route('updateProjectDetails') }}" id="ActiveProject_Form" > -->
			{{Form::model($project, array('url'=>route('updateProjectDetails'), 'class'=>'row-table ajax-submit', 'id'=>'project_detail','files' => true))}}

				<div class="project-details-main">
					<h2>{{__('sentence.project_detail_manage.project_details')}}
						@if(__('sentence.project_detail_manage.project_details_tooltip') != '' )
						    <sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.project_details_tooltip') !!}"></i></sup>
						@endif
					</h2>
					<div class="project-textarea">
						<p>{{__('sentence.project_detail_manage.project_description_publicly_available')}}
							@if(__('sentence.project_detail_manage.project_description_publicly_available_tooltip') != '' )
								<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.project_description_publicly_available_tooltip') !!}"></i></sup>
							@endif
						</p>
						{{Form::textarea('project_description', $project->project_description,array('placeholder'=>__('sentence.project_detail_manage.project_description_publicly_available_placeholder')))}}
						{{Form::hidden('id', $project->id)}}
						{{Form::hidden('project_title', $project->project_title)}}
						{{Form::hidden('fk_businessUnitId', $project->fk_businessUnitId)}}
						{{Form::hidden('project_manager', $project->project_manager)}}
						{{Form::hidden('sponsor_name', $project->sponsor_name)}}
						{{Form::hidden('is_public', $project->is_public)}}
						{{Form::hidden('is_group', $project->is_group)}}
						{{Form::hidden('is_active', $project->is_active)}}
						{{Form::hidden('estimated_start_date', $project->estimated_start_date)}}
						{{Form::hidden('estimated_end_date', $project->estimated_end_date)}}
						{{Form::hidden('sponsor_email', $project->sponsor_email)}}
					</div>

					<div class="project-textarea">
						<p>{{__('sentence.project_detail_manage.current_situation')}}
							@if(__('sentence.project_detail_manage.current_situation_tooltip') != '' )
								<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.current_situation_tooltip') !!}"></i></sup>
							@endif
						</p>
						{{Form::textarea('current_situation', $project->current_situation,array('placeholder'=>__('sentence.project_detail_manage.current_situation_placeholder')))}}
					</div>

					<div class="project-textarea">
						<p>{{__('sentence.project_detail_manage.project_objective')}}
							@if(__('sentence.project_detail_manage.project_objective_tooltip') != '' )
								<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.project_objective_tooltip') !!}"></i></sup>
							@endif
						</p>
						{{Form::textarea('project_objective', $project->project_objective,array('placeholder'=>__('sentence.project_detail_manage.project_objective_placeholder')))}}
					</div>

					<div class="project-textarea">
						<p>{{__('sentence.project_detail_manage.prerequisites_dependencies_and_exclusions')}}
							@if(__('sentence.project_detail_manage.prerequisites_dependencies_and_exclusions_tooltip') != '' )
								<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.prerequisites_dependencies_and_exclusions_tooltip') !!}"></i></sup>
							@endif
						</p>
						{{Form::textarea('prerequisite_dependencies_exclusions', $project->prerequisite_dependencies_exclusions,array('placeholder'=>__('sentence.project_detail_manage.prerequisites_dependencies_and_exclusions_placeholder')))}}
					</div>
					<div class="project-textarea">
						<p>{{__('sentence.project_detail_manage.alternatives_options')}}
							@if(__('sentence.project_detail_manage.alternatives_options_tooltip') != '' )
								<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.alternatives_options_tooltip') !!}"></i></sup>
							@endif
						</p>
						{{Form::textarea('alternative_or_options', $project->alternative_or_options,array('placeholder'=>__('sentence.project_detail_manage.alternatives_options_placeholder')))}}
					</div>
					<div class="project-textarea">
						<p>{{__('sentence.project_detail_manage.milestones')}}
							@if(__('sentence.project_detail_manage.milestones_tooltip') != '' )
								<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.milestones_tooltip') !!}"></i></sup>
							@endif
						</p>
						{{Form::textarea('milestones', $project->milestones,array('placeholder'=>__('sentence.project_detail_manage.milestones_placeholder')))}}
					</div>
					<div class="project-textarea">
						<p>{{__('sentence.project_detail_manage.required_resources')}}
							@if(__('sentence.project_detail_manage.required_resources_tooltip') != '' )
								<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.required_resources_tooltip') !!}"></i></sup>
							@endif
						</p>
						{{Form::textarea('required_resources', $project->required_resources,array('placeholder'=>__('sentence.project_detail_manage.required_resources_placeholder')))}}
					</div>
				</div>
				


				<div id="projectMemversListing" >
						@include('backend.myproject.doc_members',array('projectId'=>$project->id))
				</div>




				<div class="project-details-main project-members">
					<h2>{{__('sentence.project_detail_manage.add_public_documents')}}
						@if(__('sentence.project_detail_manage.add_public_documents_tooltip') != '' )
							<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.add_public_documents_tooltip') !!}"></i></sup>
						@endif
					</h2>
					<div class="project-tagsarea">
						<div class="add-tags add-tag">
							<div class="file-upload upload-file-tag">
								<input name="public_documents[]" type="file" id="public_documents" data-preview="public_documents_div" multiple  class="tags-field" >
								<span for="public_documents" class="add-tags-btn">{{__('sentence.project_detail_manage.add')}}</span>
							</div>
						</div>
						<div id="public_documents_div" data-id="public_documents"></div>
						@if(!empty($projectDocument))
							@foreach($projectDocument as $document)
								@if($document->is_public==1)
									<div class="add-tags removeMaindiv">
										<p> <a href="{{ route('downloadFile',$document->id) }}">{{$document->document}}</a>  &nbsp&nbsp&nbsp&nbsp<span class="removeDoc" data-id="{{$document->id}}" route="{{route('remove.document')}}" data-table="document"><img src="{{ asset('dist/images/check-2.png') }}"></span></p>
									</div>
								@endif
		                    @endforeach
		                @endif
						
					</div>
				</div>


				<div class="project-details-main project-members">
					<h2>{{__('sentence.project_detail_manage.add_internal_documents')}}
						@if(__('sentence.project_detail_manage.add_internal_documents_tooltip') != '' )
							<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.add_internal_documents_tooltip') !!}"></i></sup>
						@endif
					</h2>
					<div class="project-tagsarea">
						<div class="add-tags add-tag" >
							<div class="file-upload upload-file-tag">
								<input type="file" id="internal_documents" name="internal_documents[]" multiple="true"  data-preview="internal_documents_div" class="tags-field" />
								<span for="internal_documents" class="add-tags-btn">{{__('sentence.project_detail_manage.add')}}</span>
								 <!-- <div id="file-upload-filename" class="file-upload-filename"></div> -->
								<!-- <div class="uplaod-image">Upload image</div> -->
							</div>
						</div>
						<div id="internal_documents_div" data-id="internal_documents"></div>
						@if(!empty($projectDocument))
							@foreach($projectDocument as $document)
								@if($document->is_public!=1)
									<div class="add-tags removeMaindiv">
										<p><a href="{{ route('downloadFile',$document->id) }}">{{$document->document}}</a> &nbsp&nbsp&nbsp&nbsp<span class="removeDoc" route="{{route('remove.document')}}" data-id="{{$document->id}}" data-table="document"><img src="{{ asset('dist/images/check-2.png') }}"></span></p>
									</div>
								@endif
		                    @endforeach
		                @endif
					</div>
				</div>


		<button type="submit" class="save-deatils">{{__('sentence.project_detail_manage.save')}}</button>
		<br><br>
		{{Form::close()}}
	</div>

@endsection
@section('scripts')
<script type="text/javascript">

	$('body').click(function() {
	   $('.membersName').hide();
	});
	
	$("#internal_documents, #public_documents").change(function(){  console.log($(this));
		var preview = $(this).attr('data-preview');
		var file_field_name = $(this).attr('name');
        images(this, '#'+preview, file_field_name);
    });


	function removePic(li, i){
		var fileFiledId= $(li).parent().parent('div').parent('div').attr('data-id');
		$(li).parent('p').parent('div').remove();
		$("#"+fileFiledId).val("");
		/*var filearr = document.getElementById(fileFiledId).files;
		var arr = Array.from(filearr);
		for (var j=0; j<arr.length; j++) {
			arr.splice(i,1);
		}
		 */
		
	}

    var images = function(input, imgPreview, file_field_name) {// console.log(input);
		var allFiles = input.files;
		if (allFiles) {
			var fd = new FormData();
			var files = allFiles;
			var totalFiles = allFiles.length;
			for (var index = 0; index < totalFiles; index++) {
				fd.append("documents[]", allFiles[index]);
			}

			$.ajax({
				url: "{{ route('documentUpload') }}",
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				beforeSend: function() {
                	showLoader();
            	},
				success: function(response){
					hideLoader();
					console.log(response);
					$.each(response, function(i, v) {
						var html = '<div class="add-tags removeMaindiv">' +
								        '<input type="hidden" name="hidden_'+file_field_name+'" value="'+v+'">'+
										'<p> '+ v +' &nbsp&nbsp&nbsp&nbsp  <span  onclick="removePic(this, '+i+')">' +
										'<img src="'+window.location.origin+'/dist/images/check-2.png"></span></p>'+
									'</div>';
						$($.parseHTML(html)).appendTo(imgPreview);
					});

				}
			});
			$(input).val("");
		}
    };

    $('.membersName').hide();
		$(document).on("click","input[type='text']",'#projectMembers', function(){
    	$('.membersName').show();
	});

 
    function addToMember(){

		var route = "{{ route('addToMembers') }}";
		var project_id = "{{$project->id}}";
		var memberName = $('#projectMembers').val();
		var inputVal = document.getElementById("projectMembers").value;
		
		if(inputVal != ''){
			$(".add-members-todiv").append('<div class="add-tags removeMaindiv"><p> '+inputVal+' &nbsp&nbsp&nbsp&nbsp <span class="removeMem"   route="{{route('remove.document')}}"><img src="{{ asset('dist/images/check-2.png') }}"></span></p></div>');
			$.ajaxSetup({
	        	headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	}
	    	}); 
	    	$.post(
	        	route,
	        	{project_id:project_id,memberName:memberName},
	        	function (data) {
		            $("#projectMemversListing").html(data);
		            $('.membersName').hide();
	        	}
	    	);
			$("#projectMembers").val('');
		}
		event.preventDefault();
	}

	$(document).on("click",".removeMem",function() {
	    
	    var table = $(this).attr('data-table');
	    var project_id = "{{$project->id}}";
	    
	    var id = $(this).attr('data-id');
	    var route =$(this).attr('route');

	    $(this).closest('.removeMaindiv').remove();

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.post(
	        route,
	        {table: table, id: id,project_id:project_id},
	        function (data) {
	            $("#projectMemversListing").html(data);
	        }
	    );
	     
	});


</script>
<style>
	.tooltip-mobile.tooltip_open {     display: block; }
</style>

<script>
	//mobile
	$(".tooltip-cross").click(function(){
		$("body").removeClass("tooltip-body_main");
		$('.tooltip-mobile').removeClass('tooltip_open');
	});
	$(".tooltip-icon").click(function() { 
		var content = $(this).attr('data-tooltip-content');
		$('#tooltip_content').html(content);
		$("body").addClass("tooltip-body_main");
		$('.tooltip-mobile').addClass('tooltip_open');

	});

	$(document).ready(function(){
		//web
		$('body').on('mouseleave','.h2_tool', function() {
			$('.tooltip-main').hide();
		});
		$('body').on('mouseleave','.project-details-main', function() { console.log('called');
			//$('.tooltip-main').hide();
		});
			$('body').on('mouseleave','textarea', function() { console.log('called');
			$('.tooltip-main').hide();
		});
	$('body').on('mouseenter', '.project-header-main', function () {
		$('.tooltip-main').hide();
	})
	

		$('body').on('mouseenter', '.tooltip-icon', function (event) { 
			var content = $(this).attr('data-tooltip-content');
			$('#tooltip_content').html(content);
			$('.tooltip-main').show();
			$(".h2_tool").css({top: $(document).scrollTop() + event.clientY , left: event.clientX, 'position':'absolute'}).show();
		});
	});
</script>
@endsection
