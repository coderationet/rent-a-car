@extends('front.layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="p-6 md:py-12 md:p-0 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex gap-5 flex-col md:flex-row">
                <div class="w-full md:w-1/4">
                    <div class="bg-white shadow ">
                        <div class="max-w-xl">
                            @include('profile.partials.sidebar')
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-3/4">
                    <div class="bg-white shadow rounded">
                        <div class="max-w-xl">
                            <div class="p-6">
                                <h2 class="text-2xl font-semibold text-gray-800">Reservations</h2>
                            </div>
                        </div>
                    </div>
                    @foreach($reservations as $reservation)
                        <div class="bg-white shadow rounded p-6 mt-4">
                            <div class="flex flex-col gap-3">
                                <a href="{{route('front.item.show',$reservation->item->slug)}}" target="_blank">
                                    <h2 class="text-xl font-semibold text-gray-800">{{ $reservation->item->title }}</h2>
                                </a>
                                <div class="flex gap-5 flex-col md:flex-row">
                                    <img src="{{asset('storage/media/'.$reservation->item->thumbnail->name)}}" alt=""
                                         class="w-full md:w-1/4">
                                    <div>
                                        <p class="text-gray-800">Start Date : {{ $reservation->start_date->format('d/M/Y') }}</p>
                                        <p class="text-gray-800">End Date : {{ $reservation->end_date->format('d/M/Y') }}</p>
                                        <p class="text-gray-800">Price : {{ number_format($reservation->payment_amount,'2', '.',' ') }} {{$reservation->payment_currency}}</p>
                                        <p class="text-gray-800">Status : {{ strtoupper($reservation->status) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4">
                        {{$reservations->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
