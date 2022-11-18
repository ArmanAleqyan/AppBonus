<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\CompanyController;
use \App\Http\Controllers\Api\QrController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('VerifyRegister', [UserController::class, 'VerifyRegister']);
Route::post('SendNewCode', [UserController::class, 'SendNewCode']);
Route::post('ForgotPassword', [UserController::class, 'ForgotPassword']);
Route::post('ResetCodePassword', [UserController::class, 'ResetCodePassword']);
Route::post('NewPassword', [UserController::class, 'NewPassword']);
Route::post('UserLogin', [UserController::class, 'UserLogin']);


Route::get('ActiveCompany', [CompanyController::class, 'ActiveCompany']);
Route::get('ScanUser/user_id={id}', [QrController::class, 'ScanUser']);

Route::get('CompanyInfo', [CompanyController::class, 'CompanyInfo']);