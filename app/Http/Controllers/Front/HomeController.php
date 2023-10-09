<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;


class HomeController extends Controller
{
    public function index()
    {

        $categories = cache()->remember('all_categories', 60*60, function () {
            return ItemCategory::orderBy('name', 'asc')->get();
        });

        return view('front.home', compact('categories'));
    }
}
