@extends('front.layouts.app')
@section('title', $page->name)
@section('content')
    @include('front.breadcrumbs',['breadcrumbs' => [
        ['name' => 'Home', 'url' => route('front.home')],
        ['name' => __('front/menu.contact'), 'url' => route('front.page.contact')]
    ]])

    <div class="container page">
        <div class="flex flex-row gap-3">
            <div class="w-1/4 bg-white p-3 h-max">
                <x-page-sidebar :page="$page"/>
            </div>
            <div class="w-3/4 bg-white p-3">
                <h1 class="text-2xl mb-4">{{$page->name}}</h1>
                <div class="mb-3">
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{session()->get('error')}}
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    @endif
                    <form action="{{route('front.page.contact.post')}}" method="post" enctype="multipart/form-data" class="flex gap-5 flex-col">
                        @csrf
                        <!-- name -->
                        <div class="flex flex-col gap-3">
                            <label for="name">{{__('front/general.name')}}</label>
                            <input type="text" name="name" required id="name" class="form-control"
                                   value="{{old('name')}}">
                        </div>
                        <!-- message select -->
                        <div class="flex flex-col gap-3 ">
                            <label for="message">{{__('front/general.message')}}</label>
                            <textarea name="message" required id="message" class="form-control"
                                      style="min-height: 200px">{{old('message')}}</textarea>
                        </div>
                        <!-- submit -->
                        <div class="form-group mt-3">
                            <button type="submit"
                                    class="primary-bg hover:bg-blue-500 p-3 px-5 text-white rounded">{{__('front/general.send')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
