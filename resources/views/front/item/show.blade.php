@extends('layouts.app')
@section('title', $item->title)
@section('content')
    @include('breadcrumbs', ['breadcrumbs' => [
        [
            'name' => __('front/general.home'),
            'url' => route('home')
        ],
        [
            'name' => $item->title,
            'url' => route('front.item.show', $item->slug)
        ]
    ]])
    <div class="container item-page">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title m-0">
                            {{ $item->title}}
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Slider main container -->
                        <div class="swiper item-slider">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                @foreach([$item->thumbnail, ...$item->gallery] as $image)
                                    <div class="swiper-slide text-center">
                                        <img src="{{ asset('storage/media/' . $image->name ) }}" loading="lazy" alt="{{ $item->title }}" class="slider-image">
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
                    <div class="card-footer fs-5 p-4">
                        {!! $item->description !!}
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            {{ __('front/item-informations.title') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table-bordered w-100 ">
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
            <div class="col-md-3">
                @include('front.item.contact-informations')
                @include('front.item.appointment-form',['item' => $item])
            </div>
        </div>
    </div>
@endsection
