@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('admin/general.dashboard')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{__('admin/general.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin/item.items')}}</li>
                            <li class="breadcrumb-item active">{{__('admin/item.new_item')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <form action="{{isset($item) ? route('admin.items.update',$item->id)  : route('admin.items.store')}}"
                      method="post">
                    @csrf
                    @if(isset($item))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">

                                        <div class="card-header">
                                            <h3 class="card-title">{{__('admin/general.add_new')}}</h3>
                                        </div>

                                        <div class="card-body item-form">
                                            <div class="form-group">
                                                <label for="title">{{__('admin/general.title')}}</label>
                                                <input type="text" class="form-control" id="title"
                                                       value="{{isset($item) ? $item->title : ''}}"
                                                       name="title"
                                                       required
                                                       placeholder="{{__('admin/general.title')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug">{{__('admin/general.slug')}}</label>
                                                <input type="text" class="form-control" id="slug"
                                                       value="{{isset($item) ? $item->slug : ''}}"
                                                       name="slug"
                                                       required
                                                       placeholder="{{__('admin/general.slug')}}">
                                                <div class="alert alert-success d-none mt-2"></div>
                                                <div class="alert alert-danger d-none mt-2"></div>
                                            </div>
                                            <!-- description part -->
                                            <div class="form-group">
                                                <label for="description">{{__('admin/general.description')}}</label>
                                                <textarea class="form-control custom-editor" id="description" rows="3"
                                                          name="description"
                                                          required
                                                          placeholder="Açıklama Giriniz">{{isset($item) ? $item->description : ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">
                                                {{isset($item) ? __('admin/general.update') : __('admin/general.add_new')}}
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @include('admin.items._attribute_values',[
                                        "item_attributes" => $item_attributes,
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                {{__('admin/general.featured_image')}}
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            @include('admin.media_library._input',[
                                                    "input_name"=>"thumbnail_id",
                                                    "relation" => "thumbnail",
                                                    "item" => isset($item) ? $item : null,
                                                    "multiple_file" => false
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                {{__('admin/general.gallery')}}
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            @include('admin.media_library._input',[
                                                    "input_name"=>"gallery_ids",
                                                    "relation" => "gallery",
                                                    "multiple_file" => true,
                                                    "item" => isset($item) ? $item : null
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                {{__('admin/category.categories')}}
                                            </h3>
                                        </div>
                                        <div class="card-body category-listing-block">
                                            {!! \App\Helpers\HierarchicalListingHelper::get_listing_html($categories,$selected_categories,'categories[]') !!}
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    id="create-new-category-button"
                                                    data-target="#create-new-category-modal">
                                                {{__('admin/category.create_new_category')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@push('extra-footer')

    <!-- Modal to create new category dialog -->
    <!-- Modal -->
    <div class="modal fade" id="create-new-category-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin/category.create_new_category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary create-new-category-ajax">{{__('admin/general.add_new')}}</button>
                </div>
            </div>
        </div>
    </div>



    <script src="{{asset('assets/admin/summernote/custom-image-dialog.plugin.js')}}"></script>
    @include('admin.js.summernote-turkish')
    <script type="module">

        $('.item-form #title').change(function (){
            // if slug is empty then set slug value
            // doesnt allow space and special chars except -
            if($('.item-form #slug').val() == ''){
                $('.item-form #slug').val($(this).val().replace(/[^a-z0-9\s]/gi, '-').replace(/[_\s]/g, '-').toLowerCase());
            }

        });

        $('.item-form #slug').keyup(function (e) {

            // doesnt allow space and special chars except -
            $(this).val($(this).val().replace(/[^a-z0-9\s]/gi, '-').replace(/[_\s]/g, '-').toLowerCase());

            var except_post_id = '';

            @if(isset($item))
                except_post_id = '{{$item->id}}';
            @endif

            $.get("{{route('admin.items.get_item')}}?slug="+$(this).val()+"&except_post_id="+except_post_id,function (data) {

                if(data.exists === true){

                    $('.item-form .alert-success').addClass('d-none');
                    $('.item-form .alert-danger').removeClass('d-none');
                    $('.item-form .alert-danger').html(data.msg);

                }else {

                    $('.item-form .alert-success').removeClass('d-none');
                    $('.item-form .alert-danger').addClass('d-none');
                    $('.item-form .alert-success').html(data.msg);

                }
            });
        });

        $(document).on('click','.create-new-category-ajax',function () {
            var form_data = '';
            // add csrf token to form data get token from meta
            form_data = form_data + '&_token=' + $('meta[name="csrf-token"]').attr('content');
            // add name to form data
            form_data = form_data + '&name=' + $('#create-new-category-modal #category').val();
            // add parent_id to form data
            form_data = form_data + '&parent_id=' + $('#create-new-category-modal #parent_id').val() ?? null ;
            // add return_type to form data
            form_data = form_data + '&response_type=json';
            // send selected categories
            var selected_categories = [];
            // get checked values from category-listing-block input checkbox
            $('.category-listing-block input[type=checkbox]:checked').each(function () {
                selected_categories.push($(this).val());
            });
            // add selected categories to form data
            form_data = form_data + '&selected_categories=' + selected_categories;
            $.ajax({
                method: 'POST',
                url: '{{route('admin.item-categories.store')}}',
                data: form_data,
                success: function (response) {
                    if (response.status == 'success') {
                        $(document).Toasts('create', {
                            class: 'bg-success',
                            title: '{{__('admin/general.success')}}',
                            subtitle: '',
                            body: response.msg
                        });
                        $('#create-new-category-modal').modal('hide');
                        $('.category-listing-block').html(response.category_block_html);
                    } else {
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: '{{__('admin/general.error')}}',
                            subtitle: '',
                            body: response.msg
                        });
                    }
                }
            });
        });
        $(function () {

            $(document).on('click', '#create-new-category-button', function () {

                var modal_body_html = $.ajax({
                    method: 'GET',
                    url: '{{route('admin.item-categories.new_category_form_html')}}',
                    async: false
                }).responseText;

                $('#create-new-category-modal .modal-body').html(modal_body_html);

            });

            $(document).on('click','')

            // Summernote
            $('#description').summernote({
                // lang: 'tr-TR',
                tabsize: 2,
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
        })
    </script>
    <style>
        .category-listing-block {
            max-height: 400px;
            overflow-y: scroll;
        }
    </style>
@endpush
