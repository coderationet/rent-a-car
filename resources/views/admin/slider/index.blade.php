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
                            <li class="breadcrumb-item active">{{__('admin/slider.sliders')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{__('admin/slider.all_sliders')}}</h3>
                                @if(config('website.strict_slider') === false)
                                    <a href="{{route('admin.sliders.create')}}"
                                       class="btn btn-primary btn-xs float-right"><i
                                            class="fa fa-plus"></i> {{__('admin/slider.add_new_slider')}}</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{__('admin/general.name')}}</th>
                                        <th>{{__('admin/general.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($sliders) == 0)
                                        <tr>
                                            <td colspan="3" style="text-align: center">
                                                <b>{{__('admin/general.no_record_found')}}</b>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($sliders as $slider)

                                            <tr>
                                                <td>{{$slider->id}}</td>
                                                <td>{{$slider->name}}</td>
                                                <td>
                                                    @include('admin.block._default_actions',[
                                                       'item' => $slider,
                                                       'route_name' => 'sliders',
                                                       'strict_mode' => config('website.strict_slider')
                                                    ])
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{__('admin/general.name')}}</th>
                                        <th>{{__('admin/general.actions')}}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </section>

    </div>

@endsection

