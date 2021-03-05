@foreach($users as $user)
    <div class="row-table" id="row_{{$user->id}}">
        <div class="td">{{ $user->name }}</div>
        <div class="td">@if($user->role_status == 1){{  $user->role_name }}@endif</div>
        <div class="td"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
        <div class="update-btn td">
            @if(strtolower($user->role_name) != 'super admin' and strtolower($user->id) != 2)
                <a href="javascript:void(0);" class="disableIfOneActive" onClick="showForm({{$user->id}})">{{ __('sentence.user_manage.modify')}}</a>
                <span>|</span>
                <a href="javascript:void(0);" class="__drop" data-url="{!! route('deleteUsersDetail', $user->id) !!}" data-heading="{{ __('sentence.user_manage.delete_heading')}}" data-message="{{__('sentence.user_manage.delete_alert', ['user'=>$user->name])}}">{{ __('sentence.user_manage.delete')}}</a>
            @endif
        </div>
    </div>
    @include('backend.users.add', ['details'=>$user, 'display'=>'none', 'formId'=>$user->id, 'buttonText'=> __('sentence.user_manage.save')])
@endforeach
@include('backend.users.add', ['details'=>[], 'display'=>'', 'formId'=>0, 'buttonText'=> __('sentence.user_manage.add')])