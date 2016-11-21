<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', 'HomeController@showLanding');


// Authentication routes...
Route::get('auth/login', 'HomeController@getLogin');
Route::post('auth/login', 'Auth\AuthController@authenticate');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('redirect/{provider}', 'SocialAuthController@redirect');
Route::get('callback/{provider}', 'SocialAuthController@callback');

// Registration routes...
Route::get('auth/register', 'HomeController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
   'password' => 'Auth\PasswordController',
]);


Route::group(['middleware' => 'auth'], function()
{   
	

	Route::get('app', 'HomeController@showDashboard');
	Route::get('paypal/set/{amount}', 'PaymentsController@PaypalExpressCheckout');
	Route::get('paypal/success', 'PaymentsController@PaypaldoExpressCheckoutPayment');

	Route::get('paymaya/set/{amount}', 'PaymentsController@PaymayaCheckout');
	Route::get('paymaya/success', 'PaymentsController@PaymayaSuccessCheckout');

	Route::get('paymayatransfer/set', 'PaymentsController@PaymayaTransfer');

	Route::get('api/plans', 'PlansController@index');
        Route::get('api/plan_desc', 'PlansController@getDescription');
        Route::get('api/subscribe', 'PlansController@subscribe');
        Route::get('api/myplans', 'PlansController@myPlans');
        Route::get('api/get_speed_dials', 'CallController@getSpeedDials');
        Route::get('api/add_speed_dial', 'CallController@addSpeedDial');
        Route::get('api/getwallet', 'WalletController@getwallet');
        Route::get('api/getLastDialedNumbers', 'CallController@getLastDialedNumbers');
        Route::get('api/dialCall', 'CallController@dialCall');
        Route::get('api/startCall', 'CallController@startCall');
        Route::get('api/endCall', 'CallController@endCall');
}); 