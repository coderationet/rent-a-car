@extends('front.layouts.app',[
    'title' => isset($title) ? $title : null,
])
@section('content')
    @include('front.breadcrumbs', ['breadcrumbs' => [
        [
            'name' => __('front/general.home'),
            'url' => route('front.home')
        ],
        [
            'name' => __('admin/general.search'),
            'url' => route('front.search.index')
        ]
    ]])
    <div class="container category-page page">
        <div class="flex gap-5">
            <div class="w-1/4 mb-3 filters-sidebar hidden md:block">
                <x-filters :items="$items" :categoryids="isset($category) ? $category : null"/>
            </div>
            <div class="w-full md:w-3/4">
                <x-active-filters :category="$category"/>
                <div class="flex flex-col">
                    @foreach($items as $item)
                        <div class="rounded bg-white p-3 border mb-5">
                            <div class="flex gap-3">
                                <div class="w-1/3">
                                    <a href="{{route('front.item.show',$item->slug) . $date_string}}">
                                        <img
                                            src="{{route('front.image.show.mode',['image_id' => $item->thumbnail->id,'size' => 'small','mode' => 'stretch'])}}"
                                            alt=""
                                            loading="lazy"
                                            class="w-full">
                                    </a>
                                </div>
                                <div class="w-2/3">
                                    <div class="111">
                                        <div>
                                            <a href="{{route('front.item.show',$item->slug)}}"
                                               class="text-decoration-none text-black">
                                                <h2 class="text-xl">{{$item->title}}</h2>
                                            </a>
                                            <p class="text-gray fs-12">{{$item->attributeValues[0]->value}}</p>
                                            <div class="d-flex gap-1">
                                                @foreach($item->categories as $category)
                                                    <span class="badge bg-primary">{{$category->name}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="peoppe">
                                                <i class="fas fa-user"></i> {{$item->attributeValues[1]->value}}
                                            </p>
                                            <p class="price">
                                                {{number_format($item->price,2,',','.')}} ₺
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($items->hasPages())
                        <div class="">
                            {{$items->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
