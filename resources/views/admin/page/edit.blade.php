@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('admin/pages.pages')}}</h1>
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
                    <div class="col-md-6">
                        <form
                            action="{{isset($page) ? route('admin.pages.update', $page->id) : route('admin.pages.store')}}"
                            method="post">
                            @csrf
                            @if(isset($page))
                                @method('PUT')
                            @endif
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('admin/pages.page_content')}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">{{__('admin/general.name')}}</label>
                                        <input type="text" required name="name" id="name" class="form-control"
                                               value="{{isset($page) ? $page->name : ''}}">
                                    </div>
                                    @include('admin.form._input',[
                                         'input_name'=>'slug',
                                         'title'=>__('admin/general.slug'),
                                         'placeholder'=>__('admin/general.insert_slug'),
                                         'item' => $attribute ?? null,
                                         'with_alerts' => true
                                     ])
                                    <div class="form-group">
                                        <label for="content">{{__('admin/general.content')}}</label>
                                        <textarea required name="content" id="content"
                                                  class="form-control">{{isset($page) ? $page->content : ''}}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        {{isset($page) ? __('admin/general.update') : __('admin/general.create')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('extra-footer')
    <script src="{{asset('assets/admin/summernote/custom-image-dialog.plugin.js')}}"></script>
    <script type="module">
        $(function () {
            $('#content').summernote({
                minHeight: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['examplePlugin', 'link']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['view', ['codeview']],
                ]
            });
        });
    </script>
    @include('admin.media_library.form-dialog-includes')
    @include('admin.page._slug_generator_js', ['item' => isset($page) ? $page : null])
@endpush
