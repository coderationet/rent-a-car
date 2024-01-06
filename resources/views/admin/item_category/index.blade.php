@extends('admin.layouts.general')
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{__('admin/category.all_categories')}}</h3>
                                <a href="{{route('admin.item-categories.create')}}"
                                   class="btn btn-primary btn-xs float-right"><i
                                        class="fas fa-plus"></i> {{__('admin/general.add_new')}}</a>
                            </div>

                            <div class="card-body">
                                <table id="item_categories" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{__('admin/general.name')}}</th>
                                        <th>{{__('admin/general.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>                                  
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>>#ID</th>
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
@push('extra-footer')

    @include('admin.layouts.datatable-lang')
    @include('admin.layouts.datatable-files')

    <script type="module">
        $(function () {
            $('#item_categories').DataTable({
                "language": datatable_tr,
                "paging": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{route('admin.data-table.data')}}",
                    "type": "GET",
                    "dataSrc": "data",
                    "dataType": "json",
                    "data" : {
                        "table_name" : "item_categories",
                        "route_name_prefix" : "admin.item-categories"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "actions"},
                ],
                "order": [[0, "desc"]],
            });
        });
    </script>
@endpush

