<?php
namespace App\Helpers;
use App\Models\Reservation;

class ReservationHelper{
    public static function delete_unpaid_reservations($user_id = null , $except_id = null){

        $delete = Reservation::where('status', 'created');

        if($user_id){
            $delete = $delete->where('user_id', $user_id);
        }

        // older than 1 hour
        $delete = $delete->where('created_at', '<', now()->subHour());

        if($except_id){
            $delete = $delete->where('id', '!=', $except_id);
        }

        $delete = $delete->delete();

        return $delete;

    }

    public static function generate_code($reservation_id){

        $code = 'R'.md5(time().uniqid().$reservation_id);
        return strtoupper($code);

    }
}
