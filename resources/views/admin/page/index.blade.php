@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sayfalar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/pages.pages')}}</li>
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
                                <h3 class="card-title">{{__('admin/pages.all_pages')}}</h3>
                                <a href="{{route('admin.pages.create')}}"
                                   class="btn btn-success btn-xs float-right">{{__('admin/general.add_new')}}</a>
                            </div>
                            <div class="card-body">
                                <table id="orders" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{__('admin/general.title')}}</th>
                                        <th>{{__('admin/general.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{__('admin/general.title')}}</th>
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
            $('#orders').DataTable({
                "language": datatable_tr,
                "paging": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{route('admin.pages.data')}}",
                    "type": "GET",
                    "dataSrc": "data",
                    "dataType": "json",
                    @if(request()->get('page_type'))
                    "data": {
                        "page_type": "{{request()->get('page_type')}}"
                    }
                    @endif
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
