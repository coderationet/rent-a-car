<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use Illuminate\Support\Facades\Artisan;


class HomeController extends Controller
{
    public function index()
    {

//        Artisan::call('cache:clear');

        $categories = cache()->remember('all_categories', 60*60, function () {
            return ItemCategory::with('thumbnail')->orderBy('name', 'asc')->get();
        });

        return view('front.home', compact('categories'));
    }
}
