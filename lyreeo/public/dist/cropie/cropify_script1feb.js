function popupResult(result) { //console.log(result);
    var html;
    if (result.html) {
        html = result.html;
    }
    if (result.src) {
        html = '<img src="' + result.src + '" />';
    }

    /*setTimeout(function(){

        $('#base64image').val(result.src);

    }, 1000);*/
    $('#base64image').val(result.src);
}


function demoUpload() {
    var viewport_type = $('#crop_type').val();
    if(viewport_type == undefined) {
        viewport_type = 'square';

    }
    var height = 350;
    var width = 400;
    if(viewport_type == 'circle'){
        var height = 300;
        var width = 300;
    }
    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
				
				 $('#selected_image_detail').show();
               
                $('.hideOnAction').hide();
                $('#upload-demo').addClass('ready');
                $('#selected_image_detail').show();
                $('#selected_image_name').html(input.files[0].name);
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    //console.log('jQuery bind complete');
                });

            }

            reader.readAsDataURL(input.files[0]);
        }
        else {
            swal("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: width,
            height: height,
            type: viewport_type
        },
        enforceBoundary:true,
        enableResize:false,
        enableZoom:true,
        showZoomer:true,
        enableExif: true
    });
    var croppieDetails = $uploadCrop.croppie('get');
    var zoom = croppieDetails['zoom']; 
    //$uploadCrop.croppie('setZoom', zoom);
    $('#zoomPlus').on('click', function () {
        zoom = zoom + 0.01;console.log(zoom);
        $uploadCrop.croppie('setZoom', zoom);
    });

    $('#zoomMinus').on('click', function () {
       zoom = zoom - 0.01;console.log(zoom);
        $uploadCrop.croppie('setZoom', zoom);
    });
	
  $('#upload').on('change', function () {
        $('.error').remove();
		var extension = $(this).val().split('.').pop().toLowerCase();
                var validFileExtensions = ['jpeg', 'jpg', 'png'];
				
				if(this.files[0].size > 20971520  || $.inArray(extension, validFileExtensions) == -1){// 
				
                    var error = '<div class="error">Sorry, your file did not meet the criteria</div>';
                    $('.hideOnAction').append(error)
                    return false;
                }
        readFile(this);
    });


    $('body').on('click', '.pop-up-img', function(e) {
	//$('.pop-up-img').on('click', function () { alert('called');;
        var picture = $('#pictureSelected').val();
        if(picture != '') {
            $('.hideOnAction').hide();
            $('#selected_image_name').html('');
            $('#upload-demo').addClass('ready');
            $('#resetCropie').show();
            $('#picture_upload_div').removeClass('abc');
            $('#imageUploadButton').removeClass('disabled');
            setTimeout(function(){
                $uploadCrop.croppie('bind', {
                    url: picture
                }).then(function(){

                });

            }, 1000);

        }
    });
	
    //$('#cropped-image-btn').on('click', function (ev) {
    $('.cr-slider').on('change', function (ev) {
        if($('#upload').val() != ''){
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                popupResult({
                    src: resp
                });
                //console.log(resp);
                //$('#base64image').val(resp);
            });
        }

    });
	
	$('#upload-demo').on('update.croppie', function(ev, cropData) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            popupResult({
                src: resp
            });
         });

    });

$("#resetCropie, #croppieModalClose").click(function () {
        $('#upload-demo').addClass('ready');
        $('#upload').val(''); // this will clear the input val.
        $('#base64image').val();
        $('#picture_upload_div').addClass('abc');
		$('.error').remove();
        $('#resetCropie').hide();
        $('.hideOnAction').show();
        $('#hideOnShowImagePreview').show();
        $('#imageUploadButton').addClass('disabled');
        $uploadCrop.croppie('bind', {
            url : ''
        }).then(function () {
            console.log('reset complete');
        });
    });
}



$('#showImagePreview').on('click', function (ev) {
    $('#image_uploading').show();
    $('#selected_image_detail').hide();
    $('#selected_image_name').html('');
    setTimeout(function() {
        $('#image_uploading').hide();
        $('#resetCropie').show();
        $('#imageUploadButton').removeClass('disabled');

        $('#picture_upload_div').removeClass('abc');

    }, 1000);
});


