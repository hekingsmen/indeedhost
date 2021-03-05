 <?php
    $actualPicture = $class= $uniqueClass='';
	if($details != null){
		$uniqueClass = "form_row";
	}
    if($details != null and $details['picture'] != null and $details['picture'] != ''  and is_file(public_path('image/'.$businessUnit['picture']))){
        $actualPicture =  url('image/'.$details['picture']);
		$class="row-top-table";
    }
    ?>
{{Form::model($details, array('url'=>route('saveBusinessUnit'), 'id'=>'form_'.$formId, 'data-id'=>$formId, 'class'=>'row-table ajax-submit '.$class. ' '.$uniqueClass, 'style'=>'display:'.$display.';'))}}
   
 <div class="italic_bg td">{{Form::text('department_name', null, array('class'=>"text-field", 'placeholder'=> __('sentence.bu_unit.bu_unit_placeholder')))}}</div>
    <div class="italic_bg td">
        <img src="{{$picture}}" class="pop-up-img  @if($formId == 0) btn-disabled @endif" id="form_picture_{{$formId}}" @if($formId == 0) onClick="openImageModal('{{$formId}}', 'business_unit', '')" @else onClick="openImageModal('{{$formId}}', 'business_unit', '{{$actualPicture}}')" @endif>
    </div>
    {{Form::hidden('id', null)}}
    @if($formId == 0)
        {{Form::hidden('picture', null, array('id'=>'picture_'.$formId))}}
    @endif
    <div class="td_add_btn @if($formId == 0) btn-disabled @endif td"><button type="submit" class="submit-btn" @if($formId == 0) disabled @endif id="button_{{$formId}}">{{$buttonText}}</button></div>

</form>