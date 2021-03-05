<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// test purpose only
Route::get('/test', function () {
    return view('test');
});
Route::any('status/email', 'Backend\UpdateStatus@sendMail')->name('sendMail');

Route::post('send/reset/password/mail', 'Backend\ResetPasswordController@sendResetPasswordMail')->name('sendResetPasswordMail');
//START language Change
/*Route::get('lang/{locale}', function ($locale){
	//\Session::put('locale', $locale);

	$duration = 12*24*60*60;
	\Cookie::queue('locale', $locale, $duration);
	return redirect()->back();
});
*/
Route::get('lang/{locale}', 'ProfileController@updateLanguage')->name('updateLanguage');
//END language Change


// START langChange Access Route
// Route::get('lang/{lang}', 'LanguageController@langChange')->name('langChange');
// END langChange Access Route

// For Image Access Route
Route::get('image/{filename}', 'HomeController@getPubliclyStorgeFile')->name('image.displayImage');
Route::get('product/image/{filename}', 'HomeController@getPubliclyStorgeProductFile')->name('productImageDisplayImage');

// For Image Access Route

// START For Homepage DashBoard
// Route::get('/', 'HomeController@index')->name('homepage');


Route::get('/guest/login/{token}', 'Auth\LoginController@guestUserLogin')->name('loginGuest');
Route::group(['middleware'=>['locale']], function() {
	Route::get('/', 'HomeController@index')->name('homepage');
	Route::get('/home', 'HomeController@index')->name('homepage');
	Route::post('ajax-login', 'Auth\LoginController@loginUser')->name('ajax-login');
});
Route::group(['middleware'=>['auth', 'locale']], function() {
	Route::get('get/file/{id}', 'HomeController@getDownloadFile')->name('getDownloadFile');
	Route::get('all/project', 'HomeController@allProjectsViews')->name('allProjectsViews');
	Route::get('archived/project', 'HomeController@allProjectsViews')->name('allArchivedProjects');
	Route::get('about/project/{id}', 'HomeController@aboutProject')->name('aboutProject');
	Route::get('about/project-detail/{id}', 'HomeController@aboutProject')->name('aboutProjectDetail');
	Route::get('project/overview/{id}', 'HomeController@projectOverview')->name('projectOverview');
    
// END For Homepage DashBoard
});




Auth::routes();


Route::group(['prefix'=>'admin','middleware'=>['auth', 'locale']], function(){
	Route::post('logout', 'Auth\LoginController@logout')->name('custom-logout');
	// Start Role Routes 
	Route::get('profile', 'ProfileController@profile')->name('profile');
	Route::post('resetPassword', 'ProfileController@resetPassword')->name('resetPassword');
	// End Role Routes 
	Route::post('document/upload', 'Backend\MyProjectController@uploadDocuments')->name('documentUpload');
	Route::post('upload/picture', 'Backend\HomepageController@uploadImage')->name('uploadImage');
});

Route::group(['middleware'=>['auth', 'locale']], function(){
	//START 404 page
	Route::get('unauthorized-access', function(){ return view('backend.401.401'); })->name('401'); 
	//END 404 page
});
// project_management_panel
Route::group(['prefix'=>'admin','middleware'=>['auth','userPermissions:project_management_panel', 'locale'],'namespace'=>'Backend'], function(){

	Route::get('my/project/list', 'MyProjectController@myProjects')->name('myProjectsList');
	Route::get('project/detail/{id}', 'MyProjectController@viewProjectDeatils')->name('viewProjectDeatils');
	Route::post('update/project/detail', 'MyProjectController@updateProjectDetails')->name('updateProjectDetails');

	Route::get('project/status/{id}', 'MyProjectController@viewProjectDeatilsStatus')->name('viewProjectDeatilsStatus');
	Route::post('update/project/status', 'MyProjectController@updateProjectStatus')->name('updateProjectStatus');



	
	
	Route::get('project/add', 'ProjectController@editProject')->name('addProject');
	Route::get('project/edit/{projectId}', 'ProjectController@editProject')->name('editProject');
	Route::any('project/save', 'ProjectController@saveProjectBasicDetails')->name('saveProject');
	Route::post('delete/project/{projectId}', 'ProjectController@deleteProjectBasicDetails')->name('deleteProject');
	Route::post('archive/project', 'ProjectController@archiveProject')->name('archiveProject');
});

// reporting_panel
Route::group(['prefix'=>'admin','middleware'=>['auth','userPermissions:reporting_panel', 'locale'],'namespace'=>'Backend'], function(){

	// START MY PROJECT
	Route::get('/download/{id}', 'MyProjectController@getDownload')->name('downloadFile');
	Route::post('remove/document', 'MyProjectController@removeDocument')->name('remove.document');
	Route::post('add/to/members', 'MyProjectController@addToMembers')->name('addToMembers');
	Route::get('about/project/{id}', 'MyProjectController@aboutProjectAdmin')->name('aboutProject_Admin');

	// END MY PROJECT
	
	// START PROJECT STATUS
	Route::get('projects/status', 'ProjectController@projectsStatus')->name('projectStatus');
	Route::post('reminder/email', 'ProjectController@sendReminder')->name('reminderEmail');
	Route::any('status/email', 'UpdateStatus@sendMail')->name('sendMail');  //temporary will be deleted
	Route::any('done-but-active/email', 'ProjectController@informDoneButActive')->name('doneButActiveEmail');
	// END PROJECT STATUS

	// done but active projects
	Route::get('projects/done-but-active', 'ProjectController@doneButActive')->name('doneButActive');

	// END Active Project
});

 
Route::group(['prefix'=>'admin','middleware'=>['auth','userPermissions:admin_panel', 'locale'],'namespace'=>'Backend'], function(){

	// Start Role Routes 
	Route::get('roles', 'RolesController@index')->name('userRoles');
	Route::any('roles/save', 'RolesController@saveRoleDetail')->name('roleSave');
	Route::post('roles/delete/{id}', 'RolesController@deleteRole')->name('deleteRole');
	// End Role Routes

	// Users Role Routes 
	Route::get('users', 'UsersController@index')->name('allUsers');
	Route::any('user/save', 'UsersController@CreateUserDetail')->name('createUserDetail');
	Route::post('user/delete/{user_id}', 'UsersController@deleteUsersDetail')->name('deleteUsersDetail');
	// End Users Routes 

	// Users Role Routes  hold
	Route::get('business/units', 'BusinessUnitController@index')->name('businessUnits');
	Route::any('save/business/unit', 'BusinessUnitController@saveDetails')->name('saveBusinessUnit');
	Route::post('delete/business/unit/{id}', 'BusinessUnitController@deleteBusinessUnit')->name('deleteBusinessUnit');
	Route::post('business/unit/toggle/status', 'BusinessUnitController@toggleBusinessStatus')->name('toggleBUStatus');

	Route::get('projects/archived', 'ProjectController@archivedProjects')->name('archive_project');
	Route::get('projects', 'ProjectController@index')->name('allProjects');

	//email templates
	Route::get('email/templates', 'EmailTemplateController@index')->name('template_list');
	Route::get('email/template/detail', 'EmailTemplateController@templateDetails')->name('template_detail_add');
	Route::get('email/template/detail/{id}', 'EmailTemplateController@templateDetails')->name('template_detail');
	Route::post('email/template/save', 'EmailTemplateController@saveDetails')->name('emailTemplateSave');
	//Route::get('change/password');
	Route::get('projects/export', 'ProjectController@exportProjects')->name('exportProjects');
});