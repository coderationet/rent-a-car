<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request, $category_ = null)
    {

        $items = Item::query();

        $category = $request->filled('category') ? [...$request->get('category')] : []; // category slug array

        foreach ($category as $key => $cat) {
            if ($cat == null){
                unset($category[$key]);
            }
        }

        if($category_){
            $category_ = ItemCategory::where('slug', $category_)->first();
        }

        if($category_){
            $category[] = $category_->id;
        }

        // remove null or empty values
        $category = array_filter($category);

        if (count($category)) {
            // convert nested arrays to single array
            $items = $items->whereHas('categories', function ($query) use ($category) {
                $query->whereIn('item_categories.id', $category);
            });
        }

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

        $attributes = cache()->remember('filter_attributes', 60, function () use ($filter_attributes) {
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

        // start_date & end_date
        if (request()->filled('start_date') && request()->filled('end_date')) {
            $items = $items->whereDoesntHave('reservations', function ($query) {
                $query->where('start_date', '<=', request()->start_date)
                    ->where('end_date', '>=', request()->end_date)
                    ->where('status', 'approved');
            });
        }

        $items = cache()->remember('query_search_items_' . md5(request()->fullUrl()), config('cache.app_cache_ttl'), function () use ($items) {
            return $items->with('thumbnail', 'attributeValues', 'categories')->paginate(12)->withQueryString();
        });

        $title = 'Search';

        if (count($category)){

            $title_cached = cache()->remember('category_title_' . md5(implode(',', $category)), config('cache.app_cache_ttl'), function () use ($category) {
                return implode(', ',ItemCategory::whereIn('id', $category)->pluck('name')->toArray());
            });

            $title .= ' in ' . $title_cached;
        }

        $date_string = '';

        if (request()->filled('start_date') && request()->filled('end_date')) {
            $date_string = '?start_date=' . request()->start_date . '&end_date=' . request()->end_date;
        }

        return view('front.search.show', compact('category', 'items','title','date_string'));

    }

    function remove_filter_from_url()
    {

        $ref = request()->headers->get('referer');


        $query_params = explode('?', $ref)[1];

        $query_params = explode('&', $query_params);

        $parameters = [];

        foreach ($query_params as $query_param) {

            $query_param = explode('=', $query_param);

            $query_param[0] = str_replace('%5B%5D', '', $query_param[0]);
            $query_param[0] = str_replace('[]', '', $query_param[0]);


            if (!isset($parameters[$query_param[0]])) {
                $parameters[$query_param[0]] = [];
            }

            $parameters[$query_param[0]][] = $query_param[1];

        }


        $attribute_value_id = request()->get('attribute_value_id');

        foreach ($parameters as $key => $parameter) {
            if ($key == 'page') {
                unset($parameters[$key]);
                continue;
            }
            if (str_contains($key, 'attribute_')) {
                foreach ($parameter as $value_key => $value_id) {
                    if ($value_id == $attribute_value_id) {
                        unset($parameters[$key][$value_key]);
                    }
                }
            }
            if ($key == 'category') {
                foreach ($parameter as $value_key => $value_id) {
                    if ($value_id == $attribute_value_id) {
                        unset($parameters[$key][$value_key]);
                    }
                }
            }
        }

        $url = route('front.search.index') . '?';

        foreach ($parameters as $key => $parameter) {
            if (str_contains($key, 'attribute_')) {
                foreach ($parameter as $value_key => $value_id) {
                    $url .= $key . '[]=' . $value_id . '&';
                }
            } else if ($key == 'category') {
                foreach ($parameter as $value_key => $value_id) {
                    $url .= $key . '[]=' . $value_id . '&';
                }
            } else {
                $url .= $key . '=' . $parameter[0] . '&';
            }
        }

        $url = rtrim($url, '&');

        return response()->json([
            'url' => $url,
            'status' => 'success'
        ]);
    }

}
