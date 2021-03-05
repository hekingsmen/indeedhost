<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lyreco</title>

    <link rel="stylesheet" href="{{url('dist/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{url('dist/css/style.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://foliotek.github.io/Croppie/croppie.css">
    <link rel="stylesheet" href="{{url('dist/css/responsive.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
</head>

   <body>
      <!--logo-section-->
      <div class="top_header define_float">
         <div class="container">
            <div class="top_header_main define_float">
               <div class="top_header_left col-md-6 col-sm-6 col-xs-6">
                  <div class="logo_section define_float">
                     <a href="javascript:void(0)"><img src="images/logo.svg" alt="logo"></a>
                     <h2>Project Dashboard</h2>
                  </div>
               </div>
               <div class="top_header_right col-md-6 col-sm-6 col-xs-6">
                  <div class="top_header_right_inner">
                     <ul>
                        <li><a href="javascript:void(0);">Hello, Max Mustermann<img src="images/client.png" alt="client"></a></li>
                        <li><a href="javascript:void(0);">Dashboard</a></li>
                        <li><a href="javascript:void(0);">Log out</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--End-->
      <!--Nav-SEction-->
      <div class="header_nav define_float">
         <div class="container">
            <div class="header_nav_main define_float">
               <a href="javascript:void(0);">Admin </a>
               <span>/</span>
               <a href="javascript:void(0);">Users</a>
            </div>
         </div>
      </div>
      <!--End-->
      <!--Table-->
      <div class="lyerco_table define_float">
         <div class="container">
            <div class="lyerco_table_main define_float">
               <div class="lyerco_left_table col-md-3">
                  <div class="lyerco_left_table_inner define_float">
                     <ul>
                        <h6>Admin Panel</h6>
                        <li class="user_active"><a href="javascript:void(0);">Business Units</a></li>
                        <li><a href="javascript:void(0);">Roles</a></li>
                        <li><a href="javascript:void(0);">Users</a></li>
                        <li><a href="javascript:void(0);">Projects</a></li>
                        <h6>Project Panel</h6>
                        <li><a href="javascript:void(0);">My Projects</a></li>
                        <h6>Reporting Panel</h6>
                        <li><a href="javascript:void(0);">Status Updates</a></li>
                        <h6>User Panel</h6>
                        <li><a href="javascript:void(0);">My Profile</a></li>
                     </ul>
                  </div>
               </div>
               <div class="lyerco_right_table business-unit col-md-9">
                  <div class="table_heading_text define_float">
                     <h2>BU Management</h2>
                  </div>
                  <div class="table table-bordered table-business">
                     <div class="heading-table">
                        <div class="row-table">
                           <div class="th">
                              <p>Department</p>
                              <span>
                              <img src="images/up-arrow.png">
                              <img src="images/down-arrow.png">
                              </span>
                           </div>
                           <div class="th">
                              <p>PICTURE</p>
                           </div>
                           <div class="th action-column">
                              <p>ACTION</p>
                           </div>
                        </div>
                     </div>
                     <div class="tbody">
                        <div class="modify-row row-table">
                           <div class="td"><b>Business Unit A</b><span>|</span></div>
						   
						   
						   
						   
						   
                           <div class="td img-cropify">
						   <!--modal start-->                               
						   <label class="cabinet center-block">
							  <figure>
								 <img src="http://localhost/lyreco/public/dist/images/project-img-z.png" id="item-img-output" />
								 <figcaption></figcaption>
							  </figure>
							  <input type="file" class="item-img file center-block" name="file_photo"/>
						   </label>        
                              <div class="modal fade img-crop" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">							
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h5 class="modal-title" id="exampleModalLabel">Choose BU Image</h5>
										              <h4 class="modal-title" id="myModalLabel">
                                                Edit Photo
                                             </h4>
                                       </div>
                                       <div class="modal-body">
                                          <div id="upload-demo" class="center-block"></div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default modal-delete-image" data-dismiss="modal">Delete image</button>
                                          <button type="button" id="cropImageBtn" class="btn btn-primary modal-save-image">SAVE CHANGES</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           <!--MODAL END -->						   
						   
						   </div>
						   
						   
						   
                           <div class="td_add_btn td">
                              <a href="javascript:void(0);">SAVE</a>
                           </div>
                        </div>
                        <div class="row-table">
                           <div class="td">Business Unit B</div>
                           <div class="td"><img src="http://localhost/lyreco/public/dist/images/project-img-z.png"></div>
                           <div class="update-btn td">
                              <a href="javascript:void(0);">modify</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">delete</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">hide</a>
                           </div>
                        </div>
                        <div class="row-table">
                           <div class="td">Business Unit C</div>
                           <div class="td"><img src="http://localhost/lyreco/public/dist/images/project-img-z.png"></div>
                           <div class="update-btn td">
                              <a href="javascript:void(0);">modify</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">delete</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">hide</a>
                           </div>
                        </div>
                        <div class="row-table">
                           <div class="td">Business Unit D</div>
                           <div class="td"></div>
                           <div class="update-btn td">
                              <a href="javascript:void(0);">modify</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">delete</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">hide</a>
                           </div>
                        </div>
                        <div class="row-table">
                           <div class="td">Business Unit X</div>
                           <div class="td"><img src="http://localhost/lyreco/public/dist/images/project-img-z.png"></div>
                           <div class="update-btn td">
                              <a href="javascript:void(0);">modify</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">delete</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">hide</a>
                           </div>
                        </div>
                        <div class="row-table">
                           <div class="td">Business Unit Y</div>
                           <div class="td"><img src="http://localhost/lyreco/public/dist/images/project-img-z.png"></div>
                           <div class="update-btn td">
                              <a href="javascript:void(0);">modify</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">delete</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">hide</a>
                           </div>
                        </div>
                        <div class="row-table">
                           <div class="td">Business Unit Z</div>
						   <div class="td"></div>                              
                           <div class="update-btn td">
                              <a href="javascript:void(0);">modify</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">delete</a>
                              <span>|</span> 
                              <a href="javascript:void(0);">hide</a>
                           </div>
                        </div>
                        <div class="row-table">
                           <div class="italic_bg td">Add Business Unit</div>
                           <div class="italic_bg td">
                              <img src="http://localhost/lyreco/public/dist/images/project-img-z.png" class="pop-up-img" data-toggle="modal" data-target="#exampleModal">
                           </div>
                           <div class="td_add_btn btn-disabled td"><a href="javascript:void(0);" >ADD</a></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--End-->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://foliotek.github.io/Croppie/croppie.js"></script>
      <script src="http://lyreco.homeshom.com/dist/js/bootstrap.js"></script>
      <script>
         var input = document.getElementById( 'file-upload' );
         var infoArea = document.getElementById( 'file-upload-filename' );
         
         input.addEventListener( 'change', showFileName );
         
         function showFileName( event ) {
           
           // the change event gives us the input it occurred in 
           var input = event.srcElement;
           
           // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
           var fileName = input.files[0].name;
           
           // use fileName however fits your app best, i.e. add it into a div
           infoArea.textContent = 'File name: ' + fileName;
         }
      </script>
      <script>
         // Start upload preview image
         $(".gambar").attr("src", "https://user.gadjian.com/static/images/personnel_boy.png");
         						var $uploadCrop,
         						tempFilename,
         						rawImg,
         						imageId;
         						function readFile(input) {
         				 			if (input.files && input.files[0]) {
         				              var reader = new FileReader();
         					            reader.onload = function (e) {
         									$('.upload-demo').addClass('ready');
         									$('#cropImagePop').modal('show');
         						            rawImg = e.target.result;
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
         								height: 200,
         							},
         							enforceBoundary: false,
         							enableExif: true
         						});
         						$('#cropImagePop').on('shown.bs.modal', function(){
         							// alert('Shown pop');
         							$uploadCrop.croppie('bind', {
         				        		url: rawImg
         				        	}).then(function(){
         				        		console.log('jQuery bind complete');
         				        	});
         						});
         
         						$('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
         																										 $('#cancelCropBtn').data('id', imageId); readFile(this); });
         						$('#cropImageBtn').on('click', function (ev) {
         							$uploadCrop.croppie('result', {
         								type: 'base64',
         								format: 'jpeg',
         								size: {width: 150, height: 200}
         							}).then(function (resp) {
         								$('#item-img-output').attr('src', resp);
         								$('#cropImagePop').modal('hide');
         							});
         						});
         				// End upload preview image
      </script>
   </body>
</html>