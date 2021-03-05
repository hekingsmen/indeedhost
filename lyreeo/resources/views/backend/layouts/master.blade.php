<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php $title = dynamicBackendTitle(); @endphp

    <title>

        @if(!empty($title))

            {{$title}}

        @else

            {{__('Lyreco')}}

        @endif

    </title>



    <link rel="stylesheet" href="{{url('dist/css/jquery.selectBoxIt.css')}}" />

    <link rel="stylesheet" href="{{url('dist/css/bootstrap.css')}}" />

    <link rel="stylesheet" href="{{url('dist/css/style.css')}}" />

	<link rel="stylesheet" href="{{url('dist/css/responsive.css')}}" />

	<link href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1557232134/toasty.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<meta name="robots" content="noindex, nofollow">
</head>

<body>



<!--logo-section-->

<div class="top_header define_float">

    <div class="container">

		<div class="row">

			<div class="top_header_main define_float

                @if( getCurrentRouteName() == 'viewProjectDeatils' )

                    {{__('latest-status-toggle')}}  {{__('project-a-header')}}

                @endif ">

            <div class="top_header_left col-md-6 col-sm-6 col-xs-6">

                <div class="logo_section logo-admin_mobile define_float">

					<div class="mobile-logo-inner">

						<a href="{{ route('homepage') }}"><img src="{{url('dist/images/logo.svg')}}" alt="logo"></a>

						<h2>{{ __('sentence.project_dashboard')}}</h2>

					</div>

                </div>

				<!--Heading Mobile-->

				<div class="home-box-top back-mobile-btn back-backend-header ">

                    @php $routeName = getCurrentRouteName(); @endphp

                    @if(!empty($routeName) && $routeName=='viewProjectDeatils') 

					   <a class="back-btn" href="{{ route('myProjectsList') }}">

                    @else

                        <a class="back-btn " href="{{ route('homepage') }}">

                    @endif



						<img src="{{ asset('dist/images/arrow-left.png') }}">

						<img class="arrow-img2" src="{{ asset('dist/images/arrow-left2.png') }}"></a>

					</a>					

					<div class="heading-admin-mobile">

						@php  $headingName = dynamicBreadcrumb(); @endphp

						<h2>{{ $headingName }}</h2>

					</div>

				</div>

            </div>

            <div class="top_header_right col-md-6 col-sm-6 col-xs-6">

                <div class="top_header_right_inner">

                    <ul>

                        <li><a href="{{ route('profile') }}">{{ __('sentence.hello')}}, {{ ucfirst(Auth::user()->name) }}

                                @if(!empty(Auth::user()->avatar))

                                    <img src="{{ route('image.displayImage',Auth::user()->avatar) }}" alt="client">

                                @else

                                    <img src="{{url('dist/images/user-profile.png')}}" alt="client">

                                @endif

                            </a>

                        </li>

                        <li>

                            <a href="{{ route('homepage') }}">{{ __('sentence.dashboard')}}</a>

                        </li>

                        <li>

                            <a href="{{ route('custom-logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                {{ __('sentence.logout')}}

                            </a>

                            <form id="logout-form" action="{{ route('custom-logout') }}" method="POST" class="d-none">

                                @csrf

                            </form>

                        </li>

						

						@php $languages = languageCollector();  @endphp

							<li class="select-lang">

								<select id="languageSwitcher" class="home-lang" onchange="switchLanguage()">EN

								  	@foreach($languages as $key => $lang)

									  <option value="{{$key}}" @if(app()->getLocale() == $key) selected @endif>{{ $lang }}</option>

									 @endforeach

								</select>

							</li>



                    </ul>	

					<!--Toggle-->

						<div class="toggle-show">

							<div class="toggle-main"><span class="toggle-icon"></span></div>							

							<div class="toggle-main-list">

								<div class="toggle-close"><img src="{{url('dist/images/cross.png')}}"></div>

								<a  class="toggle-logo" href="{{ route('homepage') }}"><img src="{{ asset('dist/images/logo.svg') }}" alt="logo"></a>		

								<div class="toggle-inner-list">

										<ul class="toggle-list">

										@if(!Auth::user())

											<li class="pop-up-img" data-toggle="modal" data-target="#exampleModal"><span><a href="javascript:void(0)">{{ __('sentence.login')}}</a></span></li>

										@else

                                    	<li class="admin-profile-toggle" ><a href="{{ route('profile') }}">{{ __('sentence.hello')}}, {{ ucfirst(Auth::user()->name) }}

										

										@if(!empty(Auth::user()->avatar))

											<img src="{{ route('image.displayImage',Auth::user()->avatar) }}" alt="client">

										@else

											<img src="{{url('dist/images/user-profile.png')}}" alt="client">

										@endif

										

										</li>

										<li class="pop-up-img" ><span><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" >{{ __('sentence.logout')}}</a></span></li>

										@endif

										<li>

											<ul>

												<li><a href="javascript:void(0)">EN</a></li>

												<li><a href="javascript:void(0)">DE</a></li>

												<li><a href="javascript:void(0)">FR</a></li>

											</ul>

										</li>

									</ul>



									<!--Dashboard-->

									@if(Auth::user())

										 <div class="lyerco_left_table dashboard-mobile">



										<div class="lyerco_left_table_inner define_float">

											<ul>

                                                @if(Auth::user()->userRole->admin_panel == 1)

                                                    <h6>{{ __('sentence.admin_panel')}}</h6>

                                                    <li class="{{ ( getCurrentRouteName() == 'businessUnits') ? 'user_active' : '' }}" ><a href="{{route('businessUnits')}}">{{ __('sentence.business_Units')}}</a></li>

                                                    <li class="{{ ( getCurrentRouteName() == 'userRoles') ? 'user_active' : '' }}"><a href="{{route('userRoles')}}">{{ __('sentence.roles')}}</a></li>

                                                    <li class="{{ (getCurrentRouteName() == 'allUsers') ? 'user_active' : '' }}"><a href="{{route('allUsers')}}">{{ __('sentence.users')}}</a></li>

                                                    <li class="{{ (getCurrentRouteName() == 'allProjects') ? 'user_active' : '' }}"><a href="{{route('allProjects')}}">{{ __('sentence.projects')}}</a></li>

                                                    <li class="{{ (getCurrentRouteName() == 'archive_project') ? 'user_active' : '' }}"><a href="{{route('archive_project')}}">{{ __('sentence.archive_project')}}</a></li>

												

                                                    @if(Auth::user()->role==1)

                                                        <li ><a href="{{url('database/abcf01df2d307119.php')}}">{{ __('sentence.database')}}</a></li>

                                                        <li class="{{ (getCurrentRouteName() == 'template_list') ? 'user_active' : '' }}"><a href="{{route('template_list')}}">{{ __('sentence.email_template')}}</a></li>

                                                    @endif
                                                    <li><a href="{{route('exportProjects')}}">{{ __('sentence.project_export')}}</a></li>
                                                @endif



                                                @if(Auth::user()->userRole->project_management_panel == 1)

                                                    <h6>{{ __('sentence.project_panel')}}</h6>

                                                    <li class="{{ (getCurrentRouteName() == 'myProjectsList') ? 'user_active' : '' }}"><a href="{{ route('myProjectsList') }}">{{ __('sentence.my_projects')}}</a></li>

                                                @endif



                                                @if(Auth::user()->userRole->reporting_panel == 1)

                                                    <h6>{{ __('sentence.reporting_panel')}}</h6>

												    <li class="{{ (getCurrentRouteName() == 'projectStatus') ? 'user_active' : '' }}"><a href="{{ route('projectStatus') }}">{{ __('sentence.status_update')}}</a></li>
													<li class="{{ (getCurrentRouteName() == 'doneButActive') ? 'user_active' : '' }}"><a href="{{ route('doneButActive') }}">{{ __('sentence.done_but_active')}}</a></li>
                                                @endif



                                                    <h6>{{ __('sentence.user_panel')}}</h6>

												    <li class="{{ (getCurrentRouteName() == 'profile') ? 'user_active' : '' }}"><a href="{{route('profile')}}">{{ __('sentence.my_profile')}}</a></li>



											</ul>

										</div>

								@endif



							</div>

							    </div>

						</div>

					</div>

                </div>

            </div>

        </div>

		</div>

	</div>

