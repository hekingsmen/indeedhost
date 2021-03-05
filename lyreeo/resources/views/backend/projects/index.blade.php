@extends('backend.layouts.master')
@section('content')
    <div class="lyerco_right_table project_inner_table col-md-9 col-sm-9" id="data_table">
        <div class="table_heading_text define_float active-project-heading">
            <h2>{{__('sentence.project_manage.active')}} {{__('sentence.project_manage.projects')}}</h2>
			<span>
            <a class="active-heading" href="{{ url('admin/project/add') }}">{{__('sentence.project_manage.create_new_project')}}</a>
         </span>
        </div>
        <div class="table table-bordered project-table active-project">
            <div class="heading-table">
                <div class="row-table">
                    <div class="th">
                        <p>{!! sorting(__('sentence.project_manage.project_title'), 'project_title', $sortOrderActive) !!} </p>
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.busin').' '.__('sentence.project_manage.unit'), 'department_name', $sortOrderActive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.sponsor'), 'sponsor_name', $sortOrderActive) !!}
                    </div>

                    <div class="th">
                        {!! sorting(__('sentence.project_manage.pm'), 'project_manager_name', $sortOrderActive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.start').'<br>'. __('sentence.project_manage.est'), 'estimated_start_date', $sortOrderActive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.end').'<br>'. __('sentence.project_manage.est'), 'estimated_end_date', $sortOrderActive) !!}
                    </div>
                    <div class="th publish-header">
                        {!! sorting(__('sentence.project_manage.p'), 'is_public', $sortOrderActive) !!}
                    </div>
                    <div class="th">
                         {!! sorting(__('sentence.project_manage.g'), 'is_group', $sortOrderActive) !!}
                    </div>
                    <div class="th action-header">
                        {!! sorting(__('sentence.project_manage.a'), 'is_active', $sortOrderActive) !!}
                    </div>
                    <div class="th">
                        <p>{{__('sentence.project_manage.pic')}}</p>
                    </div>
                    <div class="th">
                        <p>{{__('sentence.project_manage.action')}}</p>
                    </div>
                </div>
            </div>
            <div class="tbody" id="pagination" >
                @include('backend.projects.active_pagination', $activeProjects)
            </div>
        </div>
        <div class="table_heading_text define_float inactive-heading">
            <h2>{{__('sentence.project_manage.inActive_Projects_archived')}}</h2>
        </div>
        <div class="table table-bordered project-table inactive-tabel">
            <div class="heading-table">
                <div class="row-table"  data-type="in_active_projects">
                    <div class="th">
                         <p>{!! sorting(__('sentence.project_manage.project_title'), 'project_title', $sortOrderActive) !!} </p>
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.busin').' '. __('sentence.project_manage.unit'), 'department_name', $sortOrderInActive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.sponsor'), 'sponsor_name', $sortOrderInActive) !!}
                    </div>

                    <div class="th">
                        {!! sorting(__('sentence.project_manage.pm'), 'project_manager_name', $sortOrderInActive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.start').'<br>'. __('sentence.project_manage.est'), 'estimated_start_date', $sortOrderInActive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.end').'<br>'. __('sentence.project_manage.est'), 'estimated_end_date', $sortOrderInActive) !!}
                    </div>
                    <div class="th publish-header">
                        {!! sorting(__('sentence.project_manage.p'), 'is_public', $sortOrderInActive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.g'), 'is_group', $sortOrderInActive) !!}
                    </div>
                    <div class="th action-header">
                        {!! sorting(__('sentence.project_manage.a'), 'is_active', $sortOrderInActive) !!}
                    </div>
                     <div class="th">
                        <p>{{__('sentence.project_manage.pic')}}</p>
                    </div>
                    <div class="th">
                        <p>{{__('sentence.project_manage.action')}}</p>
                    </div>
                </div>
            </div>
            <div class="tbody"  id="pagination1">
                @include('backend.projects.inactive_pagination', $inActiveProjects)
            </div>

        </div>

        <div class="update-btn td pull-right">
            <a href="{{route('archive_project')}}"  >{{__('sentence.project_manage.show_archived')}}</a>
        </div>
    </div>

    @include('backend.layouts.cropie_file_upload', ['picture'=>'', 'type'=>'project', 'id'=>0, 'title'=>__('sentence.project_manage.image_upload_modal_title')])
@endsection
@section('scripts')

    <script src="https://foliotek.github.io/Croppie/croppie.js"></script>
    <script src="{{url('dist/cropie/cropify_script.js')}}"></script>
    <script>
        demoUpload();
        function openImageModal(id, type, picture){
            //$('#resetCropie').trigger('click');
            $('#element_id').val(id);
            $('#element_type').val(type);
            $('#cropImagePop').modal({backdrop: 'static', keyboard: false});
			 if(picture != '') {
				  $('#pictureSelected').val(picture);
			 }
        }
		
		$( function() {
		 $( ".datepicker" ).datepicker();
	  } );
    </script>
@endsection