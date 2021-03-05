
@foreach($businessUnits as $businessUnit)
    @php $picture = url('dist/images/project-img-z.png'); @endphp
    @if(isset($businessUnit['picture']) and $businessUnit['picture'] != null and is_file(public_path('image/'.$businessUnit['picture'])))
        @php $picture = url('image/'.$businessUnit['picture']); @endphp
     @endif
    <div class="row-table" id="row_{{$businessUnit->id}}">
        @if($businessUnit['is_hidden'] == 1)
            <div class="td">{{ __('sentence.hidden')}}:  {{ $businessUnit['department_name'] }}</div>
        @else
            <div class="td"> {{ $businessUnit['department_name'] }}</div>
        @endif
        <div class="td"><img src="{{$picture}}" id="row_picture_{{$businessUnit->id}}"></div>
        <div class="update-btn td">
            <a href="javascript:void(0);" class="disableIfOneActive" onClick="showForm({{$businessUnit->id}})">{{ __('sentence.bu_unit.modify')}}</a>
            <span>|</span>
            <a href="javascript:void(0);" class="__drop" data-url="{!! route('deleteBusinessUnit', $businessUnit->id) !!}" data-heading="{{ __('sentence.bu_unit.delete_heading')}}" data-message="{{__('sentence.bu_unit.delete_alert', ['buName'=>$businessUnit->department_name])}}">{{ __('sentence.bu_unit.delete')}}</a>
            <span>|</span>
            <a href="javascript:void(0);" class="__toggle" data-id="{{$businessUnit->id}}" data-route="{!! route('toggleBUStatus') !!}">@if($businessUnit['is_hidden'] == 1) {{ __('sentence.bu_unit.unhide')}} @else {{ __('sentence.bu_unit.hide')}} @endif</a>
        </div>
    </div>
    @include('backend.business_units.add', ['details'=>$businessUnit, 'display'=>'none', 'formId'=>$businessUnit->id, 'picture'=>$picture, 'buttonText'=>__('sentence.bu_unit.save')])
@endforeach
@include('backend.business_units.add', ['details'=>[], 'display'=>'', 'formId'=>0, 'picture'=>url('dist/images/project-img-z.png'), 'buttonText'=>__('sentence.bu_unit.add')])
