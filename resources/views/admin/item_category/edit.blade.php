@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('admin/category.categories')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin/category.categories')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('admin/category.create_new_category')}}</h3>
                        </div>
                        <form method="post"
                              enctype="multipart/form-data"
                              action="{{isset($item_category) ? route('admin.item-categories.update',$item_category->id) : route('admin.item-categories.store')}}">
                            @csrf
                            @if(isset($item_category))
                                @method('PUT')
                            @endif
                            <div class="card-body">
                                @include('admin.item_category._new_category_form')
                            </div>
                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-primary">{{isset($item_category) ? __('admin/general.update') : __('admin/general.add_new')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
@push('extra-footer')
    @include('admin.item_category._slug_generator_js',['item' => isset($item_category) ? $item_category : null])
    <script>

        $('.editor').summernote({
            height: 300,
            toolbar: [

            ]
        });
    </script>
@endpush
