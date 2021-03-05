@extends('backend.layouts.master')
@section('content')
    <div class="lyerco_right_table project_inner_table col-md-9 col-sm-9" id="data_table">
        <div class="table_heading_text define_float active-project-heading">
            <h2>{{__('sentence.project_manage.projects_archive')}}</h2>
        </div>
        <div class="table table-bordered project-table active-project">
            <div class="heading-table">
                <div class="row-table">
                    <div class="th">
                        <p>{!! sorting(__('sentence.project_manage.project_title'), 'project_title', $sortOrderArchive) !!} </p>
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.busin').' '.__('sentence.project_manage.unit'), 'department_name', $sortOrderArchive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.sponsor'), 'sponsor_name', $sortOrderArchive) !!}
                    </div>

                    <div class="th">
                        {!! sorting(__('sentence.project_manage.pm'), 'project_manager_name', $sortOrderArchive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.start').'<br>'. __('sentence.project_manage.est'), 'estimated_start_date', $sortOrderArchive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.end').'<br>'. __('sentence.project_manage.est'), 'estimated_end_date', $sortOrderArchive) !!}
                    </div>
                    <div class="th publish-header">
                        {!! sorting(__('sentence.project_manage.p'), 'is_public', $sortOrderArchive) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.g'), 'is_group', $sortOrderArchive) !!}
                    </div>
                    <div class="th action-header">
                        {!! sorting(__('sentence.project_manage.a'), 'is_active', $sortOrderArchive) !!}
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
                @include('backend.projects.archive.pagination', $archivedProjects)
            </div>

        </div>

    </div>

 @endsection
