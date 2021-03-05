<!doctype html> 
<html lang="en">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		@php $title = dynamicFrontendTitle(); @endphp
		<title>
			@if(!empty($title) && $title!=null )
				{{$title}}
			@elseif( getCurrentRouteName() =="projectOverview")
				@if(!empty($titleName)) Lyreco - {{$titleName}} @endif
			@else
				@if(!empty($locate))
					Lyreco - {{ ucwords($locate) }}
            	@endif
			@endif
		</title>

	<link rel="stylesheet" href="{{url('dist/css/jquery.selectBoxIt.css')}}" />
    <link rel="stylesheet" href="{{url('dist/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{url('dist/css/style.css')}}" />
<!--[if gte IE 9]>	
	<link rel="stylesheet" href="{{url('dist/css/ie9.css')}}" />
<![endif]-->	
	<link rel="stylesheet" href="{{url('dist/css/responsive.css')}}" />
	<link href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1557232134/toasty.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
	
	<meta name="robots" content="noindex, nofollow">
</head>
<body>
<!--logo-section-->
<div class="top_header define_float   @if(getCurrentRouteName() == 'aboutProject' || getCurrentRouteName() == 'aboutProjectDetail') about-header @endif ">
	<div class="container">
		<div class="row" >
			
			<div class="top_header_main define_float
				
				@if( getCurrentRouteName() == 'homepage' )
					{{__('homepageMobileToggle')}}
				@elseif( getCurrentRouteName() == 'allProjectsViews' )
					{{__('allProjectsMobileToggle')}}
				@elseif( getCurrentRouteName() == 'aboutProject' )
					{{__('aboutProjectMobileToggle')}}
				@elseif( getCurrentRouteName() == 'projectOverview' )
					{{__('projectOverviewMobileToggle')}}
				@endif
			">

				<div class="top_header_left col-md-6 col-sm-6 col-xs-6">
					<div class="logo_section define_float">
						
						<div class="mobile-logo-inner">
							<a href="{{ route('homepage') }}"><img src="{{ asset('dist/images/logo.svg') }}" alt="logo"></a>						
							<h2>{{ __('sentence.project_dashboard')}}</h2>
						</div>

						<div class="home-box-top back-mobile-btn frontend-back-header">
							@if( getCurrentRouteName() != 'homepage')
								<a class="back-btn" href="{{ route('homepage') }}"><img src="{{ asset('dist/images/arrow-left.png') }}"><img class="arrow-img2" src="{{ asset('dist/images/arrow-left2.png') }}"></a>							
							@endif
								<!--Heading Mobile-->
								<div class="heading-admin-mobile">
									<h2>
										@if( getCurrentRouteName() == 'homepage' )
												{{ __('sentence.project_dashboard')}}
										@elseif( getCurrentRouteName() == 'allProjectsViews')
												{{ __('sentence.all_project')}}
										@elseif( getCurrentRouteName() == 'aboutProject' )
												@if(!empty($locate))
													{{ ucwords($locate) }}
									            @endif
									    @elseif( getCurrentRouteName() == 'projectOverview' )
									    		@if(!empty($locate))
													{{ ucwords($locate) }}
									            @endif
										@endif
									</h2>
								</div>
						</div>
					</div>
				</div>
				<div class="top_header_right col-md-6 col-sm-6 col-xs-6">
					<div class="top_header_right_inner">

					<ul>	
						@if(Auth::user())
							@php $profileLink = ''; @endphp
							@if(Auth::user()->role != 2)
								@php $profileLink = route('profile'); @endphp
							@endif
							<li><a href="{{  $profileLink }}"> {{ __('sentence.hello')}}, {{Auth::user()->name}}
								@if(!empty(Auth::user()->avatar))
									<img src="{{ route('image.displayImage',Auth::user()->avatar) }}" alt="client">
									@else
									<img src="{{ asset('dist/images/user-profile.png') }}" alt="client">
								@endif
							</a></li>
							
							
							@if(Auth::user()->role != 2)
								<li><a href="{{ route('businessUnits') }}">{{ __('sentence.admin')}}</a></li>
							@elseif(Auth::user()->userRole->admin_panel == 1 || Auth::user()->userRole->project_management_panel == 1 || Auth::user()->userRole->reporting_panel == 1 || Auth::user()->userRole->front_end_view_panel == 1)
								<li><a href="{{ route('businessUnits') }}">{{ __('sentence.admin')}}</a></li>
						    @endif
							<li><a href="{{ route('custom-logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >{{ __('sentence.sign_out')}}</a></li>

						@else

							<li><a data-toggle="modal" data-target="#exampleModal" href="javascript:void(0)">{{ __('sentence.log_in')}}</a></li>

						@endif

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
											<li class="pop-up-img" data-toggle="modal" data-target="#exampleModal"><span><a href="javascript:void(0)">{{ __('sentence.log_in')}}</a></span></li>
										@else


										<li class="admin-profile-toggle" ><a href="{{ $profileLink }}">{{ __('sentence.hello')}}, {{ ucfirst(Auth::user()->name) }}
										@if(!empty(Auth::user()->avatar))
											<img src="{{ route('image.displayImage',Auth::user()->avatar) }}" alt="client">
										@else
											<img src="{{ asset('dist/images/user-profile.png') }}" alt="client">
										@endif
										</li>

										<li class="pop-up-img" ><span><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" >{{ __('sentence.sign_out')}}</a></span></li>
										@endif
										<li>

											<ul>
												@foreach($languages as $key => $lang)
													<li onclick="switchLanguage('{{$key}}')" class="@if(app()->getLocale() == $key) selected @endif"><a href="javascript:void(0)">{{ $lang }}</a></li>
												@endforeach
											</ul>
											
										</li>
									</ul>


										<!--Dashboard-->
								@if(Auth::user())
									@if(Auth::user()->role != 2 || Auth::user()->userRole->admin_panel == 1 || Auth::user()->userRole->project_management_panel == 1 || Auth::user()->userRole->reporting_panel == 1 || Auth::user()->userRole->front_end_view_panel == 1)
									 <div class="lyerco_left_table dashboard-mobile">

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
												<h6>{{ __('sentence.project_panel') }}</h6>
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
									@endif
								@endif


								</div>
							</div>
							

							</div>
						</div>
					</div>
				</div>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
			</div>

		</div>
	</div>
