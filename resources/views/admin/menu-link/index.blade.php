@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Markalar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/menu_links.links')}}</li>
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
                                <h3 class="card-title">{{__('admin/menu_links.all_links')}}</h3>
                                <a href="{{route('admin.menu-links.create')}}"
                                   class="btn btn-primary btn-xs float-right"><i
                                        class="fas fa-plus"></i> {{__('admin/menu_links.add_link')}}</a>
                            </div>

                            <div class="card-body">
                                <table id="brands" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{__('admin/general.title')}}</th>
                                        <th>{{__('admin/general.parent')}}</th>
                                        <th>{{__('admin/general.order')}}</th>
                                        <th>{{__('admin/general.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($links->count() == 0)
                                        <tr>
                                            <td colspan="4" class="text-center">{{__('admin/general.no_record_found')}}</td>
                                        </tr>
                                    @endif
                                    @foreach($links as $link)
                                        <tr>
                                            <td>{{$link->name}}</td>
                                            <td>{{$link->parent_name}}</td>
                                            <td>{{$link->order}}</td>
                                            <td class="d-flex">
                                                <a href="{{route('admin.menu-links.edit', $link->id)}}"
                                                   class="btn btn-xs btn-primary">
                                                    <i class="fas fa-edit"></i>  {{__('admin/general.edit')}}
                                                </a>
                                                <form method="post"
                                                      action="{{route('admin.menu-links.destroy',$link->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        onclick="return confirm('{{__('admin/general.are_you_sure_to_delete')}}')"
                                                        type="submit" class="btn ml-1 btn-xs btn-danger">
                                                        <i class="fas fa-trash"></i> {{__('admin/general.delete')}}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('admin/general.title')}}</th>
                                        <th>{{__('admin/general.parent')}}</th>
                                        <th>{{__('admin/general.order')}}</th>
                                        <th>{{__('admin/general.actions')}}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="pb-3 pt-3">
                                    {{--                                {{$links->links()}}--}}
                                </div>
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
@endpush
