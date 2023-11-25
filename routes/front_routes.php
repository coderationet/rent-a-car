<?php


use App\Http\Controllers\Front;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return view('test');
})->name('test');

Route::group(['as' => 'front.'], function () {

    Route::controller(Front\HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::post('validate-home-search', 'validate_search')->name('validate-home-search');
    });

    // Image routes
    Route::get('image/{image_id}/{size}/image.webp', [Front\ImageController::class, 'show'])->name('image.show');
    Route::get('image/{image_id}/{size}/{mode}/image.webp', [Front\ImageController::class, 'show'])->name('image.show.mode');

    Route::get('item/{slug}', [Front\ItemController::class, 'show'])->name('item.show');
    Route::post('attribute-values/get', [Front\AttributeValueController::class, 'get'])->name('attribute-values.get');
    Route::get('page/{slug}', [Front\PageController::class, 'show'])->name('page.show');
    Route::get('contact', [Front\PageController::class, 'contact'])->name('page.contact');
    Route::post('contact/post', [Front\PageController::class, 'contact_post'])->name('page.contact.post');

    // Search and category routes
    Route::get('search/remove-filter', [Front\SearchController::class, 'remove_filter_from_url'])->name('search.remove_filter_from_url');
    Route::get('search', [Front\SearchController::class, 'index'])->name('search.index');
    Route::get('search/{category}', [Front\SearchController::class, 'index'])->name('search.category');

    // Appointment routes
    Route::controller(Front\AppointmentController::class)->group(function () {
        Route::get('appointment/driver-info', 'driver_info_step')->name('driver_info_step');
        Route::post('appointment/payment/store', 'payment_store')->name('payment_step');
        Route::get('appointment/payment/options', 'payment_options')->name('payment.show');
        Route::get('appointment/payment/result', 'payment_result')->name('payment.result');
    })->name('appointment.');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


