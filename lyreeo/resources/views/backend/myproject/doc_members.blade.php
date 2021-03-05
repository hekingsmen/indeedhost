@php $user_id = Auth::user()->id; @endphp
<div class="project-details-main project-members">
	<h2>{{__('sentence.project_detail_manage.project_members')}}
		@if(__('sentence.project_detail_manage.project_members_tooltip') != '' )
			<sup><i class="fa fa-question-circle tooltip-icon" aria-hidden="true" data-tooltip-content="{!! __('sentence.project_detail_manage.project_members_tooltip') !!}"></i></sup>
		@endif
	</h2>
	<div class="project-tagsarea add-members-todiv">
		<div class="add-tags add-tag" id="autocomplete">
			<ul id="options">
				<input type="text" data-id="" data-projectid="" class="tags-field" id="projectMembers" name="members" autocomplete="off" >
			</ul>
			<button class="add-tags-btn" id="addToMembers" onclick="addToMember()" >{{__('sentence.project_detail_manage.project_memberadd_button')}}</button>
		</div>
		@if(!empty($projectMembers))
            @foreach($projectMembers as $member)
				<div class="add-tags removeMaindiv">
					<p>{{$member->fk_username}} &nbsp&nbsp&nbsp&nbsp <span class="removeMem" data-table="member" data-id="{{$member->id}}" route="{{route('remove.document')}}"><img src="{{ asset('dist/images/check-2.png') }}"></span></p>
				</div>
			@endforeach
		@endif
	</div>
</div> 