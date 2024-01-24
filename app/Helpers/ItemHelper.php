<?php

namespace App\Helpers;

use App\Models\Item\Item;
use App\Models\Reservation;
use Illuminate\Support\Carbon;

class ItemHelper
{
    public static function validateItemDates($item_id, $start_date, $end_date)
    {
        $itemDateIsAvailable = Item::where('id', $item_id)
            ->whereDoesntHave('appointments', function ($query) use ($start_date, $end_date) {
                $query->where('start_date', '<=', $end_date)
                    ->where('end_date', '>=', $start_date)
                    ->where('status', 'approved');
            })->exists();

        return $itemDateIsAvailable;
    }

    public static function getItemAvailableDaysForDateRange($item_id, $start_date, $end_date) : array
    {

        $start_date = Carbon::create($start_date);

        if ($start_date->diffInDays(Carbon::now()) > 600) {
            $start_date = Carbon::now()->startOfMonth();
        }


        $end_date = Carbon::create($end_date);

        $item = Item::find($item_id);

        $reservations = $item->reservations()
            ->where('status', '=', 'approved')
            ->whereDate('start_date', '>=', $start_date)
            ->whereDate('end_date', '<=', $end_date)
            ->get();

        $period = Carbon::parse($start_date)->daysUntil($end_date);

        $availability_data = [];

        foreach ($period as $date) {

            $is_available = true;

            foreach ($reservations as $reservation) {
                if ($date->between($reservation->start_date, $reservation->end_date)) {
                    $is_available = false;
                    break;
                }
            }

            $availability_data[$date->format('Y-m-d')] = $is_available;
        }

        return $availability_data;
    }
}
