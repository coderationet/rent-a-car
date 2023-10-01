<?php

namespace App\Http\Controllers\Front;

use App\Helpers\AttributeHelper;
use App\Models\Item;

class ItemController extends Controller
{
    public function show(String $slug){
        $item = Item::where('slug', $slug)->firstOrFail();
        $attributes = AttributeHelper::itemAttributes($item);
        return view('front.item.show', [
            'item' => $item,
            'attributes' => $attributes,
        ]);
    }
}
