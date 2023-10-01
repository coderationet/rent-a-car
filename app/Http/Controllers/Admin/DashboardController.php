<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Front\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
}
