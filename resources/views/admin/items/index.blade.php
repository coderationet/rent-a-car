@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('admin/general.dashboard')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/item.items')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title pt-2">{{__('admin/item.items')}}</h3>
                                <a href="{{route('admin.items.create')}}" class="btn btn-primary float-right">{{__('admin/general.create_new')}}</a>
                            </div>
                            <div class="card-body">
                                <table id="items" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{__('admin/general.title')}}</th>
                                        <th>{{__('admin/general.description')}}</th>
                                        <th>{{__('admin/general.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tfoot>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{__('admin/general.title')}}</th>
                                        <th>{{__('admin/general.description')}}</th>
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
@section('extra-css')
    <link rel="stylesheet" href="{{asset('assets/admin')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
          href="{{asset('assets/admin')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

@endsection

@push('extra-footer')
    @include('admin.layouts.datatable-lang')
    @include('admin.layouts.datatable-files')
    @include('admin.layouts.datatable-config.product-items')
@endpush
