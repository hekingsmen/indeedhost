@foreach($archivedProjects as $project)
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
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($project['is_public'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($project['is_group'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="checkbox_outer td" style="text-align:center"><input type="checkbox" @if($project['is_active'] == 1) checked @endif disabled><label class="one"></label></div>
        <div class="td" style="text-align:center"><img src="{{$picture}}"></div>
        <div class="update-btn td">
           <a href="javascript:void(0);" class="__toggle" data-route="{!! route('archiveProject') !!}" data-id="{{$project->id}}">{{__('sentence.project_manage.undo_archive')}}</a>
        </div>
    </div>
@endforeach
