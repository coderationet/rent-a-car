@if(count($filters['filter_values']) || count($filters['categories']))
    <div class="bg-white rounded p-3 border mb-3 active-filters">
        <div class="item bg-white">
            <div class="row">
                <div
                    data-show-more-text="{{__('front/general.show_more')}}"
                    class="flex flex-wrap gap-3 filter-items">
                    @foreach($filters['filter_values'] as $filter)
                        <div class="flex rounded border filter-item ">
                            <button type="button"
                                    class="p-2">{{$filter['value'] }}</button>
                            <button type="button" class="border-l p-2 hover:bg-gray-300 remove-filter"
                                    data-url="{{route('front.search.remove_filter_from_url')}}"
                                    data-attribute-value-id="{{$filter['id']}}">
                                @include('icons.trash', ['class' => 'w-4 h-4'])
                            </button>
                        </div>
                    @endforeach
                    @foreach($filters['categories'] as $category)

                        <div class="flex rounded border filter-item ">
                            <button type="button"
                                    class="p-2">{{$category['name'] }}</button>
                            <button type="button" class="border-l p-2 hover:bg-gray-300 remove-filter"
                                    data-url="{{route('front.search.remove_filter_from_url')}}"
                                    data-attribute-value-id="{{$category['id']}}">
                                @include('icons.trash', ['class' => 'w-4 h-4'])
                            </button>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
