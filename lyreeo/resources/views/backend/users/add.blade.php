    <?php
     $uniqueClass='';
	if($details != null){
		$uniqueClass = "form_row";
	}
	?>
   {{Form::model($details, array('url'=>route('createUserDetail'), 'id'=>'form_'.$formId, 'data-id'=>$formId, 'class'=>'row-table ajax-submit '.$uniqueClass, 'style'=>'display:'.$display.';'))}}
        <div class="italic_bg td">{{Form::text('name', null, array('class'=>"text-field", 'placeholder'=>__('sentence.user_manage.username_placeholder')))}}</div>
        <div class="select-admin td">
            {{Form::select('role',$roles, null, array( 'placeholder'=>__('sentence.user_manage.role_placeholder')))}}
        </div>
        <div class="italic_bg td">{{Form::text('email', null, array('class'=>"text-field", 'placeholder'=>__('sentence.user_manage.email_placeholder') ))}}</div>
        {{Form::hidden('id', null)}}
        <div class="td_add_btn @if($formId == 0) btn-disabled @endif td"   id = "button_div_{{$formId}}"><button type="submit" class="submit-btn" id="button_{{$formId}}" @if($formId == 0) disabled @endif>{{$buttonText}}</button></div>
   {{Form::close()}}

