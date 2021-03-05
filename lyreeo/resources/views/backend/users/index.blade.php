@extends('backend.layouts.master')
@section('content')
         <div class="lyerco_right_table col-md-9 col-sm-9 user-management-table" id="data_table">
                    <div class="table_heading_text define_float">
                        <h2>{{ __('sentence.user_manage.user_management')}}</h2>
                    </div>
                    <div class="table table-bordered" >
                        <div class="heading-table">
                            <div class="row-table">
                                <div class="th">
                                    {!! sorting( __('sentence.user_manage.username'), 'name', $sortOrder) !!}
                                </div>
                                <div class="th">
                                    {!! sorting( __('sentence.user_manage.role'), 'role_name', $sortOrder) !!}
                                </div>
                                <div class="th">
                                    {!! sorting( __('sentence.user_manage.email'), 'email', $sortOrder) !!}
                                </div>
                                <div class="th"><p>{{ __('sentence.user_manage.action')}}</p></div>
                            </div>
                        </div>
                        <div class="tbody" id="pagination">
                            @include('backend.users.pagination', $users)
                        </div>
                    </div>
                </div>
@endsection