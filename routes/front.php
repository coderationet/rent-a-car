<?php


use App\Http\Controllers\Front;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'front.'], function () {
    Route::controller(Front\HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });

    Route::get('item/{slug}', [Front\ItemController::class, 'show'])->name('item.show');
    Route::get('villas/{slug}', [Front\CategoryController::class, 'show'])->name('category.show');
    Route::get('category/remove-filter', [Front\CategoryController::class, 'remove_filter_from_url'])->name('category.remove-filter');
    Route::post('attribute-values/get', [Front\AttributeValueController::class, 'get'])->name('attribute-values.get');
    Route::get('page/{slug}', [Front\PageController::class, 'show'])->name('page.show');
    Route::get('contact', [Front\PageController::class, 'contact'])->name('page.contact');
    Route::post('contact/post', [Front\PageController::class, 'contact_post'])->name('page.contact.post');
    Route::post('search', [Front\SearchController::class, 'index'])->name('search.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


