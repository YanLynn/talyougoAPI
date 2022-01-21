<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/login-user', function (Request $request) {
    return $request->user();
});


//public route
Route::get('login/{provider}', [AuthController::class, "redirectToProvider"]);
Route::get('login/{provider}/callback', [AuthController::class, "handleProviderCallback"]);
Route::post('login', [AuthController::class, "login"]);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, "logout"]);
Route::post('loginWithFacebook', [AuthController::class, "loginWithFacebook"]);

Route::get('get-city', [PcodesController::class, 'getCity']);
Route::get('get-district/{sr_pcode?}', [PcodesController::class, 'getDistrict']);
Route::get('get-township/{sr_pcode?}/{d_code?}', [PcodesController::class, 'getTownship']);

Route::get('sendOTP', [AuthController::class, 'sendOTP']);


//authenticate route 
//for admin only api
Route::middleware('auth.role:1')->group(function (){

 //user
 Route::resource('user', UserController::class);


 //profile
 Route::get('get-profile/{id}', [ProfileController::class, 'getProfile']);
 Route::post('profile/store', [ProfileController::class, 'store']);
 Route::post('profile/{profile_id}/update', [ProfileController::class, 'update']);
 Route::delete('profile/{profile_id}/delete', [ProfileController::class, 'delete']);
});


//authenticate route 
//for admin and cashier
Route::middleware('auth.role:1,2')->group(function () {
    Route::get('get-role', [UserController::class, 'getRoleList']);
    Route::get('refresh', [AuthController::class, "refresh"]);
    Route::get('getUser', [AuthController::class, "getUser"]);

    //invoice
    Route::get('invoice',[CodeSetupController::class, 'getInvoice']);
    Route::post('invoic/store',[CodeSetupController::class,'invoiceStore']);
    Route::get('invoic/{id}/edit',[CodeSetupController::class,'invoiceEdit']);
    Route::post('invoice/{id}/update',[CodeSetupController::class,'invoiceUpdate']);
    Route::delete('invoice/{id}/delete',[CodeSetupController::class,'invoiceDelete']);
    //track
    Route::get('track',[CodeSetupController::class, 'getTrack']);
    Route::post('track/store',[CodeSetupController::class,'trackStore']);
    Route::get('track/{id}/edit',[CodeSetupController::class,'trackEdit']);
    Route::post('track/{id}/update',[CodeSetupController::class,'trackUpdate']);
    Route::delete('track/{id}/delete',[CodeSetupController::class,'trackDelete']);

    //driver
    Route::get('driver',[CodeSetupController::class, 'getDriver']);
    Route::post('driver/store',[CodeSetupController::class,'driverStore']);
    Route::get('driver/{id}/edit',[CodeSetupController::class,'driverEdit']);
    Route::post('driver/{id}/update',[CodeSetupController::class,'driverUpdate']);
    Route::delete('driver/{id}/delete',[CodeSetupController::class,'driverDelete']);

    //Product Type
    Route::get('type',[CodeSetupController::class, 'getType']);
    Route::post('type/store',[CodeSetupController::class,'typeStore']);
    Route::get('type/{id}/edit',[CodeSetupController::class,'typeEdit']);
    Route::post('type/{id}/update',[CodeSetupController::class,'typeUpdate']);
    Route::delete('type/{id}/delete',[CodeSetupController::class,'typeDelete']);

    //city of township
    Route::get('cityOfTown',[CodeSetupController::class, 'getCityOfTown']);
    Route::post('cityOfTown/store',[CodeSetupController::class,'cityOfTownStore']);
    Route::get('cityOfTown/{id}/edit',[CodeSetupController::class,'cityOfTownEdit']);
    Route::post('cityOfTown/{id}/update',[CodeSetupController::class,'cityOfTownUpdate']);
    Route::delete('cityOfTown/{id}/delete',[CodeSetupController::class,'cityOfTownDelete']);

    Route::get('priceByProductType', [CodeSetupController::class,'priceByProductType']);


    Route::get('orderPaidList', [OrderController::class, 'orderPaidList']);

});


//authenticate route 
//for admin, cashier and deli user
Route::middleware('auth.role:1,2,3')->group(function(){


});



