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
// use CoinbaseCommerce\Webhook;
// Route::post('/webhook/coinbase2', function(Request $req){


//     /**
//      * To run this example please read README.md file
//      * Past your Webhook Secret Key from Settings/Webhook section
//      * Make sure you don't store your Secret Key in your source code!
//      */

//     $secret = '3637f2e9-32c7-43c4-8b3a-289ca4f9db1f';
//     $headerName = 'X-Cc-Webhook-Signature';
//     $headers = getallheaders();
//     $signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
//     $payload = trim(file_get_contents('php://input'));

//     try {
//         $event = Webhook::buildEvent($payload, $signraturHeader, $secret);
//         http_response_code(200);
//         echo sprintf('Successully verified event with id %s and type %s.', $event->id, $event->type);
//     } catch (\Exception $exception) {
//         http_response_code(400);
//         echo 'Error occured. ' . $exception->getMessage();
//     }

//         // logger(json_encode($req));
        
// });

Route::webhooks('/webhook/coinbase/t');

/* Page Routes */
// User
Route::view('/','landing', ['title'=>'Welcome to Investment'])->name('home');
Route::view('/#/login', 'landing', ['title'=>'Welcome to Investment'])->name('login');


Route::get('/auth/logout', 'App\Http\Controllers\AuthManager@logout');
Route::post('/auth/login', 'App\Http\Controllers\AuthManager@login');
Route::post('/auth/register', 'App\Http\Controllers\AuthManager@register');
Route::post('/auth/reset-password', 'App\Http\Controllers\AuthManager@reset_password');
Route::post('/auth/check-token', 'App\Http\Controllers\AuthManager@check_access_token');
Route::get('/auth/verify/{email}/{vtoken}', 'App\Http\Controllers\AuthManager@email_verify');


/* Authentication Routes */
// Access token
// Route::post('/auth/check-token', 'App\Http\Controllers\AuthManager@send_token')
// 	->middleware('App\Http\Middleware\SendToken');


// User
// Route::post('/auth/login', 'App\Http\Controllers\Authentication@login')
// 	->middleware('App\Http\Middleware\SendToken');


// Admin
Route::view('/admin','admin-auth', ['title'=>'Welcome Admin'])->name('admin_home');
Route::post('/admin/auth/login', 'App\Http\Controllers\AuthManager@login')->middleware('App\Http\Middleware\Adminify');
Route::post('/admin/auth/register', 'App\Http\Controllers\AuthManager@register')->middleware('App\Http\Middleware\Adminify');
Route::post('/admin/auth/reset-password', 'App\Http\Controllers\AuthManager@reset_password');

Route::get('/admin/dashboard', 'App\Http\Controllers\AdminManager@index');
Route::get('/admin/users', 'App\Http\Controllers\AdminManager@users');
Route::post('/admin/addplan', 'App\Http\Controllers\AdminManager@addplan');


/* Dashboard Routes */
// User
Route::get('/dashboard', 'App\Http\Controllers\ProfileManager@index');
Route::get('/dashboard/profile', 'App\Http\Controllers\ProfileManager@profile');
Route::get('/dashboard/account-overview', 'App\Http\Controllers\ProfileManager@account');
Route::get('/dashboard/profile/transactions', 'App\Http\Controllers\ProfileManager@transactions');

/* Transaction Routes */
Route::post('/transact/create-charge', 'App\Http\Controllers\Payment@create_charge');



/* Info Routes */
Route::get('/investment-plans', 'App\Http\Controllers\InfoManager@plan');
Route::get('/get-coin-data', 'App\Http\Controllers\InfoManager@getCoinData');

Route::get('/get-countries', function(){
    $res = utils\getRequest('https://api.printful.com/countries/');
    if ($res->successful()) {
        return response($res->json());
    }
    return response(json_encode(['err'=> $res->error()]), 200);
});




// // Admin
// Route::get('/admin', function () {
// 	return view('admin_authentication', ['title'=>'Home']);
// });

// Fallback
Route::fallback(function (Request $request) {
    return view('route_not_found', [
    	'title' => 'Page Not Found',
    	'message'=> $request->path()
    ]);
});


Route::get('/test2', 'App\Http\Controllers\InfoManager@getCoinData');
use App\Models\User;
Route::get('/test3', function () {
    return json_encode(User::with_id(2)->account);
});
/* Test Routes */
use App\Models\Plan;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Checkout;
Route::get('/test', function () {
	// $d = new CoinPaid(env('COINPAID_TEST_API'));
	ApiClient::init('29f5111e-6694-42b9-918c-8896f9e9f838');
	$checkoutObj = new Checkout([
    "description" => "Mastering the Transition to the Information Age",
    "local_price" => [
        "amount" => "1.00",
        "currency" => "USD"
    ],
    "name" => "test item 15 edited",
    "pricing_type" => "fixed_price",
    "requested_info" => ["email"]
]);

try {
    $checkoutObj->save();
    echo sprintf("Successfully created new checkout with id: %s \n", $checkoutObj->id);
} catch (\Exception $exception) {
    echo sprintf("Enable to create checkout. Error: %s \n", $exception->getMessage());
}
	return var_dump([]);
});
