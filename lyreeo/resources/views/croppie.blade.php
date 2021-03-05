<link rel="Stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/demo/prism.css" />
    <link rel="Stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/bower_components/sweetalert/dist/sweetalert.css" /><link rel="stylesheet" href="{{url('dist/css/bootstrap.css')}}" />
    <link rel="Stylesheet" type="text/css" href="{{url('dist/cropie/style.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script><script src="{{url('dist/js/bootstrap.js')}}"></script>
    <script src="https://foliotek.github.io/Croppie/croppie.js"></script><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">  Launch demo modal</button><!-- Modal --><div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  <div class="modal-dialog" role="document">    <div class="modal-content">      <div class="modal-header">        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>        <button type="button" class="close" data-dismiss="modal" aria-label="Close">          <span aria-hidden="true">&times;</span>        </button>      </div>      <div class="modal-body">       	   	   	   	   <div class="col-sm-12 no-padding">    <input type="hidden" name="picture" id="base64image" value="">    <div class="col-sm-12 no-padding">    <div class="upload-demo-wrap">    <div id="upload-demo"></div>    </div>    </div>    <div class="col-sm-12 no-padding profileupload text-center">    <label class="btn-bs-file btn btn-sm btn-success">    <i class="fa fa-plus"></i> &nbsp;Select Photo *        <input id="upload" value="Choose Picture" accept="image/*" type="file">    </label>    </div>    </div>	   	   	   	   	         </div>      <div class="modal-footer">        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        <button type="button" class="btn btn-primary">Save changes</button>      </div>    </div>  </div></div>

    

    <script>

        function demoUpload() {
            var $uploadCrop;

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#upload-demo').addClass('ready');
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
                    width: 150,
                    height: 150,
                    type: 'square'
                },
                enforceBoundary:true,
                enableResize:true,
                enableZoom:true,
                showZoomer:true,
                enableExif: true
            });

            $('#upload').on('change', function () {
                //showModal();
                readFile(this);
            });

            //$('#cropped-image-btn').on('click', function (ev) {
            $('.cr-slider').on('change', function (ev) {
                if($('#upload').val() != ''){
                    $uploadCrop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function (resp) {
                        /*popupResult({
                         src: resp
                         });*/
                        console.log(resp);
                        $('#base64image').val(resp);
                    });
                }

            });

        }

    demoUpload();
</script>