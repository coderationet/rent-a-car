@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('admin/attributes.attributes')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/attributes.attributes')}}</li>
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
                                <h3 class="card-title">{{isset($attribute) ? __('admin/general.update')  : __('admin/general.add_new')}}</h3>
                            </div>
                            <form method="post"
                                  enctype="multipart/form-data"
                                @include('admin.form._action',[
                                      'id_value' => $attribute ?? null,
                                      'route_name' => 'item-attributes'
                                ])>
                                @csrf
                                @if(isset($attribute))
                                    @method('PUT')
                                @endif
                                <div class="card-body">
                                    @include('admin.item_attribute._form')
                                </div>
                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($attribute) ? __('admin/general.update') : __('admin/general.add')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Attribute values -->
                @isset($attribute_values)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="card-title w-100">
                                        {{__('admin/attributes.attribute_values')}}
                                        <a class="btn btn-success btn-xs float-right"
                                           href="{{route('admin.item-attribute-values.create',["attribute_id" => $attribute->id])}}"><i
                                                class="fa fa-plus"></i> {{__('admin/general.add')}}</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- attribute value list -->
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>{{__('admin/general.name')}}</th>
                                            <th>{{__('admin/general.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($attribute_values as $value)
                                            <tr>
                                                <td>{{$value->value}}</td>
                                                <td>
                                                    <a href="{{route('admin.item-attribute-values.edit',$value->id)}}"
                                                       class="btn btn-primary btn-xs"><i
                                                            class="fa fa-edit"></i> {{__('admin/general.edit')}}</a>
                                                    <form method="post"
                                                          action="{{route('admin.item-attribute-values.destroy',$value->id)}}"
                                                          style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Are you sure?')"
                                                            type="submit" class="btn btn-danger btn-xs"><i
                                                                class="fa fa-trash"></i> {{__('admin/general.delete')}}
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- end attribute value list -->
                                </div>
                                <div class="card-footer">
                                    <!-- pagination -->
                                    {{$attribute_values->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

            </div>
        </section>
    </div>
@endsection
@push('extra-footer')
    @include('admin.item_attribute._slug_generator_js',['item' => $attribute ?? null])
    <script>
        $('.editor').summernote({
            height: 300,
            toolbar: []
        });
    </script>
@endpush
