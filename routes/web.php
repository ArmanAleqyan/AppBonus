<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\StateController;

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
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware(['NoAuthUser'])->group(function () {
    Route::get('/',[AdminLoginController::class,'login'])->name('login');
    Route::post('/logined',[AdminLoginController::class,'logined'])->name('logined');
});

Route::middleware(['AuthUser'])->group(function () {
Route::get('HomePage', [AdminLoginController::class,'HomePage'])->name('HomePage');
Route::get('logoutAdmin', [AdminLoginController::class,'logoutAdmin'])->name('logoutAdmin');


Route::get('settingView', [AdminLoginController::class, 'settingView'])->name('settingView');
Route::post('updatePassword', [AdminLoginController::class, 'updatePassword'])->name('updatePassword');


Route::get('GetUsers', [UsersController::class, 'GetUsers'])->name('GetUsers');
Route::get('NewUser', [UsersController::class , 'NewUser'])->name('NewUser');

Route::post('CreateUser',[UsersController::class, 'CreateUser'])->name('CreateUser');
Route::post('Updateuser',[UsersController::class, 'Updateuser'])->name('Updateuser');
Route::get('ShowUser/user_id={id}', [UsersController::class, 'ShowUser'])->name('ShowUser');
Route::get('deleteUser/user_id={id}', [UsersController::class,'deleteUser'])->name('deleteUser');


Route::get('Company', [UsersController::class, 'Company'])->name('Company');
Route::get('CreateNewCompany', [UsersController::class, 'CreateNewCompany'])->name('CreateNewCompany');
Route::post('CreateCompany', [UsersController::class, 'CreateCompany'])->name('CreateCompany');
Route::get('ShowCompany/company_id={id}', [UsersController::class, 'ShowCompany'])->name('ShowCompany');
Route::post('UpdateCompany', [UsersController::class, 'UpdateCompany'])->name('UpdateCompany');


Route::post('CreateNewMeanger', [UsersController::class, 'CreateNewMeanger'])->name('CreateNewMeanger');
Route::post('UpdateMeaneger', [UsersController::class, 'UpdateMeaneger'])->name('UpdateMeaneger');

Route::get('searchUser', [SearchController::class, 'searchUser'])->name('searchUser');
Route::get('searchCompany', [SearchController::class, 'searchCompany'])->name('searchCompany');

Route::get('State', [StateController::class, 'State'])->name('State');
Route::get('DownloadStateExcel', [StateController::class, 'DownloadStateExcel'])->name('DownloadStateExcel');
Route::get('DownloadUserExcel', [StateController::class, 'DownloadUserExcel'])->name('DownloadUserExcel');
Route::get('DownloadCompanyExcel', [StateController::class, 'DownloadCompanyExcel'])->name('DownloadCompanyExcel');


    Route::view('Info', 'admin/Info')->name('Info');
    Route::post('UpdateInfo', [StateController::class, 'UpdateInfo'])->name('UpdateInfo');
    
});