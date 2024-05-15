<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\Tes\ItemController;
use App\Http\Controllers\Account\Tes\UnitController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\Tes\EskulController;
use App\Http\Controllers\Account\Tes\KelasController;
use App\Http\Controllers\Account\Tes\MapelController;
use App\Http\Controllers\Account\Tes\MuridController;
use App\Http\Controllers\Account\Oauth\OauthController;
use App\Http\Controllers\Account\Sidebar\ModuleController;
use App\Http\Controllers\Account\Sidebar\SubMenuController;
use App\Http\Controllers\Account\Tes\DaftarKelasController;
use App\Http\Controllers\Account\Sidebar\MenuItemController;
use App\Http\Controllers\Account\Supplier\SupplierController;
use App\Http\Controllers\Account\UserPermission\RoleController;
use App\Http\Controllers\Account\UserPermission\UserController;
use App\Http\Controllers\Account\UserPermission\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('oauth/google', [OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');

Route::group(['prefix' => 'account', 'as' => 'account.', 'middleware' => ['auth']], function(){

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('/user', UserController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    
    // Management Sidebar
    Route::resource('/module', ModuleController::class);
    Route::resource('/menu-item', MenuItemController::class);
    Route::resource('/sub-menu', SubMenuController::class);

    Route::resource('/mapel', MapelController::class);
    Route::resource('/eskul', EskulController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/murid', MuridController::class);
    Route::resource('/daftar', DaftarKelasController::class);
});