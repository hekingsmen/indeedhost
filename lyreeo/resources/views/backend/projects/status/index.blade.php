@extends('backend.layouts.master')
@section('content')
    <div class="lyerco_right_table project_inner_table col-md-9 col-sm-9">
        <div class="table_heading_text define_float latest-heading">
            <h2>{{__('sentence.project_status.latest_status_updates')}}</h2>
	       <span>
              <a class="pop-up-img __statusUpdate" data-project-id="all" data-toggle="modal" data-heading="{!! __('sentence.project_status.reminder_alert_all_heading') !!}" data-message="{!! __('sentence.project_status.reminder_alert_all') !!}" data-target="#status_update" href="javascript:void(0);">{!! __('sentence.project_status.remind_all') !!}</a>
           </span>
        </div>
        <div class="table table-bordered project-management-inner latest-project-status">
            <div class="heading-table">
                <div class="row-table">
                    <div class="th">
                        {!! sorting(__('sentence.project_status.projects'), 'project_title', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_status.department'), 'department_name', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_status.sponsor'), 'sponsor_name', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_status.group'), 'is_group', $sortOrder) !!}
                    </div>
                    <div class="th">
                        {!! sorting(__('sentence.project_status.latest_update'), 'project_status_updated_at', $sortOrder) !!}
                    </div>
                    <div class="th icon-heading">
                        <img src="{{url('dist/images/clock.png')}}">
                        {!! sorting('', 'time_status', $sortOrder) !!}
                    </div>
                    <div class="th icon-heading">
                        <img src="{{url('dist/images/star.png')}}">
                        {!! sorting('', 'current_status', $sortOrder) !!}
                    </div>
                    <div class="coin th">
                        <img src="{{url('dist/images/coins.png')}}">
                        {!! sorting('', 'cost_status', $sortOrder) !!}
                    </div>
                    <div class="th">
                        <p>{{__('sentence.project_status.action')}}</p>
                    </div>
                </div>
            </div>
            <div class="tbody" id="pagination">
                @include('backend.projects.status.pagination', $all_projects)
            </div>
        </div>
    </div>
    @include('backend.layouts.reminder')
@endsection