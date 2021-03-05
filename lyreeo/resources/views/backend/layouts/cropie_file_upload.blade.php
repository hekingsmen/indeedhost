<link rel="Stylesheet" type="text/css" href="{{url('dist/cropie/style.css')}}" />
<style>
    .cropify-img-section{padding:0;}

    .abc{
        opacity:0;
        visibility: hidden;
        height:0;
    }
</style>
<div class="modal fade img-crop" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
		 {{Form::open(array('url'=>url('admin/upload/picture'), 'class'=>'ajax-submit', 'id'=>'image_upload'))}}
            <div class="modal-header">				
			<button type="button" class="close" id="croppieModalClose"> <span aria-hidden="true">&times;</span> </button>
                <h5 class="modal-title" id="exampleModalLabel">@if(isset($title)) {{$title}} @endif</h5>
                
            </div>
            <div class="modal-body">
                <ul id="hideOnShowImagePreview" >
                    <li>{{ __('sentence.image_mime')}}</li>
                    <li>{{ __('sentence.image_size')}}</li>
                </ul>
                <div class="col-sm-12 no-padding cropify-img-section">
                    <input type="hidden" name="picture" id="base64image" value="">
                    <div class="col-sm-12 no-padding abc"  id="picture_upload_div">
                        <div class="upload-demo-wrap"  >
                            <div id="upload-demo">
                                <div class="drag-reposition"><img src="{{ asset('dist/images/drag-image.png') }}" alt="drag-reposition"></div>
                            </div>
                            <div class="zoom-minus-option" id="zoomMinus">-</div>
                            <div class="zoom-plus-option" id="zoomPlus">+</div>
                        </div>
                    </div>

                    <label class="hideOnAction" title="{{ __('sentence.select_file')}}">
                        <i class="fa fa-plus"></i>{{ __('sentence.select_file')}}
                        <input id="upload" value="Choose Picture" accept="image/*" type="file" style="display:none;">
                    </label>

                    {{--<div class="uploading-text" id="selected_image_detail" style="display:none;">
                        <p><b id="selected_image_name"></b></p>
                        <a id="showImagePreview">Upload Image</a>
                    </div>--}}
                    <div class="uploading-text uploading-image"  id="image_uploading" style="display:none;">
                        <p>{{ __('sentence.uploading')}}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-delete-image" id="resetCropie" style="display:none;">{{ __('sentence.delete_image') }}</button>
                <input type="hidden" name="id" id="element_id" value="{{$id}}">
                <input type="hidden" name="type" id="element_type" value="{{$type}}">
                <input type="hidden"  id="pictureSelected" value="{{$picture}}">
                <button type="submit" class="btn btn-primary pop-btn disabled" disabled id="imageUploadButton">{{ __('sentence.save_image_changes') }}</button>
            </div>
			 {{Form::close()}}
        </div>
    </div>
</div>
