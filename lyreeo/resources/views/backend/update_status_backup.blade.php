@extends('backend.layouts.master')
@section('content')
   <div class="lyerco_right_table project_inner_table col-md-9 col-sm-9">
      <div class="table_heading_text define_float latest-heading">
         <h2>Latest Status Updates</h2>
	       <span>
            <a class="pop-up-img" data-toggle="modal" data-target="#status_update_for_all" href="javascript:void(0);">remind all</a>
         </span>
      </div> 
      <div class="table table-bordered project-management-inner">
        <div class="heading-table">
           <div class="row-table">
             <div class="th">
                 <p>PROJECTS</p>
                 <span>
                 <img src="{{url('dist/images/up-arrow.png')}}">
                         <img src="{{url('dist/images/down-arrow.png')}}">
                 </span>
             </div>
             <div class="th">
                 <p>DEPARTMENT</p>
                 <span>
                 <img src="{{url('dist/images/up-arrow.png')}}">
                         <img src="{{url('dist/images/down-arrow.png')}}">
                 </span>
             </div>
             <div class="th">
                 <p>ACTIVE?</p>
                 <span>
                 <img src="{{url('dist/images/up-arrow.png')}}">
                         <img src="{{url('dist/images/down-arrow.png')}}">
                 </span>
             </div>
             <div class="th">
                 <p>GROUP?</p>
                 <span>
                 <img src="{{url('dist/images/up-arrow.png')}}">
                         <img src="{{url('dist/images/down-arrow.png')}}">
                 </span>
             </div>
             <div class="th">
                 <p>LATEST <br/>UPDATE</p>
                 <span>
                 <img src="{{url('dist/images/up-arrow.png')}}">
                         <img src="{{url('dist/images/down-arrow.png')}}">
                 </span>
             </div>
             <div class="th icon-heading">
                 <img src="{{url('dist/images/clock.png')}}">
                 <span>
                 <img src="{{url('dist/images/up-arrow.png')}}">
                         <img src="{{url('dist/images/down-arrow.png')}}">
                 </span>
             </div> 
             <div class="th icon-heading">
                 <img src="{{url('dist/images/star.png')}}">
                 <span>
                 <img src="{{url('dist/images/up-arrow.png')}}">
                         <img src="{{url('dist/images/down-arrow.png')}}">
                 </span>
             </div>
              <div class="coin th">
                 <img src="{{url('dist/images/coins.png')}}">
                 <span>
                 <img src="{{url('dist/images/up-arrow.png')}}">
                         <img src="{{url('dist/images/down-arrow.png')}}">
                 </span>
             </div>
             <div class="th">
                 <p>ACTION</p>                             
             </div>
           </div>
        </div>
    <div class="tbody">
       @if(!empty($all_projects))
           @foreach($all_projects as $index =>$row)
           <div class="row-table">
              <div class="td" ><a href="{{ route('aboutProject',$row->id) }}"  target="_blank" >{{ $row->project_title }}</a></div>
              <div class="td">{{ $row->fk_businessUnitId }}</div>
              <div class="td">@if($row->is_active==1) Yes @else No @endif</div>
              <div class="td">@if($row->is_group==1) Yes @else No @endif</div>
              <div class="td">{{ $row->estimated_end_date }}</div>



              <div class="time td" style="text-align:center;">
              <span class="tooltip"
                 @if($row->time_status=="1")
                     style="background: #9AC31C;"
                 @elseif($row->time_status=="2")
                     style="background: #FFD139;"
                 @elseif($row->time_status=="3")
                     style="background: #ED3535;"
                 @else
                     style="background: #fff;"
                 @endif
              ></span>
               <!-- Tooltip -->
               <div class="tooltip-main">
                <div class="tooltip-header">
                   @if($row->time_status=="1")
                      <img src="{{ asset('dist/images/clock/green-clock.png') }}">
                    @elseif($row->time_status=="2")
                      <img src="{{ asset('dist/images/clock/yellow-clock.png') }}">
                    @elseif($row->time_status=="3")
                      <img src="{{ asset('dist/images/clock/red-clock.png') }}">
                    @endif
                   <h2>TIME</h2>
                </div>
                <div class="tooltip-content">
                   <p>{{ $row->time_planning_explanation }}</p>
                </div>
               </div>
              </div>



              <div class="quality td" style="text-align:center;">
              <span class="tooltip"
                 @if($row->current_status=="1")
                     style="background: #9AC31C;"
                 @elseif($row->current_status=="2")
                     style="background: #FFD139;"
                 @elseif($row->current_status=="3")
                     style="background: #ED3535;"
                 @else
                     style="background: #fff;"
                 @endif
               ></span>
              <!-- Tooltip -->
               <div class="tooltip-main">
                <div class="tooltip-header">
                   @if($row->current_status=="1")
                      <li><img src="{{ asset('dist/images/star/green-star.png') }}"></li>
                    @elseif($row->current_status=="2")
                      <li><img src="{{ asset('dist/images/star/yellow-star.png') }}"></li>
                    @elseif($row->current_status=="3")
                      <li><img src="{{ asset('dist/images/star/red-star.png') }}"></li>
                    @endif
                   <h2>QUALITY</h2>
                </div>
                <div class="tooltip-content">
                   <p>{{ $row->current_quality_explanation }} </p>
                </div>
               </div>
              </div>



              <div class="time td" style="text-align:center;"><span
                 @if($row->cost_status=="1")
                     style="background: #9AC31C;"
                 @elseif($row->cost_status=="2")
                     style="background: #FFD139;"
                 @elseif(($row->cost_status=="3"))
                     style="background: #ED3535;"
                 @else
                     style="background: #fff;"
                 @endif
               ></span>
                  <!-- Tooltop -->
                  <div class="tooltip-main">
                      <div class="tooltip-header">
                          @if($row->cost_status=="1")
                            <li><img src="{{ asset('dist/images/coin/green-coin.png') }}"></li>
                          @elseif($row->cost_status=="2")
                            <li><img src="{{ asset('dist/images/coin/yellow-coin.png') }}"></li>
                          @elseif($row->cost_status=="3")
                            <li><img src="{{ asset('dist/images/coin/red-coin.png') }}"></li>
                          @endif
                         <h2>COST</h2>
                      </div>
                      <div class="tooltip-content">
                         <p>{{ $row->cost_situation_explanation }}</p>
                      </div>
                  </div>
               </div>

              <div class="update-btn td">
                   <a class="pop-up-img" id="remind_single" data-toggle="modal" data-pTitle="{{$row->project_title}}" data-id="{{ $row->id }}" data-target="#status_update" href="#">Send Remind</a>
                   <!-- <a class="pop-up-img remind-single" href="{{ route('sendMail') }}">Send Remind</a> -->
              </div>

           </div>
           @endforeach
       @endif
        </div>
     </div>
	</div>
@extends('backend.layouts.reminder')
@endsection