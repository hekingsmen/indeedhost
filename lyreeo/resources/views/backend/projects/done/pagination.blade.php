@foreach($doneProjects as $project)
    @if(isset($project['picture']) and $project['picture'] != null)
        @php $picture = url('image/'.$project['picture']); @endphp
    @else
        @php $picture = url('dist/images/project-img-z.png'); @endphp
    @endif
    <div class="row-table" id="row_{{$project->id}}">
        <div class="td"><a href="{{url('about/project-detail/'.$project->id)}}"  target="_blank">{{ $project->project_title }}</a></div>
        <div class="td">{{ $project->department_name }}</div>
        <div class="td">{{ $project->sponsor_name }}</div>

        <div class="td">{{ $project->project_manager_name }}</div>
        <div class="td">{{ \Carbon\Carbon::parse($project->estimated_start_date )->format('d/m/y') }}</div>
        <div class="td">{{ \Carbon\Carbon::parse($project->estimated_end_date )->format('d/m/y') }}</div>
        <div class="td">@if($project->real_start_date != null) {{ \Carbon\Carbon::parse($project->real_start_date )->format('d/m/y') }} @endif</div>
        <div class="td">@if($project->real_start_date != null) {{ \Carbon\Carbon::parse($project->realistic_end_date )->format('d/m/y') }} @endif</div>
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($project['is_active'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="td" style="text-align:center">{{calculateGoLive($project->projectEndDate)}} </div>
        <div class="update-btn td">
            <a class="pop-up-img __statusUpdate"  data-toggle="modal" data-project-id="{{$project->id}}" data-heading="{{__('sentence.project_status.inform_heading')}}" data-message="{{__('sentence.project_status.inform_alert', ['project'=>$project->project_title])}}" data-id="{{ $project->id }}" data-target="#status_update" href="#">{{__('sentence.project_status.inform')}}</a>
        </div>
    </div>
@endforeach
