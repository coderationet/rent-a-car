@extends('front.layouts.app')
@section('title', $page->name)
@section('content')
    @include('front.breadcrumbs',['breadcrumbs' => [
        ['name' => 'Home', 'url' => route('front.home')],
        ['name' => $page->name, 'url' => route('front.page.show', $page->slug)]
    ]])
    <div class="container page flex gap-5">
        <div class="w-1/4 bg-white p-3 rounded h-max">
            <x-page-sidebar :page="$page"/>
        </div>
        <div class="w-3/4 bg-white p-3">
            <h1 class="text-2xl">{{$page->name}}</h1>
            <div class="mb-3">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
