@extends('layouts.app')
@section('title', $page->name)
@section('content')
    @include('breadcrumbs',['breadcrumbs' => [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => __('front/menu.contact'), 'url' => route('front.page.contact')]
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
                            <form action="{{route('front.page.contact.post')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('admin.form._input',[
                                    'input_name' => 'name',
                                    'title' => __('admin/general.name'),
                                    'placeholder' => __('admin/general.name'),
                                    'item' => null,
                                    'classes' => 'mb-3',
                                    'required' => true,
                                    'value' => old('name')
                                ])
                                @include('admin.form._input',[
                                    'input_name' => 'email',
                                    'title' => __('admin/general.email'),
                                    'placeholder' => __('admin/general.email'),
                                    'item' => null,
                                    'classes' => 'mb-3',
                                    'required' => true,
                                    'value' => old('email')
                                ])
                                <!-- message select -->
                                <div class="form-group">
                                    <label for="message">{{__('front/general.message')}}</label>
                                    <textarea name="message" required id="message" class="form-control" style="min-height: 200px">{{old('message')}}</textarea>
                                </div>
                                <!-- submit -->
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">{{__('front/general.send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
