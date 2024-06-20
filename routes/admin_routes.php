<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Module\DataTable\DataTableController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth','role:admin'],'prefix' => 'admin', 'as' => 'admin.'],function () {

    Route::get('/', [Admin\Dashboard\DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::get('users/data', [Admin\User\UserController::class,'data'])->name('users.data');
    Route::get('users/ajax-data', [Admin\User\UserController::class,'ajax_data'])->name('users.ajax_data');
    Route::resource('users', Admin\User\UserController::class);

    // Authorizon: Roles
    Route::group(['prefix' => 'users/authorizon','as' => 'authorizon.'],function (){
        Route::resource('roles', Admin\Authorizon\RoleController::class);
    });

    // Items
    Route::get('items/attribute-value-row-html', [Admin\Item\ItemController::class,'attribute_value_row_html'])->name('items.attribute_value_row_html');
    Route::get('items/get-item', [Admin\Item\ItemController::class,'get_item'])->name('items.get_item');
    Route::get('items/data', [Admin\Item\ItemController::class,'data'])->name('items.data');
    Route::get('items/ajax-data', [Admin\Item\ItemController::class,'ajax_data'])->name('items.ajax_data');
    Route::resource('items', Admin\Item\ItemController::class);

    // Reservations
    Route::get('reservations/data', [Admin\Reservation\ReservationController::class,'data'])->name('reservations.data');
    Route::resource('reservations', Admin\Reservation\ReservationController::class);


    // Item Attributes
    Route::get('item-attributes/get-item-attribute',[Admin\Item\ItemAttributeController::class,'get_item_attribute'])->name('item-attributes.get_item_attribute');
    Route::get('item-attributes/ajax-data',[Admin\Item\ItemAttributeController::class,'ajax_data'])->name('item-attributes.ajax_data');
    Route::resource('item-attributes', Admin\Item\ItemAttributeController::class);

    Route::get('item-attribute-values/ajax-data',[Admin\Item\ItemAttributeValueController::class,'ajax_data'])->name('item-attribute-values.ajax_data');
    Route::resource('item-attribute-values', Admin\Item\ItemAttributeValueController::class);

    // Item Categories
    Route::get('item-categories/get-item-category', [Admin\Item\ItemCategoryController::class,'get_item_category'])->name('item-categories.get_item_category');
    Route::get('item-categories/new-category-form-html', [Admin\Item\ItemCategoryController::class,'new_category_form_html'])->name('item-categories.new_category_form_html');
    Route::resource('item-categories', Admin\Item\ItemCategoryController::class);

    // Media Library
    Route::get('media-library/iframe', [Admin\MediaLibrary\MediaLibraryController::class,'iframe'])->name('media-library.iframe');
    Route::post('media-library/media-block-html', [Admin\MediaLibrary\MediaLibraryController::class,'media_block_html'])->name('media-library.media-block-html');
    Route::resource('media-library', Admin\MediaLibrary\MediaLibraryController::class);

    // Slider
    Route::get('sliders/slider-item-row-html', [Admin\Slider\SliderController::class,'slider_item_row_html'])->name('sliders.slider_item_row_html');
    Route::resource('sliders', Admin\Slider\SliderController::class);

    // Users
    Route::get('contacts/data',[Admin\Contact\ContactController::class,'data'])->name('contacts.data');
    Route::resource('contacts', Admin\Contact\ContactController::class);

    // Pages
    Route::get('pages/get-page',[Admin\Page\PageController::class,'get_page'])->name('pages.get_page');
    Route::get('pages/data',[Admin\Page\PageController::class,'data'])->name('pages.data');
    Route::resource('pages', Admin\Page\PageController::class);

    // Blog
    Route::get('blogs/data',[Admin\Blog\BlogController::class,'data'])->name('blogs.data');
    Route::resource('blogs', Admin\Blog\BlogController::class);

    // Menu Link
    Route::get('menu-links/data', [Admin\MenuLink\MenuLinkController::class,'data'])->name('menu-links.data');
    Route::resource('menu-links', Admin\MenuLink\MenuLinkController::class);

    Route::group(['prefix' => 'setting','as' => 'settings.'],function (){

        Route::resource('general-settings', Admin\Settings\GeneralSettingController::class);

        Route::resource('payment-settings', Admin\Settings\PaymentSettingController::class);

    });

    // Helpers
    Route::get('generate-slug',Admin\Helpers\SlugGeneratorController::class)->name('generate-slug');

    // DataTable
    Route::get('data-table/data',DataTableController::class)->name('data-table.data');
});
