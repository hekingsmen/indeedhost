@foreach($roles as $role)
    <div class="row-table" id="row_{{$role->id}}">
        <div class="td">{{$role->name}}</div>
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($role['admin_panel'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($role['project_management_panel'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($role['reporting_panel'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($role['front_end_view_panel'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($role['alerts'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="update-btn td">
            @if(strtolower($role->name) != 'super admin')
                <a href="javascript:void(0);" class="disableIfOneActive" onClick="showForm({{$role->id}})">{{ __('sentence.role_manage.modify')}}</a>
                @if(strtolower($role->name) != 'guest')
					<span>|</span>
					<a href="javascript:void(0);" class="__drop" data-url="{!! route('deleteRole', $role->id) !!}" data-heading="{{ __('sentence.role_manage.delete_heading')}}" data-message="{{__('sentence.role_manage.delete_alert', ['roleName'=>$role->name])}}">{{ __('sentence.role_manage.delete')}}</a>
				@endif
            @endif
        </div>
    </div>
    @include('backend.roles.add', ['details'=>$role, 'display'=>'none', 'formId'=>$role->id, 'buttonText'=>__('sentence.role_manage.save')])
@endforeach
@include('backend.roles.add', ['details'=>[], 'display'=>'', 'formId'=>0, 'buttonText'=>__('sentence.role_manage.add')])