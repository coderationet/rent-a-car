<?php

namespace App\Http\Controllers\Front;

use App\Helpers\AttributeHelper;
use App\Helpers\ItemHelper;
use App\Http\Controllers\Controller;
use App\Models\Item\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function show(String $slug){
        $item = Item::where('slug', $slug)->firstOrFail();
        $attributes = AttributeHelper::itemAttributes($item);
        $title = $item->title;
        $date_value = null;
        if (request()->filled('start_date') && request()->filled('end_date')) {
            $date_value = request()->start_date . ' - ' . request()->end_date;
        }

        // 2 months before now
        $start_date = Carbon::now()->subMonths(2)->startOfMonth();
        $start_date = $start_date->format('Y-m-d');

        // 2 months after now
        $end_date = Carbon::now()->addMonths(2)->endOfMonth();
        $end_date = $end_date->format('Y-m-d');

        $available_dates = ItemHelper::getItemAvailableDaysForDateRange($item->id, $start_date, $end_date);

        return view('front.item.show', [
            'item' => $item,
            'attributes' => $attributes,
            'title' => $title,
            'date_value' => $date_value,
            'available_dates' => $available_dates,
        ]);
    }

    public function item_availability(){

        $validate = Validator::make(request()->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'item_id' => 'required|integer|exists:items,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'messages' => $validate->errors(),
            ]);
        }

        $availability = ItemHelper::getItemAvailableDaysForDateRange(request()->item_id, request()->start_date, request()->end_date);

        return response()->json($availability);
    }
}
