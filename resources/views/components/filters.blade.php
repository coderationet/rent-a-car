<div>
    <form enctype="multipart/form-data" method="get" id="filter-form" action="{{route('front.search.index')}}">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseCount" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseCount">
                        {{__('front/category.results')}}
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseCount" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        {{$items->total()}} {{__('front/category.results_found')}}
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapsePrice" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapsePrice">
                        {{__('front/category.price_range')}}
                    </button>
                </h2>
                <div id="panelsStayOpen-collapsePrice" class="accordion-collapse collapse show">
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
                    <h2 class="accordion-header" id="panelsStayOpen-heading{{$attribute->id}}">
                        <button class="accordion-button {{$attribute->is_open ? '' : 'collapsed'}}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$attribute->id}}"
                                aria-expanded="{{$attribute->is_open ? 'true' : 'false'}}"
                                aria-controls="panelsStayOpen-collapse{{$attribute->id}}">
                            {{$attribute->name}}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse{{$attribute->id}}"
                         class="accordion-collapse collapse {{$attribute->is_open ? 'show' : ''}}"
                         aria-labelledby="panelsStayOpen-heading{{$attribute->id}}">
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
            <div class="accordion-item p-3">
                <button type="button" class="btn btn-primary w-100"
                        id="filter-form-submit">{{__('front/category.filter')}}</button>
            </div>
        </div>
    </form>
</div>
