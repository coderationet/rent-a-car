@extends('admin.layouts.general')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kullanıcılar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Kullanıcılar</li>
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
                                <h3 class="card-title">Tüm Kullanıcılar</h3>
                                <a href="{{route('admin.users.create')}}" class="btn btn-success btn-xs float-right">Yeni
                                    Kullanıcı Ekle</a>
                            </div>
                            <div class="card-body">
                                <table id="users" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Kullanıcı ID</th>
                                        <th>Kullanıcı Adı</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Kullanıcı ID</th>
                                        <th>Kullanıcı Adı</th>
                                        <th>İşlemler</th>
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
            $('#users').DataTable({
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
                        "table_name": "users"
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "actions"},
                ],
            });
        });
    </script>
@endpush
