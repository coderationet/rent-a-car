<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Option;
use App\Helpers\ReservationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverInfoStepGetRequest;
use App\Http\Requests\DriverInfoStoreGetRequest;
use App\Models\Item;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function driver_info_step(DriverInfoStepGetRequest $request)
    {
        $validated_data = $request->validated();
        $daterange = $validated_data['daterange'];
        $daterange = explode(' - ', $daterange);
        $start_date = $daterange[0];
        $end_date = $daterange[1];

        $title = "Driver Info Step";

        $item = Item::findOrFail($validated_data['item_id']);

        $price = $item->price;

        $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);

        $total_price = $price * $days;

        ReservationHelper::delete_unpaid_reservations(auth()->user()->id);

        return view('front.appointment.driver_info_step', [
            'start_date' => $start_date,
            'title' => $title,
            'end_date' => $end_date,
            'item' => $item,
            'total_price' => $total_price,
            'days' => $days,
        ]);
    }

    public function driver_info_store(DriverInfoStoreGetRequest $request)
    {

        $validated_data = $request->validated();

        $title = "Driver Info Store";

        $days = strtotime($validated_data['end_date']) - strtotime($validated_data['start_date']);
        $days = $days / (60 * 60 * 24);

        $item = Item::findOrFail($validated_data['item_id']);

        $total_price = $days * $item->price;

        $data = $request->all();

        $data['user_id'] = auth()->user()->id;

        $data['session_id'] = session()->getId();

        $data['payment_amount'] = $total_price;

        $data['status'] = Reservation::STATUS_CREATED;

        $data['payment_method'] = $validated_data['payment_option'];

        $billing_type = $request->billing_type;

        if ($validated_data['enable_billing'] == 1 && $validated_data['billing_type'] == 'individual') {
            $data['invoice_type'] = $validated_data['billing_type'];
            $data['invoice_company_type'] = $validated_data['billing_type'];
            $data['country'] = $validated_data['individual_billing_country'];
            $data['city'] = $validated_data['individual_billing_city'];
            $data['district'] = $validated_data['individual_billing_district'];
        }

        if ($data['payment_method'] == 'bank_transfer'){
            $data['status'] = Reservation::STATUS_PENDING;
        }

        // check if there is approbed reservation in this date range
        $reservation = Reservation::where('item_id', $data['item_id'])
            ->where('start_date', '<=', $data['start_date'])
            ->where('end_date', '>=', $data['end_date'])
            ->where('status','approved')
            ->first();

        if ($reservation){
            return redirect()->back()->withErrors(['error' => 'There is approved reservation in this date range']);
        }


        $appointment = Reservation::create($data);

        $data['code'] = ReservationHelper::generate_code($appointment->id);

        $appointment->update($data);

        if ($data['payment_method'] == 'bank_transfer'){
            return redirect()->route('front.payment.bank_transfer_instructions', ['appointment_id' => $appointment->id]);
        }

        return redirect()->route('front.payment.options', ['appointment_id' => $appointment->id]);

    }


}
