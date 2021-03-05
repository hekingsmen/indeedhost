@extends('backend.layouts.master')
@section('content')

     <div class="lyerco_right_table project_inner_table col-md-9 col-sm-9 ">
        <div class="table_heading_text define_float">
           <h2>{{__('sentence.my_project.project_management')}}</h2>
        </div>


        <div class="table table-bordered project-management-inner">
           <div class="heading-table">
              <div class="row-table">
                <div class="th">
                    {!! sorting(__('sentence.my_project.projects'), 'project_title', $sortOrder ?? '') !!}
                </div>
                <div class="th">
                    {!! sorting(__('sentence.my_project.department'), 'department_name', $sortOrder ?? '') !!}
                </div>
                <div class="th">
                    {!! sorting(__('sentence.my_project.active'), 'is_active', $sortOrder ?? '') !!}
                </div>
                <div class="th">
                    {!! sorting(__('sentence.my_project.group'), 'is_group', $sortOrder ?? '') !!}
                </div>
                <div class="th">
                    {!! sorting(__('sentence.my_project.latest_update'), 'project_status_updated_at', $sortOrder ?? '') !!}
                </div>
                <div class="th icon-heading">
                    <img src="{{url('dist/images/clock.png')}}">
                    {!! sorting('', 'time_status', $sortOrder ?? '') !!}
                </div>
                <div class="th icon-heading">
                    <img src="{{url('dist/images/star.png')}}">
                    {!! sorting('', 'current_status', $sortOrder ?? '') !!}
                </div>
                 <div class="coin th">
                    <img src="{{url('dist/images/coins.png')}}">
                     {!! sorting('', 'cost_status', $sortOrder ?? '') !!}
                </div>
                <div class="th">
                    <p>{{__('sentence.my_project.action')}}</p>                             
                </div>
              </div>
           </div>

            <div class="tbody" id="pagination">
                @include('backend.myproject.pagination', $all_projects)
            </div>
        </div>


      </div>
@endsection