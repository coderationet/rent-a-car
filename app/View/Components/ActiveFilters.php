<?php

namespace App\View\Components;

use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeValue;
use App\Models\Item\ItemCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActiveFilters extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        // if request doesnt have any ? in url
        if (!request()->has('min_price') && !request()->has('max_price') && !request()->has('attribute_')) {
            return '';
        }

        $filters = [];

        if (request()->has('min_price') && request()->min_price != 0) {
            $filters['min_price'] = request()->min_price;
        }

        if (request()->has('max_price') && request()->max_price != 100000) {
            $filters['max_price'] = request()->max_price;
        }

        $filter_values = [];
        $filter_attributes = [];

        foreach (request()->all() as $key => $value) {
            if(str_contains($key,'attribute_')){
                $key = explode('attribute_',$key)[1];
                $filters[$key] = $value;
                $filter_attributes[] = $key;
                foreach ($value as $value_) {
                    $filter_values[] = $value_;
                }
            }
        }

        $filters['filter_attributes'] = count($filter_attributes) ? Attribute::whereIn('slug',$filter_attributes)->get() : [];

        if (count($filters['filter_attributes'])){
            $filters['filter_attributes'] = $filters['filter_attributes']->unique('id')->keyBy('id');
        }

        $filters['filter_values'] = count($filter_values) ? AttributeValue::whereIn('id',$filter_values)->get() : [];
        if (count($filters['filter_values'])){
            $filters['filter_values'] = $filters['filter_values']->unique('id')->keyBy('id');
        }

        $filters['categories'] = [];


        if (count($this->category)){

            $category_ids = $this->category;

            $categories = cache()->remember('query_filter_categories_'.md5(implode(',',$category_ids)), 60, function () use ($category_ids) {
                return ItemCategory::with('children')->whereIn('id', $category_ids)->get();
            });

            $filters['categories'] = $categories->unique('id')->keyBy('id');

        }

        return view('components.active-filters',compact('filters'));
    }
}
