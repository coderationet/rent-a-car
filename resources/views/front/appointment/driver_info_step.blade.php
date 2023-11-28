@extends('front.layouts.app')
@section('title', $title)
@section('content')
    <div class="container driver-info-page page mx-auto flex gap-5">
        <form action="{{route('front.appointment.driver_info_store')}}" method="post" class="w-2/3 bg-white mt-5 border shadow p-5 flex flex-col gap-5 rounded">
            @csrf
            <input type="hidden" name="item_id" value="{{$item->id}}">
            <input type="hidden" name="start_date" value="{{$start_date}}">
            <input type="hidden" name="end_date" value="{{$end_date}}">
            <h2 class="text-2xl flex justify-start items-center text-lg gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg> Driver Info</h2>
            <div>
                <div class="flex gap-3">
                    <!-- email -->
                    <div class="w-full md:w-1/2 flex flex-col gap-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" id="email"
                               required
                               placeholder="Email">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- phone -->
                    <div class="w-full md:w-1/2 flex flex-col gap-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" id="phone"
                               required
                               placeholder="Phone">
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <small>
                    We will send you the booking details on this email address and phone number for free.
                </small>
            </div>
            <div class="flex gap-3">
                <!-- first name -->
                <div class="w-full md:w-1/2 flex flex-col gap-3">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" id="first_name"
                           required
                           placeholder="First Name">
                    @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- last name -->
                <div class="w-full md:w-1/2 flex flex-col gap-3">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" id="last_name"
                           placeholder="Last Name">
                    @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-full md:w-1/2 flex flex-col gap-3">
                    <label for="day_of_birth">Day of birth</label>
                    <input type="date" name="day_of_birth" id="day_of_birth"
                           required
                           value="{{ old('day_of_birth') ? old('day_of_birth') : date('1990-01-01') }}"
                           placeholder="Day of birth">
                    @error('day_of_birth')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- identity number -->
                <div class="w-full md:w-1/2 flex flex-col gap-3">
                    <label for="identity_number">Identity Number</label>
                    <input type="text" name="identity_number" value="{{ old('identity_number') }}" id="identity_number"
                           required
                           placeholder="Identity Number">
                    @error('identity_number')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-full md:w-1/2 flex flex-col gap-3 justify-center items-end">
                    <!-- total price span -->
                    <span class="text-2xl font-bold">Total Price: <span
                            class="text-blue-500">{{ number_format($total_price,'2',',') }}$</span></span>
                </div>
                <div class="w-full md:w-1/2 flex flex-col gap-3 justify-end items-end">
                    <button type="submit" class="border rounded bg-blue-500 text-white w-full p-3 hover:bg-blue-400">Book Now</button>
                </div>
            </div>
        </form>
        <div class="w-1/3 mt-5 ">
            <div class="bg-white border shadow p-5 rounded">
                <h2 class="text-2xl">Summary</h2>
                @include('front.appointment.partials.summary',['item' => $item,'days' => $days,'start_date' => $start_date,'end_date' => $end_date])
            </div>
        </div>
    </div>

@endsection
