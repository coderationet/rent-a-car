@extends('front.layouts.app')
@section('title', $item->title)
@section('content')
    @include('front.breadcrumbs', ['breadcrumbs' => [
        [
            'name' => __('front/general.home'),
            'url' => route('front.home')
        ],
        [
            'name' => $item->title,
            'url' => route('front.item.show', $item->slug)
        ]
    ]])
    <div class="container flex flex-col md:flex-row gap-3 item-page">
            <div class="w-full md:w-3/4 md:lex flex-col bg-white">
                <div class="card">
                    <div class="card-body">
                        <!-- Slider main container -->
                        <div class="swiper item-slider">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                @foreach([$item->thumbnail, ...$item->gallery] as $image)
                                    <div class="swiper-slide text-center">
                                        <img src="{{ route('front.image.show.mode',[$image->id,'big','fill']) }}" loading="lazy" alt="{{ $item->title }}" class="slider-image">
                                    </div>
                                @endforeach
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                            <!-- If we need scrollbar -->
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>
                    <div class="card-footer fs-5 p-3">
                        <h2 class="text-2xl mb-3">{{$item->title}}</h2>
                        {!! $item->description !!}
                    </div>
                </div>
                <div class="card p-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            {{ __('front/item-informations.title') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table-bordered w-100">
                            <thead>
                            <tr>
                                <th class="col-md-3 p-2">{{ __('front/item-informations.name') }}</th>
                                <th class="col-md-9 p-2">{{ __('front/item-informations.values') }}</th>
                            </tr>
                            <tbody >
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td class="col-md-3 p-2">{{ $attribute['name'] }}</td>
                                    <td class="col-md-9 p-2">{{ implode(',',collect($attribute['values'])->pluck('name')->toArray()) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/4   flex flex-col">
                @include('front.item.contact-informations')
                @include('front.item.appointment-form',['item' => $item])
            </div>
    </div>
@endsection
