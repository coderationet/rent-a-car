<?php

namespace App\View\Components;

use App\Models\Attribute;
use App\Models\AttributeValue;
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

        $filters['filter_attributes'] = Attribute::whereIn('slug',$filter_attributes)->get();
        $filters['filter_attributes'] = $filters['filter_attributes']->unique('id')->keyBy('id');

        $filters['filter_values'] = AttributeValue::whereIn('id',$filter_values)->get();
        $filters['filter_values'] = $filters['filter_values']->unique('id')->keyBy('id');

        $category = $this->category;

        return view('components.active-filters',compact('filters','category'));
    }
}
