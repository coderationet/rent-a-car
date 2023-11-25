<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Address Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your billing and payment address information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Personal and Billing Information -->

       <div class="addresses personal">
           <div>
               <x-input-label for="name" :value="__('Name')"/>
               <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                             required autofocus autocomplete="name"/>
               <x-input-error class="mt-2" :messages="$errors->get('name')"/>
           </div>

           <div class="mt-6">
               <x-input-label for="email" :value="__('Email')"/>
               <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                             :value="old('email', $user->email)" required autocomplete="username"/>
               <x-input-error class="mt-2" :messages="$errors->get('email')"/>

               @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                   <div>
                       <p class="text-sm mt-2 text-gray-800">
                           {{ __('Your email address is unverified.') }}

                           <button form="send-verification"
                                   class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                               {{ __('Click here to re-send the verification email.') }}
                           </button>
                       </p>

                       @if (session('status') === 'verification-link-sent')
                           <p class="mt-2 font-medium text-sm text-green-600">
                               {{ __('A new verification link has been sent to your email address.') }}
                           </p>
                       @endif
                   </div>
               @endif
           </div>
           <!-- Ülke -->
           <div class="mt-6">
               <label for="country" class="block text-sm font-medium text-gray-700">
                   Country
               </label>
               <div class="mt-1">
                   <select id="country" name="country" autocomplete="country"
                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">
                       <option value="TR" {{ old('country', $user->country) === 'TR' ? 'selected' : '' }}>Turkey</option>
                       {{--                    <option value="US" {{ old('country', $user->country) === 'US' ? 'selected' : '' }}>United States</option>--}}
                       {{--                    <option value="GB" {{ old('country', $user->country) === 'GB' ? 'selected' : '' }}>United Kingdom</option>--}}
                       {{--                    <option value="DE" {{ old('country', $user->country) === 'DE' ? 'selected' : '' }}>Germany</option>--}}
                       {{--                    <option value="SE" {{ old('country', $user->country) === 'SE' ? 'selected' : '' }}>Sweden</option>--}}
                       {{--                    <option value="KE" {{ old('country', $user->country) === 'KE' ? 'selected' : '' }}>Kenya</option>--}}
                       {{--                    <option value="BR" {{ old('country', $user->country) === 'BR' ? 'selected' : '' }}>Brazil</option>--}}
                       {{--                    <option value="ZW" {{ old('country', $user->country) === 'ZW' ? 'selected' : '' }}>Zimbabwe</option>--}}
                   </select>
               </div>
           </div>
           <!-- Şehir -->
           <div class="mt-6">
               <label for="city" class="block text-sm font-medium text-gray-700">
                   City
               </label>
               <div class="mt-1">
                   <input type="text" name="city" id="city" autocomplete="city"
                          value="{{ old('city', $user->city) }}"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">
               </div>
           </div>
           <!-- Posta Kodu -->
           <div class="mt-6">
               <label for="postal_code" class="block text-sm font-medium text-gray-700">
                   Postal Code
               </label>
               <div class="mt-1">
                   <input type="text" name="postal_code" id="postal_code" autocomplete="postal_code"
                          value="{{ old('postal_code', $user->postal_code) }}"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">
               </div>

           </div>
           <div class="mt-6">

               <!-- address -->
               <label for="address" class="block text-sm font-medium text-gray-700">
                   Address
               </label>
               <div class="mt-1">
                <textarea id="address" name="address" rows="3"
                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('address', $user->address) }}</textarea>
               </div>
           </div>
       </div>

        <div class="addresses company">

            <div class="mt-6">
                <x-input-label for="company_name" :value="__('Company Name (Optional)')"/>
                <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', $user->company_name)"
                              required autofocus autocomplete="company_name"/>
                <x-input-error class="mt-2" :messages="$errors->get('company_name')"/>
            </div>

            <div class="mt-6">
                <x-input-label for="tax_number" :value="__('Tax Number (Optional)')"/>
                <x-text-input id="tax_number" name="tax_number" type="text" class="mt-1 block w-full" :value="old('tax_number', $user->tax_number)"
                              required autofocus autocomplete="tax_number"/>
                <x-input-error class="mt-2" :messages="$errors->get('tax_number')"/>
            </div>

            <div class="mt-6">
                <x-input-label for="tax_office" :value="__('Tax Office (Optional)')"/>
                <x-text-input id="tax_office" name="tax_office" type="text" class="mt-1 block w-full" :value="old('tax_office', $user->tax_office)"
                              required autofocus autocomplete="tax_office"/>
                <x-input-error class="mt-2" :messages="$errors->get('tax_office')"/>
            </div>

        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
