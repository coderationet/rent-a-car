<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Option;
use App\Helpers\PaymentGatewayHelper;
use App\Helpers\ReservationHelper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payment_options(){

        $validate = Validator::make(request()->all(), [
            'appointment_id' => 'required|exists:reservations,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $title = "Payment Options";

        $user_id = auth()->user()->id;

        ReservationHelper::delete_unpaid_reservations($user_id , request()->appointment_id);

        $reservation = Reservation::where('id', request()
            ->appointment_id)
            ->where('user_id', $user_id)
            ->where('status', Reservation::STATUS_CREATED)
            ->where('session_id', session()->getId())
            ->firstOrFail();

        $default_payment_gateway = Option::get('default_payment_gateway');

        $payment_gateways = PaymentGatewayHelper::get_payment_gateways(true);

        return view('front.payment.payment_options', compact('title','payment_gateways','default_payment_gateway','reservation'));
    }

    public function bank_transfer_instructions(Request $request,$appointment_id){

        $appointment_id = request()->appointment_id;

        $reservation = Reservation::where('id', $appointment_id)
            ->where('user_id', auth()->user()->id)
            ->where('session_id', session()->getId())
            ->firstOrFail();

        $bank_transfer_page_id = Option::get('bank_transfer_page_id');

        $bank_transfer_page = Page::findOrFail($bank_transfer_page_id);

        return view('front.payment.bank_transfer_instructions', compact('bank_transfer_page','reservation'));
    }

}
