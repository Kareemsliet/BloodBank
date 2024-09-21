<?php

use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\MainController;


Route::get('/',[MainController::class,'home'])->name(name: 'index');

Route::get('/contact-us',[MainController::class,'contact'])->name('contact-us');

Route::get('/about',[MainController::class,'about'])->name('about');

Route::get('/articles/{name}',[MainController::class,'getArticle'])->name('article');

Route::get('/show-donation/{donation}',[MainController::class,'getDonation'])->name('donation');

Route::get('/donations',[MainController::class,'getDonations'])->name('donations');

Route::get('/articles',[MainController::class,'getArticles'])->name('articles');

Route::get('/login',[AuthController::class,'showLoginForm'])->name('client.login');

Route::post('/login',action: [AuthController::class,'login'])->name('client.request');

Route::get('/register',[AuthController::class,'showRegisterForm'])->name('client.register');

Route::post('/register',action: [AuthController::class,'register'])->name('client.create');

Route::post('/contact-us',[MainController::class,'contactRequest'])->name('contact.request');

Route::get('/password/forget',action: [AuthController::class,'forgetPassword'])->name('client.forget.password');
Route::post('/password/forget',action: [AuthController::class,'getPhone'])->name('client.request.phone');

Route::get('/password/update/{token}',[AuthController::class,'showUpdateForm'])->name('client.update.password');

Route::post('/password/update',action: [AuthController::class,'updatePassword'])->name('client.request.password');

Route::group(['middleware'=>"auth:clients"],function(){
    Route::get('/donation',[MainController::class,'createDonation'])->name('donation.create');
    Route::post('/donation',[MainController::class,'requestDonation'])->name('donation.request');
    Route::post('/logout',[AuthController::class,'logout'])->name('client.logout');
    Route::get('/setting',[MainController::class,'changeSetting'])->name('client.setting');
    Route::get('/profile',[MainController::class,'getProfile'])->name('client.profile');
});


require_once __DIR__."/admin.php";

require_once __DIR__."/ajax.php";
