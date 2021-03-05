@extends('backend.layouts.master') 
@section('content')
<?php
 $formId = 0;
 $projectManagersList = $projectManagers;
 if(isset($projectDetails->project_manager)){
	 $selected[$projectDetails->project_manager] = $projectDetails->project_manager_name;
       $projectManagersList = $selected + $projectManagers ;
	   $formId = $projectDetails['id'];
 }
	  
?>
<div class="edit_page_new col-md-9" >
   <div class="edit_title_main define_float">
	<h2>{{ __('sentence.project_manage.project_basic_settings') }}</h2>
   </div>
   {{Form::model($projectDetails, array('url'=>route('saveProject'), 'id'=>'form_'. $formId, 'data-id'=>'form_edit', 'class'=>'row-table ajax-submit modify-project-table'))}}
   <div class="edit_form col-md-7 col-sm-7 col-xs-12" >
   

		<div class="edit_form_main mob_dis define_float edit_form_first">
			<div class="edit_form_title mob_left col-md-12 col-sm-12 col-xs-12">
				<h3>{{__('sentence.project_manage.project_title')}}</h3>
			</div>
			<div class="edit_form_right mob_right col-md-12 col-sm-12 col-xs-12">
				{{ Form::text('project_title', null, array("class"=>"text-field", "placeholder"=>__('sentence.project_manage.project_title_placeholder'))) }}
			</div>
		</div>
		<div class="edit_form_main mob_dis define_float">
			<div class="edit_form_title mob_left col-md-5 col-sm-5 col-xs-12">
				<h3>{{ __('sentence.project_manage.business_unit') }}</h3>
			</div>
			<div class="edit_form_right mob_right col-md-7 col-sm-7 col-xs-12">
				<div class="edit_select">
					 {{Form::select('fk_businessUnitId',$businessUnits, null, array( 'placeholder'=>__('sentence.project_manage.business_unit_placeholder')))}}
				</div>
			</div>
		</div>
		<div class="edit_form_main mob_dis define_float">
			<div class="edit_form_title mob_left col-md-5 col-sm-5 col-xs-12">
				<h3>{{ __('sentence.project_manage.sponsor_name') }}</h3>
			</div>
			<div class="edit_form_right mob_right col-md-7 col-sm-7 col-xs-12">
				{{ Form::text('sponsor_name', null, array("class"=>"text-field", "placeholder"=>__('sentence.project_manage.sponsor_name_placeholder'))) }}
			</div>
		</div>
		
		<div class="edit_form_main mob_dis define_float">
			<div class="edit_form_title mob_left col-md-5 col-sm-5 col-xs-12">
				<h3>{{ __('sentence.project_manage.sponsor_email') }}</h3>
			</div>
			<div class="edit_form_right mob_right col-md-7 col-sm-7 col-xs-12">
				{{ Form::text('sponsor_email', null, array("class"=>"text-field", "placeholder"=>__('sentence.project_manage.sponsor_email_placeholder'))) }}
			</div>
		</div>
		
		<div class="edit_form_main mob_dis define_float">
			<div class="edit_form_title mob_left col-md-5 col-sm-5 col-xs-12">
				<h3>{{ __('sentence.project_manage.project_manager') }}  </h3>
			</div>
			<div class="edit_form_right mob_right col-md-7 col-sm-7 col-xs-12">
				<div class="edit_select">
					{{Form::select('project_manager', $projectManagersList, null, array('placeholder'=>__('sentence.project_manage.project_manager_placeholder')))}}
				</div>
			</div>
		</div>
	</div>
	 <div class="edit_form add-modify-left col-md-5 col-sm-5" id="data_table">
		<div class="edit_form_main define_float">			
			<div class="edit_form_right">
				<div class="edit_cus_img">
				<?php
				$actualPicture = ''; $select_image_text = __('sentence.project_manage.add_modify_image');
				$picture = url('dist/images/project-img-z.png');
				if(isset($projectDetails['picture']) and $projectDetails['picture'] != '' and $projectDetails['picture'] != null and is_file(public_path('image/'.$projectDetails['picture']))) {  
					$picture = $actualPicture =  url('image/'.$projectDetails['picture']);
				}
				if(isset($projectDetails['estimated_start_date'])){
					$projectDetails['estimated_start_date'] = \Carbon\Carbon::parse($projectDetails['estimated_start_date'])->format('d/m/y');
					$projectDetails['estimated_end_date'] = \Carbon\Carbon::parse($projectDetails['estimated_end_date'])->format('d/m/y');
				}
				?>
					<img src="{{$picture}}"  id="form_picture_0" onClick="openImageModal('{{$formId}}', 'project', '{{$actualPicture }}')"  class="pop-up-img" />
					
				</div>
				<div class="choose-profile">
							<div class="file-choosen">
								<a onClick="openImageModal('{{$formId}}', 'project', '{{$actualPicture }}')"  class="pop-up-img"> {{$select_image_text}}</a>
							</div>
						</div>
			</div>
			{{Form::hidden('picture', null, array('id'=>'picture_0'))}}
		</div>
   </div>
   <div class="col-md-10 col-sm-10 modify-bottom-section">
		<div class="edit_form_main mob_dis define_float estimation-start-field">
			<div class="edit_form_title mob_left col-md-5 col-sm-5 col-xs-12">
				<h3>{{__('sentence.project_manage.estimated_start_end_date')}}</h3>
			</div>
			<div class="edit_form_right mob_right col-md-7 col-sm-7 col-xs-12">
				<div class="col-md-6 col-sm-6 col-xs-12 est-date-start-end">

					{{ Form::text('estimated_start_date', null, array("class"=>"text-field datepicker", "placeholder"=> __('sentence.project_manage.start_placeholder') )) }}
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 est-date-start-end">
				   {{ Form::text('estimated_end_date', null, array("class"=>"text-field datepicker", "placeholder"=> __('sentence.project_manage.end_placeholder') )) }}
				</div>
			</div>
		</div>
  
		<div class="edit_form_main define_float public-checkbox">
			<div class="edit_form_title col-md-2 col-sm-5 col-xs-12">
				<h3>{{ __('sentence.project_manage.is_pub') }}</h3>
			</div>
			<div class="edit_form_right col-md-10 col-sm-7 col-xs-12">
				<div class="edit_cus_check">
					{{Form::checkbox('is_public', null)}}
					<label></label>
				</div>
			</div>
		</div>
		<div class="edit_form_main define_float public-checkbox">
			<div class="edit_form_title col-md-2 col-sm-5 col-xs-12">
				<h3>{{ __('sentence.project_manage.is_grp') }}</h3>
			</div>
			<div class="edit_form_right col-md-10 col-sm-7 col-xs-12">
				<div class="edit_cus_check">
					{{Form::checkbox('is_group', null)}}
					<label></label>
				</div>
			</div>
		</div>
		<div class="edit_form_main define_float public-checkbox">
			<div class="edit_form_title col-md-2 col-sm-5 col-xs-12">
				<h3>{{ __('sentence.project_manage.is_act') }}</h3>
			</div>
			<div class="edit_form_right col-md-10 col-sm-7 col-xs-12">
				<div class="edit_cus_check">
					{{Form::checkbox('is_active', null)}}
					<label></label>
				</div>
			</div>
		</div>
		<div class="edit_form_main define_float">
			<div class="edit_form_btn col-md-12 col-sm-12 col-xs-12">
			{{Form::hidden('id', null)}}
			
				<button type="submit">{{ __('sentence.project_manage.save') }}</button>
			</div>
		</div>
		</form>
	</div>
</div>
 @include('backend.layouts.cropie_file_upload', ['picture'=>$picture, 'type'=>'project', 'id'=>$formId, 'title'=>__('sentence.project_manage.image_upload_modal_title')])
@endsection
@section('scripts')

    <script src="https://foliotek.github.io/Croppie/croppie.js"></script>
    <script src="{{url('dist/cropie/cropify_script.js?v=1')}}"></script>
    <script>
        demoUpload();
		$('#resetCropie').trigger('click');
        function openImageModal(id, type, picture){
           // $('#resetCropie').trigger('click');
           //$('#resetCropie').trigger('click');
          $('#element_id').val(id);
          $('#element_type').val(type);
		  $('#imageUploadButton').addClass('disabled');
		  $('#imageUploadButton').prop('disabled', true);
          $('#cropImagePop').modal({backdrop: 'static', keyboard: false});
		  if(picture != ''){
              $('#pictureSelected').val(picture);
          }
        }
		
		$( function() {
		 $( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/y' });
	  } );
    </script>
@endsection
