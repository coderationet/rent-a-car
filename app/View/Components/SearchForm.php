<?php

namespace App\View\Components;

use App\Models\AttributeValue;
use App\Models\ItemCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $location_values = AttributeValue::where('attribute_id', 2)->get();
        $location_values = $location_values->map(function($value){
            return [
                'id' => $value->id,
                'text' => $value->value
            ];
        });
        $categories = cache()->remember('all_categories', 60, function () {
            return ItemCategory::orderBy('name', 'asc')->get();
        });
        return view('components.search-form', compact('location_values','categories'));
    }
}
