@extends('admin.layouts.app')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/blog.blog')}}</li>
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
                                <h3 class="card-title">{{__('admin/blog.all_blog_posts')}}</h3>
                                <a href="{{route('admin.blogs.create')}}" class="btn btn-success btn-xs float-right">{{__('admin/blog.new_blog_content')}}</a>
                            </div>
                            <div class="card-body">
                                <table id="blogs" class="table table-bordered table-hover">
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
            $('#blogs').DataTable({
                "language": datatable_tr,
                "paging": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{route('admin.blogs.data')}}",
                    "type": "GET",
                    "dataSrc": "data",
                    "dataType": "json",
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
