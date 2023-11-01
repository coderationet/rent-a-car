@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>İletişim</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__("admin")}}</a></li>
                        <li class="breadcrumb-item active">{{__("admin/contact.contacts")}}</li>
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
                            <h3 class="card-title">{{__("admin/contact.all_messages")}}</h3>
                        </div>
                        <div class="card-body">
                            <table id="messages" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{__('admin/general.name')}}</th>
                                    <th> {{__('admin/contact.message')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{__('admin/general.name')}}</th>
                                    <th> {{__('admin/contact.message')}}</th>
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
        $(function (){
            $('#messages').DataTable({
                "language" : datatable_tr,
                "paging": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{route('admin.contacts.data')}}",
                    "type": "GET",
                    "dataSrc": "data",
                    "dataType": "json",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "actions" },
                ],
                "order": [[ 0, "desc" ]],
            });
        });
    </script>
@endpush
