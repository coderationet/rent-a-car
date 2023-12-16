<div class="primary-bg">
    <div class="container flex justify-between items-center text-white text-sm">
        <div class="flex-1 flex justify-start items-center">
            <ul class="flex flex-row items-center justify-center gap-7">
                <li class="flex justify-center items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0l-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 00-.38 1.21 12.035 12.035 0 007.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 011.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 01-2.25 2.25h-2.25z"/>
                    </svg>
                    <a href="tel:+905555555555">+905555555555</a>
                </li>
                <li class="flex justify-center items-center gap-1">
                    <img src="{{ asset('assets/img/icons8-whatsapp-24.png') }}" class="w-4 h-4"/>
                    <a href="https://wa.me/+905555555555">+905555555555</a>
                </li>

            </ul>
        </div>
        <div class="hide md:flex justify-end items-center p-2 bg-primary text-white gap-2 flex-1">

            <a href="{{route('front.home')}}">{{__('front/menu.my_reservation')}}</a>

            {{--            <span>Dil : </span>--}}
            {{--            <a class="hover-primary border hover:border-white hover:bg-white cursor-pointer p-1 py-0.5"--}}
            {{--               href="">TR</a>--}}
            {{--            <a class="hover-primary border hover:border-white hover:bg-white cursor-pointer p-1 py-0.5"--}}
            {{--               href="">EN</a>--}}
            {{--            <a class="hover-primary border hover:border-white hover:bg-white cursor-pointer p-1 py-0.5"--}}
            {{--               href="">RU</a>--}}
        </div>
    </div>
</div>
<div class="shadow z-10 header-container">
    <div class="container flex justify-between items-center header">
        <div class="flex-1">
            <a href="{{route('front.home')}}">
                <h1 class="logo border w-max p-3 cursor-pointer">
                    NICE CARS
                </h1>
            </a>
        </div>
        <nav class="flex-1 ">
            <ul class="flex gap-7 justify-center items-center ">
                <li>
                    <a href="{{ route('front.search.index') }}" class="font-bold hover-primary">{{__('front/menu.all_vehicles')}}</a>
                </li>
                <li>
                    <a href="{{ route('front.page.show','about') }}" class="font-bold hover-primary">{{__('front/menu.about_us')}}</a>
                </li>
                <li>
                    <a href="{{ route('front.page.contact') }}" class="font-bold hover-primary">{{__('front/menu.contact')}}</a>
                </li>
            </ul>
        </nav>
        <div class="font-bold flex-1 flex justify-end items-center  gap-3">
            <!-- Admin Panel if user is admin role -->
            @role('admin')
                <a class="hover-primary  flex gap-2 justify-center items-center"
                   href="{{ route('admin.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                    </svg>

                    {{__('front/menu.admin_panel')}}</a>
            @endrole
            @if(auth()->check())
                <a class="hover-primary  flex gap-2 justify-center items-center"
                   href="{{ route('profile.edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{__('front/menu.account')}}</a>
                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="hover-primary  flex gap-2 justify-center items-center" id="logout-form">
                    @csrf
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         onclick="document.getElementById('logout-form').submit()" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                    <button type="submit" class="hover-primary  flex gap-2 justify-center items-center">
                        {{__('front/menu.logout')}}
                    </button>
                </form>
            @else
                <a class="hover-primary  flex gap-2 justify-center items-center"
                   href="{{route('login')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                    {{__('front/menu.login')}}</a>
                <a class="hover-primary  flex gap-2 justify-center items-center"
                   href="{{ route('register') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/>
                    </svg>
                    {{__('front/menu.register')}}</a>
            @endif
        </div>
    </div>
</div>
