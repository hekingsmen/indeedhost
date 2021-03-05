 <?php
     $uniqueClass='';
	if($details != null){
		$uniqueClass = "form_row";
	}
	?>
{{Form::model($details, array('url'=>route('roleSave'), 'id'=>'form_'.$formId, 'data-id'=>$formId, 'class'=>'row-table ajax-submit '.$uniqueClass, 'style'=>'display:'.$display.';'))}}
    <div class="italic_bg td">{{Form::text('name', null, array('class'=>"text-field", 'placeholder'=>__('sentence.role_manage.role_name_placeholder') ))}}</div>
    <div class="checkbox_outer td" style="text-align:center">{{Form::checkbox('admin_panel', null)}}<label class="one"></label></div>
    <div class="checkbox_outer td" style="text-align:center">{{Form::checkbox('project_management_panel', null)}}<label class="one"></label></div>
    <div class="checkbox_outer td" style="text-align:center">{{Form::checkbox('reporting_panel', null)}}<label class="one"></label></div>
    <div class="checkbox_outer td" style="text-align:center">{{Form::checkbox('front_end_view_panel', null)}}<label class="one"></label></div>
    <div class="checkbox_outer td" style="text-align:center">{{Form::checkbox('alerts', null)}}<label class="one"></label></div>
    {{Form::hidden('id', null)}}

    <div class="td_add_btn @if($formId == 0) btn-disabled @endif td" id = "button_div_{{$formId}}"><button type="submit" class="submit-btn" id="button_{{$formId}}">{{$buttonText}}</button></div>
{{Form::close()}}