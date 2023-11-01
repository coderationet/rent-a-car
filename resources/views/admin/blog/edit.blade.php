@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('admin/blog.blog')}}</h1>
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
                    <div class="col-md-6">
                        <form
                            action="{{isset($blog) ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store')}}"
                            enctype="multipart/form-data" method="post">
                            @csrf
                            @if(isset($blog))
                                @method('PUT')
                            @endif
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('admin/blog.blog_content')}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">{{__('admin/general.title')}}</label>
                                        <input type="text" required name="name" id="name" class="form-control"
                                               value="{{isset($blog) ? $blog->name : ''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="content">{{__('admin/general.content')}}</label>
                                        <textarea required name="content" id="content"
                                                  class="form-control">{{isset($blog) ? $blog->content : ''}}</textarea>
                                    </div>
                                    @if(isset($blog) && $blog->image)
                                        <!-- image preview -->
                                        <div class="form-group">
                                            <label for="image">{{__('admin/general.image_preview')}}</label>
                                            <div class="input-group">
                                                <img
                                                    src="{{isset($blog) && $blog->image ? asset('storage/images/blog/'.$blog->image) : ''}}"
                                                    alt="" id="image_preview" class="img-fluid"
                                                    style="max-height: 300px;max-width: 300px">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="image">{{__('admin/general.featured_image')}}</label>
                                        @include('admin.media_library._input', [
                                                'item' => isset($blog) ? $blog : null,
                                                'input_name' => 'image',
                                                'multiple_file' => false,
                                                'relation' => 'image_url'
                                        ])
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{__('admin/general.save')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('extra-head')

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
@endpush
