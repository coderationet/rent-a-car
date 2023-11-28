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

        $appointment = Reservation::create($data);

        return redirect()->route('front.payment.options', ['appointment_id' => $appointment->id]);

    }


}
