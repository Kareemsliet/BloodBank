<?php

use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\ClientsAuthController;
use App\Http\Controllers\api\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => "v1"], function () {
    Route::get('/states', [MainController::class, 'getStates']);

    Route::get('/cities', [MainController::class, 'getCities']);

    Route::get('/blood-types', [MainController::class, 'getBloodTypes']);

    Route::get('/categories', [MainController::class, 'getCategories']);

    Route::get('/cities/{state_id}',[MainController::class,'citiesByState']);

    Route::get('/show-donation/{donation}',[MainController::class,'getDonation']);

    Route::get('/ashow-article/{article}',[MainController::class,'getArticle']);

    Route::get('/articles', [MainController::class, "getArticles"]);

    Route::get('/donations', [MainController::class, "getDonations"]);

    Route::get('/setting', [MainController::class, 'getSetting']);

    Route::get('/hero-pages', [MainController::class, 'getHeroPages']);

    Route::post('/register', [ClientsAuthController::class, 'regstire']);

    Route::post('/login', [ClientsAuthController::class, 'login']);

    Route::post('/password/phone', [ClientsAuthController::class, 'getPhone']);

    Route::post('/password/forget', [ClientsAuthController::class, 'updatePassword']);

    Route::group(['middleware' => "auth:sanctum"], function () {
        
        Route::post('/donation/create', [MainController::class, 'addDonate']);

        Route::post('/contact', [MainController::class, 'addContact']);

        Route::post('/logout', [ClientsAuthController::class, 'logout']);

        Route::group(['prefix'=>"client"],function(){
            Route::get('/states', [ClientController::class, "states"]);

            Route::get('/blood-types', [ClientController::class, "bloodTypes"]);

            Route::get('/favourites', [ClientController::class, "favourites"]);

            Route::get('/notifications', [ClientController::class, "notifications"]);

            Route::post('/notifications/read/{notify_id}', [ClientController::class, "readNotification"]);

            Route::post('/articles/favourite/{articel_id}', [ClientController::class, 'toggleFavourite']);

            Route::post('/profile/setting', [ClientController::class, 'addData']);

        });
    });
});
