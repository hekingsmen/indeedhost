@foreach($all_projects as $index =>$row)

    <div class="row-table @if($row->project_status_updated_at < $oneweekAgo) border-red-error @endif" id="row_{{$row->id}}">

        <div class="td" ><a href="{{ route('aboutProject',$row->id) }}"  target="_blank" >{{ $row->project_title }}</a></div>

        <div class="td">{{ $row->department_name }}</div>

        <div class="td">{{ $row->sponsor_name }}</div>

        <div class="td">@if($row->is_group==1) {{__('sentence.project_status.yes')}} @else {{__('sentence.project_status.no')}} @endif</div>

        <div class="td">@if($row->project_status_updated_at != null) {{ \Carbon\Carbon::parse($row->project_status_updated_at)->format('d/m/y') }} @endif </div>



        <div class="time td" style="text-align:center;">

              @if($row->time_status >= 1)

                 <span class="tooltip"
                    @if($row->time_status=="3")
                        style="background: #9AC31C;"
                    @elseif($row->time_status=="2")
                        style="background: #FFD139;"
                    @elseif($row->time_status=="1")
                        style="background: #ED3535;"
                    @endif
                 ></span>

              @endif

            <!-- Tooltip -->


                <div class="tooltip-main">
                    <div class="tooltip-header tooltip-heading-one">              
                        @if($row->time_status=="3")
                            <img src="{{ asset('dist/images/clock/green-clock.png') }}">
                        @elseif($row->time_status=="2")
                            <img src="{{ asset('dist/images/clock/yellow-clock.png') }}">
                        @elseif($row->time_status=="1")
                            <img src="{{ asset('dist/images/clock/red-clock.png') }}">
                        @endif
                        
                        <h2>{{__('sentence.project_status.time')}}</h2>

                        <div class="tooltip-cross"><img src="{{ asset('dist/images/check-2.png') }}" alt="cross-img"></div>
                    </div>

                    <div class="tooltip-content">
                        <p>
                            @if($row->time_planning_explanation ==null || $row->time_planning_explanation == '')
                                {{ __('sentence.noContent')}}
                            @else
                               {{  substr(strip_tags($row->time_planning_explanation), 0, 350)  }} 
												@if(strlen(strip_tags($row->time_planning_explanation)) > 350) 
												... <a href="{{ route('aboutProject',$row->id) }}" target="_blank">{{__('sentence.read_more')}}</a>
												@endif
                            @endif
                        </p>
                    </div>

                </div>

            <div class="tooltip-overlay"></div>

        </div>

        <div class="time td" style="text-align:center;">
            @if($row->current_status >= 1)
                 <span class="tooltip"
                    @if($row->current_status=="3")
                        style="background: #9AC31C;"
                    @elseif($row->current_status=="2")
                        style="background: #FFD139;"
                    @elseif($row->current_status=="1")
                        style="background: #ED3535;"
                    @endif
                 ></span>
            @endif

            <!-- Tooltip -->
            
                <div class="tooltip-main">
                 <div class="tooltip-header tooltip-heading-one">                        
                        @if($row->current_status=="3")

                        <li><img src="{{ asset('dist/images/star/green-star.png') }}"></li>

                    @elseif($row->current_status=="2")

                        <li><img src="{{ asset('dist/images/star/yellow-star.png') }}"></li>

                    @elseif($row->current_status=="1")

                        <li><img src="{{ asset('dist/images/star/red-star.png') }}"></li>

                    @endif
                        <h2>{{__('sentence.project_status.quality')}}</h2>                          
                    <div class="tooltip-cross"><img src="{{ asset('dist/images/check-2.png') }}" alt="cross-img"></div>
                 </div>
                 <div class="tooltip-content">
                    <p>
                        @if($row->current_quality_explanation ==null || $row->current_quality_explanation == '')
                            {{ __('sentence.noContent')}}
                        @else
                              {{  substr(strip_tags($row->current_quality_explanation), 0, 350)  }}
												@if(strlen(strip_tags($row->current_quality_explanation)) > 350) 
												... <a href="{{ route('aboutProject',$row->id) }}" target="_blank">{{__('sentence.read_more')}}</a>
												@endif
                        @endif
                    </p>
                 </div>                              
                </div>
                <div class="tooltip-overlay"></div>
            

        </div>

        <div class="time td" style="text-align:center;">

            @if($row->cost_status >= "1")

            <span class="tooltip"
                @if($row->cost_status=="3")
                    style="background: #9AC31C;"
                @elseif($row->cost_status=="2")
                    style="background: #FFD139;"
                @elseif(($row->cost_status=="1"))
                    style="background: #ED3535;"
                @endif
            ></span>

            @endif

            
                 <div class="tooltip-main">
                    <div class="tooltip-header tooltip-heading-one">
                        @if($row->cost_status=="3")
                            <li><img src="{{ asset('dist/images/coin/green-coin.png') }}"></li>
                        @elseif($row->cost_status=="2")
                            <li><img src="{{ asset('dist/images/coin/yellow-coin.png') }}"></li>
                        @elseif($row->cost_status=="1")
                            <li><img src="{{ asset('dist/images/coin/red-coin.png') }}"></li>
                        @endif
                        <h2>{{__('sentence.project_status.cost')}}</h2>
                        <div class="tooltip-cross"><img src="{{ asset('dist/images/check-2.png') }}" alt="cross-img"></div>
                    </div>

                    <div class="tooltip-content">
                        <p>
                            @if($row->cost_situation_explanation ==null || $row->cost_situation_explanation == '')
                                {{ __('sentence.noContent')}}
                            @else
                                {{  substr(strip_tags($row->cost_situation_explanation), 0, 350)  }} 
												@if(strlen(strip_tags($row->cost_situation_explanation)) > 350) 
												... <a href="{{ route('aboutProject',$row->id) }}" target="_blank">{{__('sentence.read_more')}}</a>
												@endif
                            @endif
                        </p>
                    </div>
                </div>
                <div class="tooltip-overlay"></div>
            
        </div>

        <div class="update-btn td">
            <a class="pop-up-img __statusUpdate"  data-toggle="modal" data-project-id="{{$row->id}}" data-heading="{{__('sentence.project_status.send_reminder_heading')}}" data-message="{{__('sentence.project_status.reminder_alert', ['project'=>$row->project_title])}}" data-id="{{ $row->id }}" data-target="#status_update" href="#">{{__('sentence.project_status.send_remind')}}</a>

            <!-- <a class="pop-up-img remind-single" href="{{ route('sendMail') }}">Send Remind</a> -->

        </div>

    </div>

@endforeach