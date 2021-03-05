@extends('backend.layouts.master')
@section('content')
	<link rel="Stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/demo/prism.css" />
	<link rel="Stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/bower_components/sweetalert/dist/sweetalert.css" />

	<link rel="stylesheet" href="{{url('dist/cropie/style.css')}}" />

	<div class="lyerco_right_table my-profile col-md-9 col-sm-9">
	    {{Form::open(array('url'=>route('resetPassword'), 'class'=>'row-table ajax-submit','enctype'=>'multipart/form-data', 'id'=>'profile_edit'))}}
		<div class="project-header-main">
			<div class="project-heading-list col-md-8 col-sm-7 profile-list profile-first">
				<div class="my-profile-heading define_float">
					<h2>{{__('sentence.my_profile')}}</h2>
				</div>
				<ul>
				<li><span class="profile-left">{{__('sentence.name')}}:</span><p>{{$userData->name}}</p></li> 
				<li><span class="profile-left">{{__('sentence.role')}}:</span><p>{{$userData->role}}</p></li>
				<li><span class="profile-left">{{__('sentence.job_title')}}</span>
					@if(!empty($userData->job_title))
						{{Form::text('job_title',$userData->job_title,array('class'=>'text-field','placeholder'=>__('sentence.job_title_placeholder')))}}
					@else
						{{Form::text('job_title',null,array('class'=>'text-field','placeholder'=>__('sentence.job_title_placeholder')))}}
					@endif
				</li>
				<li><span class="profile-left progile-lang">{{__('sentence.language')}}</span>
					<div class="select-lang-inner select-lang">{{Form::select('language',languageCollector(), $userData->language, array('class'=>'text-field'))}}</div>
				</li>
				</ul>
			</div>
			<div class="project-heading-list col-md-4 col-md-5 profile-left-list">
				<div class="user-profile-img">
						<div class="my-profile-heading my-profile-mobile define_float">
							<h2>{{__('sentence.my_profile')}}</h2>
						</div>
					<div class="user-proflie-inner-img">
						@if($userData->avatar != null and $userData->avatar != '')
							@php  $picture=url('image/'.$userData->avatar); @endphp
							<img src="{{ route('image.displayImage',$userData->avatar) }}" onClick="openImageModal('{{$userData->id}}', 'profile_picture', '{{$picture}}')" class="pop-up-img" style="cursor: pointer;" alt="" title="">
						@else
						   @php  $picture=''; @endphp
							<img src="{{ asset('dist/images/user-profile.png') }}" onClick="openImageModal('{{$userData->id}}', 'profile_picture', '{{$picture}}')" class="pop-up-img" style="cursor: pointer;">
						@endif
						<div class="choose-profile">
							<div class="file-choosen">
							
								<a onClick="openImageModal('{{$userData->id}}', 'profile_picture', '{{$picture}}')" class="pop-up-img">{{__('sentence.select_image')}}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="project-details-main my-profile-inner">
			<h2>{{__('sentence.password_management')}}</h2>
			<div class="project-heading-list col-md-8 profile-list">
				<ul class="password-manage-list">
				<li><span class="profile-left">{{__('sentence.current_password')}}</span>
					{{Form::password('old_password',array('class'=>'text-field'))}}
				</li>
				<li><span class="profile-left">{{__('sentence.new_password')}}</span>
					{{Form::password('password',array('class'=>'text-field'))}}
				</li>
				<li><span class="profile-left">{{__('sentence.re_enter_new_password')}}</span>
					{{Form::password('password_confirmation',array('class'=>'text-field'))}}
				</li>
				</ul>
			</div>
		</div>
		<button class="my-profile-btn disabled" type="submit" disabled>{{__('sentence.save_changes')}}</button>
		{{Form::close()}}
	</div>
	<input type="hidden" id="crop_type" value="circle">
	@include('backend.layouts.cropie_file_upload', ['picture'=>$userData->avatar, 'type'=>'profile_picture', 'id'=>$userData->id, 'title'=>__('sentence.profile_image_upload_modal_title')])

@endsection
@section('scripts')

	<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
	<script src="{{url('dist/cropie/cropify_script.js?v=1')}}"></script>
	<script>
		demoUpload();

		jQuery(document).ready(function() {
			jQuery('.select-admin select').selectBoxIt({ 'numSearchCharacters': 1 });
		});
		
		 function openImageModal(id, type, picture){
			 /*$('#picture_upload_div').removeClass('abc');
			  $('#element_id').val(id);
			  $('#element_type').val(type);
			  $('#cropImagePop').modal({backdrop: 'static', keyboard: false});
			   if(picture != ''){
				  $('#pictureSelected').val(picture);
			  } 
			  $('#imageUploadButton').removeClass('disabled');
			  $('#imageUploadButton').removeAttr('disabled');*/
			  $('#resetCropie').trigger('click');
          $('#element_id').val(id);
          $('#element_type').val(type);
		  $('#imageUploadButton').addClass('disabled');
		  $('#imageUploadButton').prop('disabled', true);
          $('#cropImagePop').modal({backdrop: 'static', keyboard: false});
		   if(picture != ''){
              $('#pictureSelected').val(picture);
          }
       }
	</script>
@endsection