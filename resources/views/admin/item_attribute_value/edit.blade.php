@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('admin/attributes.attribute_values')}}</h1>
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
                                <h3 class="card-title">{{isset($attribute_value) ? __('admin/general.update')  : __('admin/general.add_new')}}</h3>
                            </div>
                            <form method="post"
                                  enctype="multipart/form-data"
                                @include('admin.form._action',[
                                      'id_value' => $attribute_value ?? null,
                                      'route_name' => 'item-attribute-values'
                                ])>
                                @csrf
                                @if(isset($attribute_value))
                                    @method('PUT')
                                @endif
                                <div class="card-body">
                                    @include('admin.form._input',[
                                        'input_name'=>'value',
                                        'title'=>__('admin/general.name'),
                                        'placeholder'=>__('admin/attributes.insert_attribute_value'),
                                        'item' => $attribute_value ?? null
                                    ])
                                </div>
                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($attribute_value) ? __('admin/general.update') : __('admin/general.add')}}</button>
                                </div>
                                @if(isset($attribute_value))
                                    <input type="hidden" name="attribute_id" value="{{$attribute_value->attribute_id}}">
                                @else
                                    <input type="hidden" name="attribute_id" value="{{$attribute_id}}">
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('extra-js')
    <script>
        $('.editor').summernote({
            height: 300,
            toolbar: []
        });
    </script>
@endsection
