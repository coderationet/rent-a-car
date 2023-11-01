@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('admin/menu_links.links')}}</h1>
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

                    <div class="col-md-6">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{__('admin/menu_links.add_link')}}</h3>
                            </div>
                            <form method="post"
                                  enctype="multipart/form-data"
                                  action="{{isset($link) ? route('admin.menu-links.update',$link->id) : route('admin.menu-links.store')}}">
                                @csrf
                                @if(isset($link))
                                    @method('PUT')
                                @endif
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">{{__('admin/menu_links.link_name')}}</label>
                                        <input type="text" class="form-control" id="name"
                                               name="name"
                                               @if(isset($link))
                                                   value="{{$link->name}}"
                                               @endif
                                               required
                                               placeholder="{{__('admin/menu_links.insert_a_link_name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="url">{{__('admin/general.link')}}</label>
                                        <input type="text" class="form-control" id="url"
                                               name="url"
                                               @if(isset($link))
                                                   value="{{$link->url}}"
                                               @endif
                                               required
                                               placeholder="{{__('admin/menu_links.insert_a_url')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="parent">{{__('admin/menu_links.parent_menu')}}</label>
                                        <select required name="parent_id" class="form-control">
                                            <option value="">{{__('admin/menu_links.parent_menu')}}</option>
                                            @foreach($parents as $parent)
                                                <option
                                                    @if(isset($link) && $parent->parent_id == $link->parent_id)
                                                        selected
                                                    @endif
                                                    value="{{$parent->parent_id}}">{{$parent->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="order">{{__('admin/general.order')}}</label>
                                        <input type="number" class="form-control" id="order"
                                               name="order"
                                               @if(isset($link))
                                                   value="{{$link->order}}"
                                               @endif
                                               required
                                               placeholder="{{__('admin/general.order')}}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($link) ? __('admin/general.update') : __('admin/general.add')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('extra-js')
    <script>
        $('.editor').summernote({
            height: 300,
            toolbar: []
        });
    </script>
@endpush