</div>
<!--End-->
<!--Nav-SEction-->
<div class="header_nav define_float @if( in_array(getCurrentRouteName(), ['allArchivedProjects', 'allProjectsViews', 'projectOverview'])) sorting-header @endif">
	<div class="container">
		<div class="header_nav_main define_float @if( in_array(getCurrentRouteName(), ['allArchivedProjects', 'allProjectsViews', 'projectOverview'])) header-nav-sort @endif">
			<div class="header_nav_main_left">
				<a href="{{ route('homepage') }}">{{ __('sentence.home')}}</a>

				@if(!empty($projectDetail->fk_businessUnitId))
					@php $link = breadcrumbFrontend($projectDetail->fk_businessUnitId); @endphp
					<span>/</span> <a href="{{ route('projectOverview',$projectDetail->fk_businessUnitId) }}">{{ ucwords($link)}}</a>
				@endif
				@if(!empty($locate))
					<span>/</span> <a class="current-item">{{ ucwords($locate) }}</a>
				@endif
			</div>
			@if( in_array(getCurrentRouteName(), ['allArchivedProjects', 'allProjectsViews', 'projectOverview']))
				<div class="header_nav_main_right">
					<span>Sort By:</span>
					<select class="sorting" id="sort_by" onchange="sort()">
						<option value="project_name" selected>{{ __('sentence.filter_project_name')}}</option>
						<option value="go_live">{{ __('sentence.filter_go_live')}}</option>
						<option value="project_manager">{{ __('sentence.filter_project_manager')}}</option>
						<option value="percentage">{{ __('sentence.filter_percentage')}}</option>
						<option value="last_update">{{ __('sentence.filter_last_update')}}</option>
					</select>
				</div>
			@endif
		</div>
	</div>
</div>
<!--End-->

<!--Main Section-->
<div class="homepage @if(getCurrentRouteName() == 'aboutProject') {{__('aboutAdminSectionHeader')}} @endif ">
   @yield('content')
</div>

<!--Popup-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div id="forLogInForm" >
		{{Form::open(array('url'=>route('ajax-login'), 'id'=>'ajaxLoginForm', 'enctype'=>'multipart/form-data'))}}
			<div class="modal-dialog modal-homepage" role="document">
			<div class="modal-content">
			  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" >{{ __('sentence.log_in')}}</h5>
			  </div>
			  <div class="modal-body">
				<ul>
					<li><span>{{ __('sentence.email_address')}}</span>
						{{Form::text('email', \Cookie::get('email'),array('class'=>'login-field','id'=>'inputEmail'))}}
						@csrf
					</li>
					<li><span>{{ __('sentence.password')}}</span>
					    <input type="password" name="password" class="login-field" id="inputPass" value="{{\Cookie::get('password')}}">
					</li>
					<li>
				
						{{Form::checkbox('remember',null,null,array('id'=>'remember'))}}
						<span>{{ __('sentence.remember_me')}}</span>
					</li>
				
				</ul>
			  </div>
			  <div class="modal-footer">
				<div class="lost-footer-section">
					<div class="lost-password-main">			
						<div class="lost-password"><a id="forgetPassword" href="javascript:void(0)" >{{ __('sentence.lost_your_password')}}</a></div>								
					</div>
					<button type="submit" id="login_button_submit" class="btn btn-primary pop-btn disabled" disabled>{{ __('sentence.log_in')}}</button>
				</div>
			  </div>
			</div>
		  </div>
		 
	  	{{Form::close()}}
	</div>

	<div id="forForgetPassword" style="display: none;" >
		<!-- {{Form::open(array('url'=>route('password.email'), 'class'=>'ajax-submit', 'id'=>'fogetPasswordForm','enctype'=>'multipart/form-data'))}} -->
		{{Form::open(array('url'=>route('sendResetPasswordMail'), 'class'=>'ajax-submit', 'id'=>'fogetPasswordForm','enctype'=>'multipart/form-data'))}}
			<div class="modal-dialog modal-homepage lost-password-main" role="document">
			<div class="modal-content">
			  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" >{{ __('sentence.lost_your_password')}}</h5>
			  </div>
			  <div class="modal-body lost-password-modal">
			  <p>
			  	{{ __('sentence.lost_your_password_query')}}
			  </p>
				<ul>
					<li><span>{{ __('sentence.email_address')}}</span>
						{{Form::text('email', null,array('class'=>'login-field','id'=>'emailAddressForPasswordReset'))}}
					</li>
					
				</ul>
			  </div>
			  <div class="modal-footer">
				<!-- <a href="{{ route('password.request') }}" >Lost your password?</a> -->
				<div class="lost-footer-section">
				 <div class="lost-password"><a id="logInForm" href="javascript:void(0)" >{{ __('sentence.log_in_text')}}</a></div>
				 <button type="submit" id="loginButtonForgetPassword" class="btn btn-primary pop-btn disableme" disabled="true">{{ __('sentence.reset_password')}}</button>
				</div>
			  </div>
			</div>
		  </div>
	  	{{Form::close()}}
	</div>
