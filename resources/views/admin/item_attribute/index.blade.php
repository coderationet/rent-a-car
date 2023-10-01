@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Items</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/item.item_attributes')}}</li>
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
                                <h3 class="card-title">{{__("admin/attributes.all_attributes")}}</h3>
{{--                                @if(config('website.strict_attributes') === false)--}}
                                    <a href="{{route('admin.item-attributes.create')}}"
                                       class="btn btn-primary btn-xs float-right"><i
                                            class="fas fa-plus"></i> {{__("admin/general.add_new")}}</a>
{{--                                @endif--}}

                            </div>
                            <div class="card-body">
                                <table id="brands" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{__("admin/attributes.attribute_name")}}</th>
                                        <th>{{__("admin/general.actions")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($attributes->count() == 0)

                                        <tr>
                                            <td colspan="2"
                                                style="text-align: center">{{__("admin/general.no_record_found")}}</td>
                                        </tr>

                                    @endif
                                    @foreach($attributes as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td class="d-flex">
                                                <a href="{{route('admin.item-attributes.edit', $category->id)}}"
                                                   class="btn btn-xs btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    {{__("admin/general.edit")}}
                                                </a>
{{--                                                @if(config('website.strict_attributes') === false)--}}
                                                    <form method="post"
                                                          action="{{route('admin.item-attributes.destroy',$category->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Silmek istediğinize emin misiniz?')"
                                                            type="submit" class="btn ml-1 btn-xs btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                            {{__("admin/general.delete")}}
                                                        </button>
                                                    </form>
{{--                                                @endif--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('admin/attributes.attribute_name')}}</th>
                                        <th>{{__('admin/general.actions')}}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="pb-3 pt-3">
                                    {{$attributes->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('extra-footer')

    @include('admin.layouts.datatable-lang')
    @include('admin.layouts.datatable-files')

@endsection
