<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\dashboard\ArticlesController;
use App\Http\Controllers\dashboard\BloodTypesController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\CitiesController;
use App\Http\Controllers\dashboard\ClientsController;
use App\Http\Controllers\dashboard\ContactCotroller;
use App\Http\Controllers\dashboard\DonationsController;
use App\Http\Controllers\dashboard\HeroPagesController;
use App\Http\Controllers\dashboard\IndexController;
use App\Http\Controllers\dashboard\NotificationController;
use App\Http\Controllers\dashboard\RoleController;
use App\Http\Controllers\dashboard\SettingController;
use App\Http\Controllers\dashboard\StateController;
use App\Http\Controllers\dashboard\UsersController;


Route::group(['prefix'=>"admin"],function(){

    Route::get('/change-password',[IndexController::class,'showChangePasswordForm'])->name('change.password');

    Route::post('/update-password',[IndexController::class,'updatePassword'])->name('update.password');

    Auth::routes();

    Route::group(['middleware'=>['auth','auto-permission']],function(){
        Route::get('/',[IndexController::class,'home'])->name('admin.index');
        Route::resource('/states',StateController::class)->except(['show']);
        Route::resource('/cities',CitiesController::class)->except(['show']);
        Route::resource('/articles',ArticlesController::class)->except(['show']);
        Route::resource('/blood-types',BloodTypesController::class)->except(['show']);
        Route::resource('/categories',CategoryController::class)->except(['show']);
        Route::resource('/setting',SettingController::class)->except(['show','edit','create']);
        Route::resource('/heros',HeroPagesController::class)->except(['show']);
        Route::resource('/contacts',ContactCotroller::class)->only(['index','destroy']);
        Route::resource('/clients',ClientsController::class)->only(['index','destroy']);
        Route::resource('/donations',DonationsController::class)->only(['index','destroy']);
        Route::resource('/roles',RoleController::class)->except(['show']);
        Route::resource('/users',UsersController::class)->except(['show']);
        Route::resource('/notifications',NotificationController::class)->only(['index','destroy']);
    });
});
