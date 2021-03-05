{{--<link rel="Stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/demo/prism.css" />
<link rel="Stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/bower_components/sweetalert/dist/sweetalert.css" />

<link rel="stylesheet" href="{{url('dist/cropie/style.css')}}" />--}}

<div class="modal fade img-crop" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{Form::open(array('url'=>url('admin/upload/picture'), 'class'=>'ajax-submit', 'id'=>'image_upload'))}}
            <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="fileUploadModalLabel">Choose BU Image</h5>           
            </div>
            <div class="modal-body">
                <ul >
                    <li>Image needs to be in jpg or png format</li>
                    <li>Max 20MB</li>
                </ul>
                <div class="col-sm-12 no-padding cropify-img-section">
                    <div class="abc"  id="picture_upload_div">
                        <div id="upload-demo" class="center-block">
							<div class="drag-reposition"><img src="{{ asset('dist/images/drag-image.png') }}" alt="drag-reposition"></div>
						</div>
						<div class="zoom-minus-option" id="zoomMinus">-</div>
						<div class="zoom-plus-option" id="zoomPlus">+</div>
                    </div>
                </div>
                <label class="hideOnAction" >
                    <i class="fa fa-plus"></i>Select file from your computer
                    <input id="upload" value="Choose Picture" accept="image/*" type="file" style="display:none;">
                </label>
				<div class="uploading-text" id="selected_image_detail" style="display:none;">
					<p><b id="selected_image_name"></b></p>
					<a id="showImagePreview">Upload Image</a>
				</div>
				<div class="uploading-text uploading-image"  id="image_uploading" style="display:none;">
					<p>Uploading image … please wait</p>																				
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-delete-image" id="resetCropie" style="display:none;">Delete image</button>
                <input type="hidden" name="picture" id="base64image">
                <input type="hidden" name="id" id="element_id" value="{{$id}}">
                <input type="hidden" name="type" id="element_type" value="{{$type}}">
                <button type="submit" class="btn btn-primary pop-btn disabled" id="imageUploadButton">Save changes</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
