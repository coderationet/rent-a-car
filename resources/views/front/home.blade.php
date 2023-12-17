@extends('front.layouts.app')
@section('content')
    <div class="home-search-bg z-0  flex flex-col justify-center items-center">
        <form data-validate-url="{{route('front.validate-home-search')}}" action="{{route('front.search.index')}}" class="w-3/4 md:w-1/3 flex justify-center flex-col items-center mt-3 md:mt-0" id="home-search-form">
            <div class="flex flex-col justify-center items-end gap-3 md:gap-0 md:flex-row w-full">
                <div class="flex-1 flex flex-col w-full md:w-max">
                    <label for="start_date" class="text-gray-600">{{__('front/home.start')}}</label>
                    <input type="date"
                           id="start_date"
                           name="start_date"
                           class="border-0 border-r p-3 px-4"
                           value="{{request()->has('date-start') ? request()->get('date-start') : ''}}"
                           placeholder="Başlangıç Tarihi">
                </div>
                <div class="flex-1 flex flex-col w-full md:w-max">
                    <label for="end_date" class="text-gray-600">{{__('front/home.end')}}</label>
                    <input type="date" name="end_date" class="border-0 border-r p-3 px-4 "
                           value="{{request()->has('date-end') ? request()->get('date-end') : ''}}"
                           placeholder="Bitiş Tarihi">
                </div>
                <div class="flex-1 flex flex-col w-full md:w-max">
                    <label for="category" class="text-gray-600">{{__('front/home.category')}}</label>
                    <select name="category[]"
                            class="border-0 border-r p-3 px-4">
                        <option value="">{{__('front/home.all')}}</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-2 flex flex-col justify-end align-bottom w-full md:w-max">
                    <button type="submit" class="bg-white p-3 px-4 primary-bg text-white w-full md:w-max home-search-button">{{__('front/home.search')}}</button>
                </div>
            </div>
            <div class="w-full">
                <div class="home-search-errors w-full">

                </div>
                <p class="text-white text-center mt-3">
                     {{__('front/home.search_description')}}
                </p>
            </div>

        </form>

    </div>
    <x-container class="flex flex-col justify-center items-center mt-7">
        <h1 class="text-2xl font-bold">
            {{__('front/home.categories')}}
        </h1>
        <p class="text-gray-400">
            {{__('front/home.vehicle_categories')}}
        </p>
    </x-container>
    <x-container class="flex flex-col md:flex-row justify-between mt-4 gap-7">
        @foreach($categories as $category)
            <a href="{{ route('front.search.category',$category->slug)}}" class="flex-1 shadow rounded overflow-hidden rounded overflow-hidden bg-white">
                <img src="{{ route('front.image.show',[$category->id,'large']) }}" class="w-full">
                <div class="p-3">
                    <h3 class="font-bold text-xl">{{$category->name}}</h3>
                    <p class="text-gray-500">{{$category->short_description}}</p>
                </div>
            </a>
        @endforeach
    </x-container>
    <div class="bg-gray-300 mt-7 py-7">
        <x-container class="flex flex-col justify-center items-center pb-7">
            <h3 class="font-bold text-2xl mb-7">
                {{__('front/home.vehicle_rental_service')}}
            </h3>
            <img src="{{asset('assets/img/2bd322322a29fbd968cd2845fc9f6ab9.jpg')}}" class="home-profile-picture">
            <p class="text-gray-600 mb-7 text-center text-sm mt-3">
                Gökhan ÇELEBİ
            </p>
            <p class="text-center">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            <p class="text-center mt-7">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
        </x-container>
    </div>
@endsection

