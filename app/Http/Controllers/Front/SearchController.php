<?php

namespace App\Http\Controllers\Front;

use App\Models\Attribute;
use App\Models\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $items = Item::query();

        $category = $request->get('category') ?? []; // category slug array

        $items = $items->whereHas('categories', function ($query) use ($category) {
            $query->whereIn('item_categories.slug', $category);
        });

        $request_attributes = [];

        foreach (request()->all() as $key => $value) {
            if (str_contains($key, 'attribute_')) {
                $key = explode('attribute_', $key)[1];
                if (!in_array($key, $request_attributes)) {
                    $request_attributes[] = $key;
                }
            }
        }

        $filter_attributes = config('website.filter_attributes');

        $attributes = cache('filter_attributes', function () use ($filter_attributes) {
            return Attribute::with('values')->whereIn('id', collect($filter_attributes)->pluck('id'))->get();
        });

        $attributes = $attributes->keyBy('slug');

        foreach (request()->all() as $key => $value) {
            if (str_contains($key, 'attribute_') && isset($attributes[explode('attribute_', $key)[1]])) {
                $items = $items->whereHas('attributeValues', function ($query) use ($value) {
                    $query->whereIn('attribute_value_id', $value);
                });
            }
        }

        // min_price
        if (request()->has('min_price') && request()->min_price != 0) {
            $items = $items->where('price', '>=', request()->min_price);
        }

        // max_price
        if (request()->has('max_price') && request()->max_price != config('website.max_price')) {
            $items = $items->where('price', '<=', request()->max_price);
        }


        $item_count = $items->count();


        $items = $items->with(['attributeValues' => function ($query) {
            $query->whereIn('attribute_id', [2, 17]);
        }]);


        $items = $items->paginate(12)->withQueryString();


        return view('front.search.show', compact('category', 'items', 'item_count'));
    }
}