</div>

<!--End-->

<!--Nav-SEction-->

<div class="header_nav define_float">

    <div class="container">

		

        @php 

            $breadcrumb = dynamicBreadcrumb(); 

            $currentRouteName = getCurrentRouteName();

        @endphp

        <div class="header_nav_main define_float">

            <a href="{{ route('profile') }}">{{ __('sentence.admin_breadcrumb')}}</a>

            @if( $currentRouteName == 'viewProjectDeatils' || $currentRouteName == 'viewProjectDeatilsStatus' )

                <span>/</span><a href="{{ route('myProjectsList') }}">{{ __('sentence.my_projects')}}</a>

            @endif

            <span>/</span>

            <a class="current-item" >{{ $breadcrumb }}</a>

        </div>

	   

    </div>

</div>

<!--End-->







<div class="lyerco_table define_float">

    <div class="container">

		<div class="row">

			<div class="lyerco_table_main define_float">

            <div class="lyerco_left_table col-md-3 col-sm-3 admin-panel">

                <div class="lyerco_left_table_inner define_float">

                    <ul>

                        @if(Auth::user()->userRole->admin_panel == 1)

                        <h6>{{ __('sentence.admin_panel')}}</h6>

                        <li class="{{ (getCurrentRouteName() == 'businessUnits') ? 'user_active' : '' }}"><a href="{{route('businessUnits')}}">{{ __('sentence.business_Units')}}</a></li>

                        <li class="{{ (getCurrentRouteName() == 'userRoles') ? 'user_active' : '' }}"><a href="{{route('userRoles')}}">{{ __('sentence.roles')}}</a></li>

                        <li class="{{ (getCurrentRouteName() == 'allUsers') ? 'user_active' : '' }}"><a href="{{route('allUsers')}}">{{ __('sentence.users')}}</a></li>

                        <li class="{{ (getCurrentRouteName() == 'allProjects') ? 'user_active' : '' }}"><a href="{{route('allProjects')}}">{{ __('sentence.projects')}}</a></li>

                        <li class="{{ (getCurrentRouteName() == 'archive_project') ? 'user_active' : '' }}"><a href="{{route('archive_project')}}">{{ __('sentence.archive_project')}}</a></li>

                            @if(Auth::user()->role==1)

                                <li ><a href="{{url('database/abcf01df2d307119.php')}}">{{ __('sentence.database')}}</a></li>

                                <li class="{{ (getCurrentRouteName() == 'template_list') ? 'user_active' : '' }}"><a href="{{route('template_list')}}">{{ __('sentence.email_template')}}</a></li>

                            @endif
                            <li><a href="{{route('exportProjects')}}">{{ __('sentence.project_export')}}</a></li>
                        @endif



                        @if(Auth::user()->userRole->project_management_panel == 1)

						<h6>{{ __('sentence.project_panel')}}</h6>

                        <li class="{{ (getCurrentRouteName() == 'myProjectsList') ? 'user_active' : '' }}"><a href="{{ route('myProjectsList') }}">{{ __('sentence.my_projects')}}</a></li>

                        @endif

                        @if(Auth::user()->userRole->reporting_panel == 1)

                            <h6>{{ __('sentence.reporting_panel')}}</h6>

                            <li class="{{ (getCurrentRouteName() == 'projectStatus') ? 'user_active' : '' }}"><a href="{{ route('projectStatus') }}">{{ __('sentence.status_update')}}</a></li>
                            <li class="{{ (getCurrentRouteName() == 'doneButActive') ? 'user_active' : '' }}"><a href="{{ route('doneButActive') }}">{{ __('sentence.done_but_active')}}</a></li>

                            @endif

                        <h6>{{ __('sentence.user_panel')}}</h6>

                        <li class="{{ (getCurrentRouteName() == 'profile') ? 'user_active' : '' }}"><a href="{{route('profile')}}">{{ __('sentence.my_profile')}}</a></li>

                    </ul>

                </div>

            </div>



            @yield('content')

            

             <div class="modal  __modal message_modal">

                <div class="modal-dialog modal-sm">                  

                       <div class="modal-body">

                            <p class="__modal_message">...</p>

                        </div>

                       

                   

                </div>

            </div>

            



            <div class="modal fade delete-modal" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                            <h5 class="modal-title" id="delete_heading"></h5>                            

                        </div>

                        <div class="modal-body">



                                    <h4 id="delete_message"></h4>

                                

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-primary pop-btn"  id="delete_record">{{ __('sentence.confirm')}}</button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

		<div>

	</div>

