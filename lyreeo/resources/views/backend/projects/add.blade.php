
{{Form::model($details, array('url'=>route('saveProject'), 'id'=>'form_'.$formId, 'data-id'=>$formId, 'class'=>'row-table ajax-submit', 'style'=>'display:'.$display.';'))}}

<?php
$actualPicture = '';
   if($details != null){
       $selected[$details->project_manager] = $details->project_manager_name;
       $projectManagersList = $selected + $projectManagers ;
       if($details['picture'] != '' and $details['picture'] != null) {
           $actualPicture =  url('image/'.$details['picture']);
       }
   } else{
       $projectManagersList = $projectManagers;

   }
   ?>
    <div class="italic_bg td">{{ Form::text('project_title', null, array("class"=>"text-field", "placeholder"=>__('sentence.project_manage.project_title'))) }}</div>
    <div class="select-admin td">
        {{Form::select('fk_businessUnitId',$businessUnits, null, array( 'placeholder'=>'Select'))}}
    </div>
    <div class="italic_bg td">{{ Form::text('sponsor_name', null, array("class"=>"text-field", "placeholder"=>__('sentence.project_manage.s_name'))) }}</div>
    <div class="select-admin td">
        {{Form::select('project_manager', $projectManagersList, null, array('placeholder'=>'Select'))}}
    </div>
    <div class="italic_bg td">{{ Form::text('estimated_start_date', null, array("class"=>"text-field datepicker", "placeholder"=>"Start", "data-date-inline-picker"=>"true")) }}</div>
    <div class="italic_bg td">{{ Form::text('estimated_end_date', null, array("class"=>"text-field datepicker", "placeholder"=>"End")) }}</div>
    <div class="checkbox_outer td" style="text-align:center">{{Form::checkbox('is_public', null)}}<label class="one"></label></div>
    <div class="checkbox_outer td" style="text-align:center">{{Form::checkbox('is_group', null)}}<label class="one"></label></div>
    <div class="checkbox_outer td" style="text-align:center">{{Form::checkbox('is_active', null)}}<label class="one"></label></div>
    <div class="td" style="text-align:center"> <img src="{{$picture}}" class="pop-up-img @if($formId == 0) btn-disabled @endif" id="form_picture_{{$formId}}" @if($formId == 0) onClick="openImageModal('{{$formId}}', 'project', '')" @else onClick="openImageModal('{{$formId}}', 'project', '{{$actualPicture}}')" @endif></div>
	{{Form::hidden('id', null)}}
	 @if($formId == 0)
        {{Form::hidden('picture', null, array('id'=>'picture_'.$formId))}}
    @endif
    <div class="td_add_btn @if($formId == 0) btn-disabled @endif td" id = "button_div_{{$formId}}"><button type="submit" class="submit-btn" id="button_{{$formId}}" @if($formId == 0) disabled @endif>{{$buttonText}}</button></div>
{{Form::close()}}