<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front;


Route::group([
    'as' => 'front.'
], function () {
    Route::controller(Front\HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });
});