</div>


<!--Footer Start-->
<div class="footer">
    <div class="container">
        <div class="row">
            <span>{{ __('sentence.footer_text')}}</span>
        </div>
    </div>
</div>
<!--Footer End-->
<div class="loading" style="display:none;">
<img src="{{url('dist/images/loading.gif')}}">
</div>

<!--End-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="{{url('dist/js/bootstrap.js')}}"></script>
<script src="{{url('dist/js/jquery.selectBoxIt.min.js')}}"></script>
 <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1557232134/toasty.js"></script>
<script src="{{url('js/custom/script.js?a=1')}}"></script> @if(Session::has('success'))
 <script>
	var options = {
		autoClose: true,
	};
	toast.success("{{ Session::get('success') }}");
 </script>
@endif
<script>

jQuery(document).ready(function() {	 
	jQuery('.select-lang select').selectBoxIt({ 'numSearchCharacters': 1 });
	jQuery('select.sorting').selectBoxIt({ 'numSearchCharacters': 1 });
});


$("#forgetPassword").click(function () {
	$("#forForgetPassword").show();
	$("#forLogInForm").hide();
});
$("#logInForm").click(function () {
	$("#forForgetPassword").hide();
	$("#forLogInForm").show();
});

function switchLanguage(lang=null){
	if(lang == null) {
		var lang = $('#languageSwitcher').val(); 
	}
	
	window.location.href = window.location.origin+'/lang/'+lang;
}

$('#emailAddressForPasswordReset').keyup(function () {
    if ($(this).val() == '') {
        $('.disableme').prop('disabled', true);
    } else {
        $('.disableme').prop('disabled', false);
    }
});
</script>
<script>
jQuery(document).ready(function(){
		if (navigator.userAgent.indexOf("MSIE 9") > -1) {
			document.body.classList.add("ie9");
		}
		else{
			
		}
	});
</script>
<script>
 var b = document.documentElement;
	b.setAttribute('data-useragent',  navigator.userAgent);
   b.setAttribute('data-platform', navigator.platform );
</script>
<script>
/*jQuery('.home-box-top ul li').mouseover(function(){
    jQuery('.home-box').addClass('active_box');
});
jQuery('.home-box-top ul li').mouseleave(function(){
    jQuery('.home-box').removeClass('active_box');
});*/
</script>
<style>
.tooltip-mobile.tooltip_open {     display: block; }
</style>
<script>
//mobile
	$(".tooltip-cross").click(function(){	  
    //$("body").addClass("tooltip-body");
	$('.tooltip-mobile').removeClass('tooltip_open');
  });
  $(".tooltip-list-inner img").click(function() { console.log($(this).next());
		$("body").addClass("tooltip-body_main");
		$(this).next().next('.tooltip-mobile').addClass('tooltip_open');
	});
	
$(document).ready(function(){
	//web
   $('body').on('mouseleave','.home-box', function() { 
    
	 $('.tooltip-main').hide();
	 $(this).children('.tooltip').next('.tooltip-main').hide();
	});

  $('body').on('mouseover', '.tooltip-list-inner', function () {
    hover = true;
	 $('.tooltip-main').hide(); 
	 
	$(this).find('.tooltip-mobile .tooltip-main').show();
});


if($('#inputEmail').val() != "" && $("#inputPass").val() != ""){
		$("#login_button_submit").prop('disabled', false);
        $("#login_button_submit").removeClass('disabled');
		
    } 
});
</script>
@yield('scripts')
</body>
</html>