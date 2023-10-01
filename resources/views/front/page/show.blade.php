@extends('layouts.app')
@section('title', $page->name)
@section('content')
    @include('breadcrumbs',['breadcrumbs' => [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => $page->name, 'url' => route('front.page.show', $page->slug)]
    ]])
    <div class="container page">
        <div class="row">
            <div class="col-md-3">
                <x-page-sidebar :page="$page"/>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <h1 class="mb-3">{{$page->name}}</h1>
                        <div class="mb-3">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
