<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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



Route::view('/','landing', ['title'=>'Welcome to Investment'])->name('home');
Route::view('/#/login', 'landing', ['title'=>'Welcome to Investment'])->name('login');
Route::view('/admin','admin-auth', ['title'=>'Welcome Admin'])->name('admin_home');



/* Info Routes */
Route::group(['prefix' => 'i'] , function(){
    Route::get('/investment-plans', 'App\Http\Controllers\InfoManager@plan');
    Route::get('/get-coin-data', 'App\Http\Controllers\InfoManager@getCoinData');
    Route::webhooks('/webhook/coinbase');
});


/* Authentication Routes */
Route::group(['prefix' => 'auth'] , function(){
    Route::get('/logout', 'App\Http\Controllers\AuthManager@logout');
    Route::post('/login', 'App\Http\Controllers\AuthManager@login');
    Route::post('/register', 'App\Http\Controllers\AuthManager@register');
    Route::get('/retrieve-token/{email}', 'App\Http\Controllers\AuthManager@send_token');
    Route::post('/reset-password/{email}', 'App\Http\Controllers\AuthManager@reset_password');
    Route::post('/check-token', 'App\Http\Controllers\AuthManager@check_access_token');
    Route::get('/verify/{email}/{vtoken}', 'App\Http\Controllers\AuthManager@email_verify');

    Route::group(['middleware' => 'adminify', 'prefix' => '/admin'], function () {
        Route::post('/login', 'App\Http\Controllers\AuthManager@login');
        Route::post('/register', 'App\Http\Controllers\AuthManager@register');
        Route::post('/reset-password', 'App\Http\Controllers\AuthManager@reset_password');
    });
});

/* AdminRoutes */
Route::group(['middleware'=> [ 'auth', 'is_admin'], 'prefix' => 'admin'], function(){
    // VIEW 
    Route::view('/dashboard', 'admin-dashboard', [
        'title' => auth()->user() ? auth()->user()->username : 'No User' ])
        ->name('admin-dashboard');

    // USER CRUD
    Route::get('/users', 'App\Http\Controllers\AdminManager@users');
    Route::get('/user/{id}', 'App\Http\Controllers\AdminManager@getUser');
    Route::get('/user/delete/{id}', 'App\Http\Controllers\AdminManager@deleteUser');
    Route::post('/user/{id}', 'App\Http\Controllers\AdminManager@updateUser');
    Route::post('/user/create/', 'App\Http\Controllers\AuthManager@register');
    Route::post('/user/profile/{userid}', 'App\Http\Controllers\AdminManager@updateUserProfile');

    // WALLET REQUEST CRUD
    Route::get('/requests/withdrawals', 'App\Http\Controllers\AdminManager@withdrawalRequests');
    Route::get('/requests/{type}', 'App\Http\Controllers\AdminManager@otherRequests');
    Route::get('/requests/{id}', 'App\Http\Controllers\AdminManager@getRequest');
    Route::get('/requests/{id}/delete', 'App\Http\Controllers\AdminManager@deleteRequest');
    Route::post('/requests/{id}', 'App\Http\Controllers\AdminManager@updateRequest');

    // ACCOUNT GET
    Route::get('/account/{id}', 'App\Http\Controllers\AdminManager@getAccount');

    // PLAN CRUD
    Route::get('/plans', 'App\Http\Controllers\InfoManager@plan');
    Route::get('/plan/delete', 'App\Http\Controllers\AdminManager@deletePlan');
    Route::post('/plan/{id}', 'App\Http\Controllers\AdminManager@updatePlan');
    Route::post('/plan/create', 'App\Http\Controllers\AdminManager@addPlan');

    // ADMIN SETTING CRUD
    Route::get('/settings', 'App\Http\Controllers\AdminManager@getSettings');
    Route::post('/settings', 'App\Http\Controllers\AdminManager@set');
});





/* Dashboard Routes */
Route::group([/*'middleware' => 'auth',*/ 'prefix' => 'dashboard'], function(){
    Route::view('/', 'dashboard', [ 'title' => auth()->user() ? 
        auth()->user()->profile->firstname : 'No User' ]);

    // PROFILE CRUD
    Route::get('/profile', 'App\Http\Controllers\ProfileManager@profile');
    Route::post('/profile', 'App\Http\Controllers\ProfileManager@update');
    Route::get('/profile/settings', 'App\Http\Controllers\ProfileManager@settings');
    Route::post('/profile/settings', 'App\Http\Controllers\ProfileManager@updateSettings');

    // ACCOUNT OVERVIEW
    Route::get('/account/overview', 'App\Http\Controllers\AccountManager@account');
    Route::get('/account/transactions', 'App\Http\Controllers\AccountManager@transactions');
    Route::get('/account/referals', 'App\Http\Controllers\AccountManager@getReferals');

    // PAYMENT CRUD
    Route::group(['prefix' => 'pay'], function(){
        Route::post('/create/charge', 'App\Http\Controllers\PayManager@createCharge');
    });

    // INVESTMENT CRUD
    Route::group(['prefix' => 'transact'], function(){
        Route::get('/create/charge', 'App\Http\Controllers\PayManager@createCharge');
        Route::post('/make-request', 'App\Http\Controllers\PayManager@makeWalletRequest');
        Route::post('/invest', 'App\Http\Controllers\PayManager@invest');
    });
    
});

// Fallback
Route::fallback(function (Request $request) {
    return view('route_not_found', ['title' => 'Page Not Found','message'=> $request->path()]);
});
