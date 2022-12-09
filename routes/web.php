<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\CarBrandController;
use App\Http\Controllers\Admin\CarModelController;
use App\Http\Controllers\Admin\CarBrainController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->name('panel.')->prefix('panel')->group(function (){
    Route::get('/',[IndexController::class,'index'])->name('index');
    Route::post('/change/lang', [LanguageController::class, 'admin_swich_language'])
        ->name('change_language');
});

Route::group(['prefix' => 'panel/role', 'middleware' => 'auth'], function () {
    Route::get('/', [RoleController::class, 'index'])
        ->name('admin.role.index');
    Route::post('/store', [RoleController::class, 'store'])
        ->name('admin.role.store');
    Route::get('/edit/{role}', [RoleController::class, 'edit'])
        ->name('admin.role.edit');
    Route::post('/update', [RoleController::class, 'update'])
        ->name('admin.role.update');
    Route::get('/delete/{id}', [RoleController::class, 'destroy'])
        ->name('admin.role.delete');
    Route::post('/{role}/permissions', [RoleController::class, 'givePermission'])
        ->name('admin.role.permissions');
    Route::delete('/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])
        ->name('admin.roles.permissions.revoke');
});

Route::group(['prefix' => 'panel/permissions', 'middleware' => 'auth'], function () {
    Route::get('/', [PermissionController::class, 'index'])
        ->name('admin.permissions.index');
    Route::post('/store', [PermissionController::class, 'store'])
        ->name('admin.permissions.store');
    Route::get('/edit/{id}', [PermissionController::class, 'edit'])
        ->name('admin.permissions.edit');
    Route::post('/update', [PermissionController::class, 'update'])
        ->name('admin.permissions.update');
    Route::get('/delete/{id}', [PermissionController::class, 'destroy'])
        ->name('admin.permissions.delete');
});

Route::group(['prefix' => 'panel/cbrand', 'middleware' => 'auth'], function () {
    Route::get('/', [CarBrandController::class, 'index'])
        ->name('admin.cbrand.index');
    Route::post('/store', [CarBrandController::class, 'store'])
        ->name('admin.cbrand.store');
    Route::get('/edit/{uuid}', [CarBrandController::class, 'edit'])
        ->name('admin.cbrand.edit');
    Route::post('/update/{uuid}', [CarBrandController::class, 'update'])
        ->name('admin.cbrand.update');
    Route::get('/delete/{id}', [CarBrandController::class, 'destroy'])
        ->name('admin.cbrand.delete');
});

Route::group(['prefix' => 'panel/cmodel', 'middleware' => 'auth'], function () {
    Route::get('/', [CarModelController::class, 'index'])
        ->name('admin.cmodel.index');
    Route::post('/store', [CarModelController::class, 'store'])
        ->name('admin.cmodel.store');
    Route::get('/edit/{uuid}', [CarModelController::class, 'edit'])
        ->name('admin.cmodel.edit');
    Route::post('/update/{uuid}', [CarModelController::class, 'update'])
        ->name('admin.cmodel.update');
    Route::get('/delete/{id}', [CarModelController::class, 'destroy'])
        ->name('admin.cmodel.delete');
});

Route::group(['prefix' => 'panel/cbrain', 'middleware' => 'auth'], function () {
    Route::get('/', [CarBrainController::class, 'index'])
        ->name('admin.cbrain.index');
    Route::post('/store', [CarBrainController::class, 'store'])
        ->name('admin.cbrain.store');
    Route::get('/edit/{uuid}', [CarBrainController::class, 'edit'])
        ->name('admin.cbrain.edit');
    Route::post('/update/{uuid}', [CarBrainController::class, 'update'])
        ->name('admin.cbrain.update');
    Route::get('/delete/{id}', [CarBrainController::class, 'destroy'])
        ->name('admin.cbrain.delete');
    Route::post('fetch-models', [CarBrainController::class, 'fetchModel']);

});

Route::group(['prefix' => 'panel/language', 'middleware' => 'auth'], function () {
    Route::get('/', [LanguageController::class, 'index'])
        ->name('admin.language.index');
    Route::post('/store', [LanguageController::class, 'store'])
        ->name('admin.language.store');
    Route::get('/edit/{uuid}', [LanguageController::class, 'edit'])
        ->name('admin.language.edit');
    Route::post('/update/{uuid}', [LanguageController::class, 'update'])
        ->name('admin.language.update');
    Route::get('/delete/{uuid}', [LanguageController::class, 'destroy'])
        ->name('admin.language.delete');
    Route::get('/translation/{id}', [LanguageController::class, 'translation'])
        ->name('admin.translation.index');
    Route::post('/translation/update/{id}', [LanguageController::class, 'translation_update'])
        ->name('admin.translation.update');

});

Route::group(['prefix' => 'panel/user', 'middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index'])
        ->name('admin.user.index');
    Route::post('/store', [UserController::class, 'store'])
        ->name('admin.user.store');
    Route::get('/edit/{uuid}', [UserController::class, 'edit'])
        ->name('admin.user.edit');
    Route::post('/update/{uuid}', [UserController::class, 'update'])
        ->name('admin.user.update');
    Route::get('/delete/{uuid}', [UserController::class, 'destroy'])
        ->name('admin.user.delete');
    Route::post('/{user}/roles', [UserController::class, 'assignRole'])
        ->name('admin.users.roles');
    Route::delete('/{user}/roles/{role}', [UserController::class, 'removeRole'])
        ->name('admin.users.roles.remove');
    Route::post('/{user}/permissions', [UserController::class, 'givePermission'])
        ->name('admin.users.permissions');
    Route::delete('/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])
        ->name('admin.users.permissions.revoke');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
