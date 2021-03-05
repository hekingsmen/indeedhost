@extends('backend.layouts.master')
@section('content')
    <div class="lyerco_right_table project_inner_table col-md-9 col-sm-9" id="data_table">
        <div class="table_heading_text define_float latest-heading">
            <h2>{{__('sentence.project_manage.done_but_active_projects')}}</h2>
             <span>
                <a class="pop-up-img __statusUpdate" data-project-id="all" data-toggle="modal" data-heading="{!! __('sentence.project_status.inform_all_heading') !!}" data-message="{!! __('sentence.project_status.inform_alert_all') !!}" data-target="#status_update" href="javascript:void(0);">{!! __('sentence.project_status.inform_all') !!}</a>
             </span>
        </div>
        <div class="table table-bordered project-table active-project done-projects">
            <div class="heading-table">
                <div class="row-table">
                    <div class="th">
                        <p>{!! sorting(__('sentence.project_manage.project_title'), 'project_title', $sortOrder) !!} </p>
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.busin').' '.__('sentence.project_manage.unit'), 'department_name', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.sponsor'), 'sponsor_name', $sortOrder) !!}
                    </div>

                    <div class="th">
                        {!! sorting(__('sentence.project_manage.pm'), 'project_manager_name', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.start').'<br>'. __('sentence.project_manage.est'), 'estimated_start_date', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.end').'<br>'. __('sentence.project_manage.est'), 'estimated_end_date', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.real_start'), 'real_start_date', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_manage.realistic_end'), 'realistic_end_date', $sortOrder) !!}
                    </div>
                    <div class="th action-header">
                        {!! sorting(__('sentence.project_manage.a'), 'is_active', $sortOrder) !!}
                    </div>
                    <div class="th">
                        <p>{!! __('sentence.project_manage.go_live') !!}</p>
                    </div>
                    <div class="th">
                        <p>{{__('sentence.project_manage.action')}}</p>
                    </div>
                </div>
            </div>
            <div class="tbody" id="pagination" >
                @include('backend.projects.done.pagination', $doneProjects)
            </div>

        </div>

    </div>
    @include('backend.layouts.inform')
 @endsection
