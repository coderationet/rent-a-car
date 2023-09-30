<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;


Route::group(['as' => 'admin.','prefix' => "admin",'middleware' => ['auth']],function (){

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [Admin\DashboardController::class,'index'])->name('dashboard');
    // Media Library
    Route::get('media-library/iframe', [Admin\MediaLibraryController::class,'iframe'])->name('media-library.iframe');
    Route::post('media-library/media-block-html', [Admin\MediaLibraryController::class,'media_block_html'])->name('media-library.media-block-html');
    Route::resource('media-library', Admin\MediaLibraryController::class);


});

