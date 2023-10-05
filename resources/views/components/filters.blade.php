<div>
    <form enctype="multipart/form-data" method="get" id="filter-form" action="{{route('front.search.index')}}">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button">
                        {{__('front/category.results')}}
                    </button>
                </h2>
                <div class="accordion-collapse show">
                    <div class="accordion-body">
                        {{$items->total()}} {{__('front/category.results_found')}}
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button">
                        {{__('admin/category.categories')}}
                    </button>
                </h2>
                <div class="accordion-collapse show">
                    <div class="accordion-body">
                        {!! \App\Helpers\HierarchicalListingHelper::get_listing_html($categories,$selected_categories,'category[]','slug') !!}
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button">
                        {{__('front/category.price_range')}}
                    </button>
                </h2>
                <div class="accordion-collapse show">
                    <div class="accordion-body price-range">
                        <div class="show-price-range">
                            <input class="form-control" type="text" id="min_price" name="min_price"
                                   value="{{request()->has('min_price') ? request()->get('min_price') : $min_price}}"
                                   readonly>
                            <input class="form-control" type="text" id="max_price" name="max_price"
                                   value="{{request()->has('max_price') ? request()->get('max_price') : $max_price}}"
                                   readonly>
                        </div>
                        <div id="price-range" class="slider"></div>
                    </div>
                </div>
            </div>
            @foreach($attribute_list as $attribute)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button"   type="button">
                            {{$attribute->name}}
                        </button>
                    </h2>
                    <div class="accordion-collapse {{$attribute->is_open ? 'show' : ''}}">
                        <div class="accordion-body">
                            <ul class="list-group">
                                @foreach($attribute->values as $attribute_value)
                                    <li class="list-group-item">
                                        <input type="checkbox" name="attribute_{{$attribute->slug}}[]"
                                               @if(request()->has('attribute_'.$attribute->slug) && in_array($attribute_value->id,request('attribute_'.$attribute->slug)))
                                                   checked
                                               @endif
                                               value="{{$attribute_value->id}}"> {{$attribute_value->value}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="bg-blue-500 p-2 text-white w-full hover:bg-blue-600"
                    id="filter-form-submit">{{__('front/category.filter')}}</button>
        </div>
    </form>
</div>
