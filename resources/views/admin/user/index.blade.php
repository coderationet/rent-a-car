@extends('admin.layouts.general')
@section('content')

    <section class="content-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
            <li> ></li>
            <li class="breadcrumb-item active">{{__('admin/user.users')}}</li>
            <li> ></li>
            <li class="breadcrumb-item active">{{__('admin/user.add_user')}}</li>
        </ol>
    </section>
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
                    "url": "{{route('admin.users.data')}}",
                    "type": "GET",
                    "dataSrc": "data",
                    "dataType": "json",
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
