@extends('backend.layouts.master')
@section('content')
    <div class="lyerco_right_table business-unit col-md-9 col-sm-9 col-xs-9"  id="data_table">
        <div class="table_heading_text define_float">
            <h2>{{ __('sentence.bu_unit.bu_management')}}</h2>
        </div>
        <div class="table table-bordered table-business">
            <div class="heading-table">
                <div class="row-table">
                    <div class="th">
                        {!! sorting( __('sentence.bu_unit.department'), 'department_name', $sortOrder) !!}

                    </div>
                    <div class="th">
                        <p>{{ __('sentence.bu_unit.picture')}}</p>
                    </div>
                    <div class="th action-column">
                        <p>{{ __('sentence.bu_unit.action')}}  <a href="javascript:void(0);"  id="successtoast" class="btn-icon-text">						
							  </a></p>
                    </div>
                </div>
            </div>
            <div class="tbody" id="pagination">
                @include('backend.business_units.pagination', $businessUnits)
                </div>
        </div>
    </div>


    @include('backend.layouts.cropie_file_upload', ['picture'=>'', 'type'=>'business_unit', 'id'=>0, 'title'=>__('sentence.bu_unit.choose_image')])
@endsection

@section('scripts')

    <script src="https://foliotek.github.io/Croppie/croppie.js"></script>
    <script src="{{url('dist/cropie/cropify_script.js')}}"></script>
    <script>
        demoUpload();
      function openImageModal(id, type, picture){
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
