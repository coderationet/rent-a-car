@if(count($filters['filter_values']))
    <div class="bg-white rounded p-3 border mb-3 active-filters">
        <div class="item bg-white">
            <div class="row">
                <div
                    data-show-more-text="{{__('front/general.show_more')}}"
                    class="d-flex gap-3 flex-wrap filter-items">
                    @foreach($filters['filter_values'] as $filter)
                        <div class="btn-group filter-item">
                            <button type="button"
                                    class="btn btn-sm btn-outline-secondary">{{ $filter['value'] }}</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary remove-filter"
                                    data-url="{{route('front.category.remove-filter')}}"
                                    data-category-slug="{{$category->slug}}"
                                    data-attribute-value-id="{{$filter['id']}}"><i
                                    class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
