<?php

namespace App\View\Components;

use App\Models\Attribute\Attribute;
use App\Models\Item\ItemCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filters extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $items,
        public $categoryids,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $items = $this->items;

        $min_price = 0;
        $max_price = 100000;

        $filter_attributes = config('website.filter_attributes');

        $attributes = cache()->remember('filter_attributes',60, function () use ($filter_attributes) {
            return Attribute::whereIn('id', collect($filter_attributes)->pluck('id'))->with('values')->get();
        });

        $open_attributes = [];

        foreach ($filter_attributes as $attribute) {
            if ($attribute['is_open'] == true) {
                $open_attributes[] = $attribute['id'];
            }
        }

        $attributes = collect($attributes)->map(function ($attribute) use ($open_attributes) {

            $is_open = false;

            if (request()->has('attribute_'.$attribute->slug)) {
                $is_open = true;
            }

            if (in_array($attribute->id, $open_attributes)) {
                $is_open = true;
            }

            $attribute->is_open = $is_open;

            return $attribute;

        });

        $categories = cache()->remember('all_categories',60, function () {
            return ItemCategory::with('children','parent')->whereNull('parent_id')->orderBy('name','ASC')->get();
        });

        $selected_categories = $this->categoryids;

        return view('components.filters', [
            'items' => $items,
            'attributes' => $attributes,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'attribute_list' => $attributes,
            'categories' => $categories,
            'selected_categories' => $selected_categories,
        ]);
    }
}
