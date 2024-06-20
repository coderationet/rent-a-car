<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    function index()
    {
        return redirect()->route('admin.items.index');
    }
}
