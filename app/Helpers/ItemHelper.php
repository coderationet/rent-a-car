<?php

namespace App\Helpers;

use App\Models\Item\Item;
use App\Models\Reservation;

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

    public static function getItemAvailableDaysForDateRange($item_id, $start_date, $end_date)
    {
        // get all reservations from start_date to end_date and return the days as array with availability status true or false
        $item = Item::where('id', $item_id)->first();
        $item_reservations = Reservation::where('item_id', $item_id)
            ->where('start_date', '<=', $end_date)
            ->where('end_date', '>=', $start_date)
            ->where('status', 'approved')
            ->get();
        $days = [];
        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date);
        $current_date = $start_date;
        while ($current_date <= $end_date) {
            $day = date('Y-m-d', $current_date);
            $day_is_available = true;
            foreach ($item_reservations as $item_reservation) {
                if ($day >= $item_reservation->start_date && $day <= $item_reservation->end_date) {
                    $day_is_available = false;
                }
            }
            $days[] = [
                'day' => $day,
                'available' => $day_is_available,
                'price' => $item->price,
            ];
            $current_date = strtotime('+1 day', $current_date);
        }

        return $days;
    }
}
