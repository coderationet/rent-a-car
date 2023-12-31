@extends('front.layouts.app')
@section('title', $title)
@section('content')
    <div class="container driver-info-page page mx-auto flex flex-col md:flex-row gap-5 mb-5">
        <form action="{{route('front.appointment.driver_info_store')}}" method="post" id="driver-info-form"
              class="validated-form md:mt-5 flex flex-col gap-5  w-full md:w-2/3">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h2 class="text-2xl flex justify-start items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                        Driver Info
                    </h2>
                </div>
                <div class="card-body">
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                    <input type="hidden" name="start_date" value="{{$start_date}}">
                    <input type="hidden" name="end_date" value="{{$end_date}}">
                    <div>
                        <div class="flex gap-3 flex-col md:flex-row">
                            <!-- email -->
                            <div class="w-full md:w-1/2 flex flex-col">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" id="email"
                                       required
                                       placeholder="Email">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- phone -->
                            <div class="w-full md:w-1/2 flex flex-col">
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
                    <div class="flex gap-3 flex-col md:flex-row">
                        <!-- first name -->
                        <div class="w-full md:w-1/2 flex flex-col">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" id="first_name"
                                   required
                                   placeholder="First Name">
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- last name -->
                        <div class="w-full md:w-1/2 flex flex-col">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" id="last_name"
                                   required
                                   placeholder="Last Name">
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-3 flex-col md:flex-row">
                        <div class="w-full md:w-1/2 flex flex-col">
                            <label for="day_of_birth">Day of birth</label>
                            <input type="date" name="day_of_birth" id="day_of_birth"
                                   required
                                   value="{{ old('day_of_birth') ? old('day_of_birth') : '' }}"
                                   placeholder="Day of birth">
                            @error('day_of_birth')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- identity number -->
                        <div class="w-full md:w-1/2 flex flex-col">
                            <label for="identity_number">Identity Number</label>
                            <input type="text" name="identity_number" value="{{ old('identity_number') }}"
                                   id="identity_number"
                                   required
                                   placeholder="Identity Number">
                            @error('identity_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- Payment Options Credit Cart/Debit Cart or Bank Transfer -->
                    <div class="flex gap-3 flex-col md:flex-row w-full">
                        <div class="w-full md:w-full flex flex-col">
                            <label for="payment_option">Payment Option</label>
                            <select name="payment_option" id="payment_option" class="w-full" required>
{{--                                <option value="">Select Payment Option</option>--}}
{{--                                <option value="credit_card" {{old('payment_option') && old('payment_option') == 'credit_card' ? 'selected' : ''}}>Credit Card</option>--}}
                                <option value="bank_transfer" {{old('payment_option') && old('payment_option') == 'bank_transfer' ? 'selected' : ''}} selected>Bank Transfer</option>
                            </select>
                            @error('payment_option')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="w-full md:w-1/2 flex flex-col justify-center items-end">
                        <!-- total price span -->
                        <span class="text-2xl font-bold">Total Price: <span
                                class="text-blue-500">{{ number_format($total_price,'2',',') }}$</span></span>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col justify-end items-end">
                        <button type="submit"
                                class="border rounded bg-blue-500 text-white w-full p-3 hover:bg-blue-400">Book Now
                        </button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-xl flex justify-start items-center gap-2 cursor-pointer open-billing-area">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                        </svg>
                        Billing Information
                        (Optional)
                        <input type="hidden" name="enable_billing" class="enable_billing" value="{{old('enable_billing') ? old('enable_billing')  : '0'}}" >
                    </div>
                    <div class="flex justify-start items-center gap-3 {{old('enable_billing') ? ''  : 'hidden'}}  billing-type-area">
                        <label>Billing Type</label>
                        <!-- radio -->
                        <input type="radio" checked value="individual" name="billing_type" {{old('billing_type') && old('billing_type') == 'individual' ? 'checked' : '' }} class="billing-type-radio-button" id="individual-billing-type">
                        <label>Individual</label>
                        <input type="radio" value="company" name="billing_type" {{old('billing_type') && old('billing_type') == 'company' ? 'checked' : ''}} class="billing-type-radio-button" id="company-billing-type">
                        <label>Company</label>
                    </div>
                    <div class="billing-tab individual-billing {{old('billing_type') && old('billing_type') == 'individual' ? '' : 'hidden'}} flex flex-col gap-3">
                        <!-- country, city, district -->
                        <div class="flex gap-3 flex-col md:flex-row">
                            <!-- country -->
                            <div class="w-full md:w-1/3 flex flex-col">
                                <label for="billing_country">Country</label>
                                <input type="text" name="individual_billing_country" value="{{ old('individual_billing_country') }}"
                                       id="billing_country"
                                       placeholder="Country">
                                @error('individual_billing_country')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- city -->
                            <div class="w-full md:w-1/3 flex flex-col">
                                <label for="billing_city">City</label>
                                <input type="text" name="individual_billing_city" value="{{ old('individual_billing_city') }}"
                                       id="billing_city"
                                       placeholder="City">
                                @error('individual_billing_city')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- district -->
                            <div class="w-full md:w-1/3 flex flex-col">
                                <label for="billing_district">District</label>
                                <input type="text" name="individual_billing_district" value="{{ old('individual_billing_district') }}"
                                       id="billing_district"
                                       placeholder="District">
                                @error('individual_billing_district')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- address -->
                        <div class="flex gap-3 flex-col md:flex-row">
                            <div class="w-full flex flex-col ">
                                <label for="billing_address">Address</label>
                                <textarea name="individual_billing_address" id="individual_billing_address" cols="30" rows="5"
                                          placeholder="Address">{{ old('individual_billing_address') }}</textarea>
                                @error('individual_billing_address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="billing-tab company-billing {{old('billing_type') && old('billing_type') == 'company' ? '' : 'hidden'}} flex flex-col gap-3">
                        <!-- company name -->
                        <div class="flex gap-3 flex-col md:flex-row">
                            <div class="w-full flex flex-col ">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}"
                                       id="company_name"
                                       placeholder="Company Name">
                                @error('company_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- tax number -->
                        <div class="flex gap-3 flex-col md:flex-row">
                            <div class="w-full flex flex-col ">
                                <label for="tax_number">Tax Number</label>
                                <input type="text" name="tax_number" value="{{ old('tax_number') }}"
                                       id="tax_number"
                                       placeholder="Tax Number">
                                @error('tax_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- country, city, district -->
                        <div class="flex gap-3 flex-col md:flex-row">
                            <!-- country -->
                            <div class="w-full md:w-1/3 flex flex-col">
                                <label for="company_billing_country">Country</label>
                                <input type="text" name="company_billing_country" value="{{ old('company_billing_country') }}"
                                       id="company_billing_country"
                                       placeholder="Country">
                                @error('company_billing_country')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- city -->
                            <div class="w-full md:w-1/3 flex flex-col">
                                <label for="company_billing_city">City</label>
                                <input type="text" name="company_billing_city" value="{{ old('company_billing_city') }}"
                                       id="billing_city"
                                       placeholder="City">
                                @error('company_billing_city')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- district -->
                            <div class="w-full md:w-1/3 flex flex-col">
                                <label for="billing_district">District</label>
                                <input type="text" name="company_billing_district" value="{{ old('company_billing_district') }}"
                                       id="company_billing_district"
                                       placeholder="District">
                                @error('company_billing_district')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="w-full md:w-1/3 mt-5 ">
            <div class="card">
                <h2 class="text-2xl">Summary</h2>
                @include('front.appointment.partials.summary',['item' => $item,'days' => $days,'start_date' => $start_date,'end_date' => $end_date])
            </div>
        </div>
    </div>

@endsection