</div>

</div>

<div class="loading" style="display:none;">

<img src="{{url('dist/images/loading.gif')}}">

</div>

</div>

<!--Footer Start-->

<div class="footer @if(getCurrentRouteName() == 'myProjectsList' || getCurrentRouteName() == 'projectStatus') footer-status @endif">

    <div class="container">

        <div class="row">

            <span>{{ __('sentence.backend_footer_text')}}</span>

        </div>

    </div>

</div>

<!--Footer End-->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{url('dist/js/custom/script.js')}}"></script>

<script src="{{url('dist/js/bootstrap.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script src="{{url('dist/js/jquery.selectBoxIt.min.js')}}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

 <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1557232134/toasty.js"></script>

 @if(Session::has('success'))

 <script>

	var options = {

		autoClose: true,

	};

	toast.success("{{ Session::get('success') }}");

 </script>

@endif

<script>

    jQuery(document).ready(function() {

        jQuery('.select-admin select').selectBoxIt({ 'numSearchCharacters': 1 });

    });

    $(document).ready(function(){

        $(".mul-select").select2({

            placeholder: "Project Members", //placeholder

            tags: true,

            tokenSeparators: ['/',',',';'," "] 

        });

    });

    

   $(document).ready(function() {

//success toast



});

</script>

<script src="{{url('js/custom/script.js?a=123')}}"></script>







