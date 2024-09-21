<?php
use App\Http\Controllers\dashboard\CitiesController;

Route::group(['prefix'=>"ajax"],function(){
    Route::get('/cities/{state_id}',[CitiesController::class,'getCities'])->name('cities.ajax');
});
