<?php

namespace App\Http\Controllers\Front\Api;

use App\Helpers\ItemHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Api\ItemCalendarIndexGetRequest;
use App\Models\Item\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemCalendarController extends Controller
{
    public function index(ItemCalendarIndexGetRequest $request)
    {
        $validated = $request->validated();

        $start_date = $validated['date_start'];
        $end_date = $validated['date_end'];

        $availability_data = ItemHelper::getItemAvailableDaysForDateRange($validated['item_id'], $start_date, $end_date);

        return response()->json([
            'status_code' => 200,
            'message' => __('front/api.item_calendar.availability_calendar_retrieved'),
            'data' => [
                'availability_data' => $availability_data,
            ],
            'errors' => [],
        ]);
    }
}