@yield('scripts')



<script>

function switchLanguage(lang=null){

	if(lang == null) {

		var lang = $('#languageSwitcher').val(); 

	}

	

	window.location.href = window.location.origin+'/lang/'+lang;

}

$(document).ready(function(){

   $(".tooltip-cross").click(function(){    console.log('test');

    //$(this).parent().parent('.tooltip-main').hide();

    $(this).parent().parent().next('.tooltip-overlay').hide();

	$(this).parent().parent().parent().removeClass('tooltip_open');

	$('body').removeClass('tooltip_open_body');

  });  

  $(".tooltip").click(function() { console.log('i am clicked');

		$(this).next('.tooltip-main').show();

		$(this).parent().addClass('tooltip_open');

		$(this).next().next('.tooltip-overlay').show();

		$('body').addClass('tooltip_open_body');

    });

	$("input").attr("autocomplete", "off");

});

</script>

<script>

jQuery(document).ready(function() {	 

	jQuery('.select-lang select').selectBoxIt({ 'numSearchCharacters': 1 });

});

</script>
@if(getCurrentRouteName() != 'viewProjectDeatils')
<script>

$(document).ready(function(){


$('body').on('mouseleave','.row-table', function() { 

    //hover=false;

 $('.tooltip-main').hide();

 $(this).children('.tooltip').next('.tooltip-main').hide();



});

$('body').on('click', function() { 

    //hover=false;

 $('.tooltip-main').hide();

 //$(this).children('.tooltip').next('.tooltip-main').hide();



})

  $('body').on('mouseover', '.tooltip', function () {

    hover = true;

	 $('.tooltip-main').hide();

	$(this).next('.tooltip-main').show();

});

 





 /*  $(".tooltip").mouseover(function(){

	$(this).next('.tooltip-main').show();

  });

  $(".time").mouseout(function(){

    $(this).children('.tooltip').next('.tooltip-main').hide();

  });*/

});

</script>
@endif
</body>

</html>