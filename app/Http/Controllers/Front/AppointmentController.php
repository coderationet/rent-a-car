<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function driver_info_step()
    {
        return view('front.appointment.driver_info_step');
    }

    public function payment_store(Request $request)
    {
        $session_id = $request->session()->getId();
    }

    public function payment_options()
    {
        return view('front.appointment.payment_options');
    }

    public function payment_result()
    {
        return view('front.appointment.payment_result');
    }
}
