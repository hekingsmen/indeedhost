@extends('backend.layouts.master')
@section('content')
    <div class="lyerco_right_table role-management col-md-9 col-sm-9" id="data_table">
        <div class="table_heading_text define_float">
            <h2>{{ __('sentence.role_manage.role_management')}}</h2>
        </div>
        <div class="table table-bordered table-role">
            <div class="heading-table">
                <div class="row-table">
                    <div class="th">
                        {!! sorting(__('sentence.role_manage.role_name'), 'name', $sortOrder) !!}
                    </div>
                    <div class="th">
                        <p>{{ __('sentence.role_manage.admin_panel')}}</p>
                    </div>
                    <div class="th">
                        <p>{{ __('sentence.role_manage.project_mgmt')}}<br></p>
                    </div>
                    <div class="th"><p>{{ __('sentence.role_manage.reporting')}}<br></p></div>
                    <div class="th">
                        <p>{{ __('sentence.role_manage.front_end_full_view')}}</p>
                    </div>
                    <div class="th">
                        <p>{{ __('sentence.role_manage.alerts')}}</p>
                    </div>
                    <div class="th">
                        <p>{{ __('sentence.role_manage.action')}}</p>
                    </div>
                </div>
            </div>
            <div class="tbody" id="pagination">
                @include('backend.roles.pagination', $roles)

            </div>
        </div>
    </div>
@endsection