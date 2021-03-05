<?php

use Illuminate\Support\Facades\Route;
//https://tutsforweb.com/how-to-set-up-task-scheduling-cron-job-in-laravel/
//https://stackoverflow.com/questions/49921916/notify-users-if-their-account-is-going-to-expire-in-5-days-later-laravel
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

// die('ddd');
Route::get('/routes', function () {
    $routesname = (array)collect(\Route::getRoutes())->map(function ($route) {
     return $route->getName();
      });
    $routesuri = (array)collect(\Route::getRoutes())->map(function ($route) {
     return $route->uri();
      });
    echo"<pre>";print_r($routesname);
    echo"<pre>";print_r($routesuri);
    die;
});

Auth::routes();

Route::get('admin/login', function () {
    return view('auth.login');
});
Route::get('alert', 'AlertController@index')->name('packageAlert');
Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/hosting', 'HomeController@hosting')->name('hosting');
Route::get('plan/configure/{id}', 'HomeController@planConfigure')->name('plan.configure');
Route::get('/about/us', 'HomeController@about')->name('about');
Route::get('/contact/us', 'HomeController@contactUs')->name('contact.us');
Route::post('/save/contact/us', 'HomeController@saveContactDetail')->name('save.contact.detail');
Route::get('/new', 'HomeController@theme');

Route::get('/profile', 'UsersprofileController@Viewprofile')->name('Viewprofile');
Route::post('/profile', 'UsersprofileController@Viewprofile')->name('Viewprofilepost');
Route::get('/userorder', 'UsersprofileController@userOrder')->name('userOrder');

Route::get('home', 'HomeController@index')->name('home');
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('apply/code', 'CartController@applyCode')->name('apply.code');
Route::get('/add-cart/{id}', 'CartController@addcart')->name('addcart');
Route::get('/cart-delete/{id}', 'CartController@deletecart')->name('deletecart');

Route::group(['middleware' =>'auth'], function () {
    Route::get('/checkout', 'CartController@checkout')->name('checkout');
    Route::get('/payment/{payment_method}', 'CartController@checkoutPost')->name('Payment');
    Route::get('/paypalpaymentcancel', 'CartController@paymentCancel')->name('paymentCancel');
    Route::get('/paymentsuccess', 'CartController@paymentSuccess')->name('paymentSuccess');
    Route::post('/razorpaysuccess', 'CartController@razorpaySuccess')->name('razorpaysuccess');
});

Route::get('/remindertousers', 'HomeController@remindertousers')->name('remindertousers');


// Route::group(['middleware' => 'user_permission'], function () {
//     Route::resource('hostings', 'HostingsController');
// });

Route::group(['middleware' => ['user_permission'],'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'name'=>'admin.'], function() {

        Route::get('hostings/about/to/expire/', 'HostingMonitorController@listHostingsABoutToExpire')->name('about.to.expire');
        Route::get('todays/sale', 'HostingMonitorController@todaysSale')->name('todays.sale');

        Route::get('sale/overview/{id}', 'HostingMonitorController@saleOverview')->name('sale.overview');
        Route::get('hosting/overview/{id}', 'HostingMonitorController@saleOverview')->name('hosting.overview');


        //dashboard
    	Route::get('/', 'HomeController@index')->name('home');

    	//hostings routes
    	Route::resource('hostings', 'HostingsController');


    	//users routes
    	Route::resource('users', 'UsersController');
        Route::get('user/roles', 'UsersController@UserRoles')->name('UserRoles');
    	Route::get('adduser/role', 'UsersController@Addrole')->name('addrole');
        Route::post('adduser/role', 'UsersController@Addrole')->name('addrolepost');
        Route::get('edituser/role/{id}', 'UsersController@Editrole')->name('editrole');
        Route::post('edituser/role/{id}', 'UsersController@Editrole')->name('editrolepost');
        Route::DELETE('deleteuser/role/{id}', 'UsersController@destroyUserRole')->name('destroyUserRole');
        Route::get('user/permission', 'UserPermissionsController@index');

        //addon routes
        Route::resource('addons','AddonController');

    	//orders routes
    	Route::get('/orders/{type?}', 'OrdersController@index')->name('orderslist');
    	Route::get('/orderview/{oid}', 'OrdersController@orderview')->name('orderview');
    	Route::post('/orderprocess', 'OrdersController@orderprocess')->name('orderprocess');

        
        // routes manager
        Route::resource('routesmanager', 'RoutesmanagerController');
        

        Route::get('slider/list', 'SliderController@index')->name('sliders');
        Route::get('create/slider', 'SliderController@create')->name('slider.create');
        Route::post('save/slider', 'SliderController@store')->name('slider.save');

        Route::any('delete/slider/{id}', 'SliderController@destroy')->name('slider.delete');

        Route::get('edit/slider/{id}', 'SliderController@edit')->name('slider.edit');
        Route::any('update/slider/{id}', 'SliderController@update')->name('slider.update');


        Route::get('feature/list', 'FeatureController@index')->name('features');
        Route::get('create/feature', 'FeatureController@create')->name('feature.create');
        Route::post('save/feature', 'FeatureController@store')->name('feature.save');

        Route::any('delete/feature/{id}', 'FeatureController@destroy')->name('feature.delete');

        Route::get('edit/feature/{id}', 'FeatureController@edit')->name('feature.edit');
        Route::any('update/feature/{id}', 'FeatureController@update')->name('feature.update');

        //offers
        Route::get('offers/list', 'OffersController@index')->name('offers');
        Route::get('create/offers', 'OffersController@create')->name('offers.create');
        Route::post('save/offers', 'OffersController@save')->name('offers.save');

        Route::get('edit/offers/{id}', 'OffersController@edit')->name('offers.edit');
        Route::any('delete/offers/{id}', 'OffersController@destroy')->name('offers.delete');
        Route::any('delete/update/{id}', 'OffersController@update')->name('offers.update');
        Route::post('check/valid/offer/code', 'OffersController@checkValidOfferCode')->name('check.valid.offer.code');

        //contact module
        Route::get('contact/list', 'ContactController@index')->name('contact.list');
        Route::any('delete/contact/{id}', 'ContactController@destroy')->name('contact.delete');

        Route::get('contact/page/detail', 'ContactController@ContactPageDetail')->name('contact.page.detail');
        Route::post('save/contact/page/detail', 'ContactController@saveContactPageDetail')->name('save.contact.page.detail');


    });
});