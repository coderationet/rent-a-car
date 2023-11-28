<?php

namespace App\Http\Controllers\Front;

use App\Helpers\AttributeHelper;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Helpers\ItemHelper;
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
        return view('front.item.show', [
            'item' => $item,
            'attributes' => $attributes,
            'title' => $title,
            'date_value' => $date_value,
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
