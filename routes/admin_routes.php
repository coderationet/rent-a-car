<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;


Route::group(['as' => 'admin.','prefix' => "admin",'middleware' => ['auth']],function (){

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [Admin\DashboardController::class,'index'])->name('dashboard');

    // Users
    Route::get('users/data', [Admin\UserController::class,'data'])->name('users.data');
    Route::get('users/ajax-data', [Admin\UserController::class,'ajax_data'])->name('users.ajax_data');
    Route::resource('users', Admin\UserController::class);


    // Items
    Route::get('items/attribute-value-row-html', [Admin\ItemController::class,'attribute_value_row_html'])->name('items.attribute_value_row_html');
    Route::get('items/get-item', [Admin\ItemController::class,'get_item'])->name('items.get_item');
    Route::get('items/data', [Admin\ItemController::class,'data'])->name('items.data');
    Route::resource('items', Admin\ItemController::class);

    // Item Attributes
    Route::get('item-attributes/get-item-attribute',[Admin\ItemAttributeController::class,'get_item_attribute'])->name('item-attributes.get_item_attribute');
    Route::get('item-attributes/ajax-data',[Admin\ItemAttributeController::class,'ajax_data'])->name('item-attributes.ajax_data');
    Route::resource('item-attributes',Admin\ItemAttributeController::class);

    Route::get('item-attribute-values/ajax-data',[Admin\ItemAttributeValueController::class,'ajax_data'])->name('item-attribute-values.ajax_data');
    Route::resource('item-attribute-values',Admin\ItemAttributeValueController::class);

    // Item Categories
    Route::get('item-categories/get-item-category', [Admin\ItemCategoryController::class,'get_item_category'])->name('item-categories.get_item_category');
    Route::get('item-categories/new-category-form-html', [Admin\ItemCategoryController::class,'new_category_form_html'])->name('item-categories.new_category_form_html');
    Route::resource('item-categories', Admin\ItemCategoryController::class);

    // Media Library
    Route::get('media-library/iframe', [Admin\MediaLibraryController::class,'iframe'])->name('media-library.iframe');
    Route::post('media-library/media-block-html', [Admin\MediaLibraryController::class,'media_block_html'])->name('media-library.media-block-html');
    Route::resource('media-library', Admin\MediaLibraryController::class);

    // Slider
    Route::get('sliders/slider-item-row-html', [Admin\SliderController::class,'slider_item_row_html'])->name('sliders.slider_item_row_html');
    Route::resource('sliders', Admin\SliderController::class);

    // Users
    Route::get('contacts/data',[Admin\ContactController::class,'data'])->name('contacts.data');
    Route::resource('contacts',Admin\ContactController::class);

    // Pages
    Route::get('pages/get-page',[Admin\PageController::class,'get_page'])->name('pages.get_page');
    Route::get('pages/data',[Admin\PageController::class,'data'])->name('pages.data');
    Route::resource('pages',Admin\PageController::class);

    // Blog
    Route::get('blogs/data',[Admin\BlogController::class,'data'])->name('blogs.data');
    Route::resource('blogs',Admin\BlogController::class);

    // Settings
    Route::resource('settings', Admin\SiteSettingController::class);
});

