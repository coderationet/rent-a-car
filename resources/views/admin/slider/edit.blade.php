@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('admin/slider.slider')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/slider.add_new_slider')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form enctype="multipart/form-data"
                              action="{{isset($slider) ? route('admin.sliders.update', $slider->id) : route('admin.sliders.store')}}"
                              method="post">
                            @csrf
                            @if(isset($slider))
                                @method('PUT')
                            @endif
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('admin/slider.add_new_slider')}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">{{__('admin/general.name')}}</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="{{__('admin/general.name')}}"
                                               value="{{isset($slider) ? $slider->name : ''}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        {{isset($slider) ? __('admin/general.update') : __('admin/general.add_new')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('admin.sliders.update', $slider->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="update_items" value="yes">
                            <div class="card card-primary">
                                <div class="card-header ">
                                    <h3 class="card-title">
                                        {{__('admin/slider.slider_items')}}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table id="slider_items" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{__('admin/general.image_desktop')}}</th>
                                            <th>{{__('admin/general.image_mobile')}}</th>
                                            <th>{{__('admin/general.details')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="sortable">
                                        @if(isset($slider))
                                            @if($slider->sliderImages()->count() == 0)
                                                <tr>
                                                    <td colspan="4" style="text-align: center" class="no-records">
                                                        <b>{{__('admin/general.no_record_found')}}</b>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach($slider->sliderImages as $sliderImage)
                                                    @include('admin.slider._item_value_row', ['item' => $sliderImage,'slider_item_index' => $sliderImage->order])
                                                @endforeach
                                            @endif
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary float-right mr-3">
                                        {{__('admin/general.update')}}
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-primary float-right mr-3 add-new-slider-item">
                                        {{__('admin/slider.add_new_slider_item')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('extra-footer')
    <style>
        .slider-item-row .gc-library-preview-container img {
            max-height: 200px;
            max-width: 200px;
        }

        .ui-state-highlight {
            height: 200px;
            line-height: 1.2em;
        }
    </style>
    @include('admin.media_library.form-dialog-includes')
    <script>
        $(function () {
            $('.sortable').sortable({
                placeholder: "ui-state-highlight"
            });
            var slider_item_index = @if(isset($slider)){{$slider->sliderImages()->count()}}@else 0 @endif;
            $('.add-new-slider-item').click(function () {
                $.get("{{route('admin.sliders.slider_item_row_html')}}?slider_item_index=" + slider_item_index, function (data) {
                    $('#slider_items tbody').append(data);
                    $('.no-records').remove();
                    gc_media_library();
                    slider_item_index++;
                })
            })
        });
    </script>
@endpush
