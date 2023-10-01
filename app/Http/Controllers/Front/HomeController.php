<?php

namespace App\Http\Controllers\Front;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home');
    }
}
