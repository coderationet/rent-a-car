<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/admin/bootstrap5/dist/css/bootstrap.min.css')}}">

</head>
<body>
<div class="row m-0 p-0">
    <div class="col-md-12  m-0 p-0" style="height: 100vh">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button"
                        role="tab" aria-controls="home" aria-selected="true">Yeni Ekle
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="library-tab" data-bs-toggle="tab" data-bs-target="#library" type="button"
                        role="tab" aria-controls="library" aria-selected="false">Kütüphane
                </button>
            </li>
        </ul>
        <div class="tab-content h-100" id="myTabContent">
            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                <div
                    style="width: 100%;height: 100vh;display: flex;flex-direction:column;justify-content: center;align-items: center">
                    <span><b>Max Size: {{$max_size}}MB</b></span>
                    <button class="btn btn-primary" id="new-image">Yeni İçerik Ekle</button>
                    <input type="file" id="new-image-input" style="display: none">
                </div>

            </div>
            <div class="tab-pane fade " id="library" role="tabpanel" aria-labelledby="library-tab">
                <div class="row bg-blue text-center m-0 p-0"
                     style="display:flex; justify-content: center; align-items: center; width: 100%;text-align: center;background: #353dff; color:#fff">
                    <span>Dosya Seçiniz</span>
                </div>
                <div class="row image-items">
                    @foreach($items as $file)
                        <div class="col-md-3 file-to-pick" style="text-align: center; border:1px solid #eee"
                             data-file-id="{{$file->id}}" data-file-type="{{$file->type}}"
                             data-file-url="{{asset('storage/media/'.$file->name)}}"
                             data-file-name="{{$file->name}}">
                            @if($file->type == 'image')
                                <img src="{{asset('storage/media/'.$file->name)}}" alt="" class="img-fluid"
                                     style="max-height: 250px">
                            @elseif($file->type == 'video')
                                <img src="{{asset('storage/images/video-thumb.jpg')}}" alt="" class="img-fluid"
                                     style="max-height: 250px">
                            @elseif($file->type == 'application')
                                <img src="{{asset('storage/images/file.jpg')}}" alt="" class="img-fluid"
                                     style="max-height: 250px">
                            @endif
                            <span>{{$file->name}}</span>
                        </div>
                    @endforeach
                </div>
                <div style="display: flex; justify-content: center;align-items: center;margin-top: 20px">
                    {{$items->appends(['active_tab' => 'library'])->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/admin/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/bootstrap5/dist/js/bootstrap.bundle.js')}}"></script>
<script>
    $(function () {

        var is_multiple = null;

        $('#new-image').click(function () {
            $('#new-image-input').click();
        });
        if (is_multiple === 'yes') {

        } else {
            $('#new-image-input').change(function () {

                // switch to library tab
                $('#library-tab').tab('show');

                $('.image-items').prepend(`
                <div class="col-md-3 file-to-pick new-image" style="text-align: center; border:1px solid #eee">
                    <img src="{{asset('storage/images/default-thumb.jpg')}}" alt="" class="img-fluid" style="max-height: 250px">
                    <span>Yükleniyor...</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            `);
                let file = $(this)[0].files[0];
                let formData = new FormData();
                formData.append('file', file);
                formData.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: '{{route('admin.media-library.store')}}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        let xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                let percent = Math.round((e.loaded / e.total) * 100);
                                $('.progress-bar').css('width', percent + '%');
                                $('.progress-bar').attr('aria-valuenow', percent);
                            }
                        });
                        return xhr;
                    },
                    success: function (data) {
                        // remove progress bar
                        // $('.progress-bar').remove();
                        // add image

                        if (data.file.type == 'image') {
                            $('.new-image img').attr('src', data.file.url);
                        } else if (data.file.type == 'video') {
                            $('.new-image img').attr('src', '{{asset('storage/images/video-thumb.jpg')}}');
                        } else if (data.file.type == 'application') {
                            $('.new-image img').attr('src', '{{asset('storage/images/file.jpg')}}');
                        }

                        // add file name
                        $('.new-image span').text(data.file.name);

                        // add file type
                        $('.new-image').attr('data-file-type', data.file.type);
                        $('.new-image').attr('data-file-name', data.file.name);
                        $('.new-image').attr('data-file-url', data.file.url);


                        // add file id
                        $('.new-image').attr('data-file-id', data.file.id);
                        // remove new-image class
                        $('.new-image').removeClass('new-image');
                    }
                });
            });
        }
        @if(isset($page) && $page == 'form-dialog' && $is_multiple == 'no')
        $(document).on('click', '.file-to-pick', function () {

            let image = $(this).find('img').attr('src');
            let fileId = $(this).attr('data-file-id');
            // parent element id
            let parent = window.parent.document;

            let modal = $(parent).find('#gc-media-library-dialog');

            let element_id = modal.attr('data-element-id');

            let is_multiple = modal.attr('data-is-multiple');

            // set file id
            $(parent).find('input[name=' + element_id + ']').val(fileId);

            let file_url = $(this).attr('data-file-url');

            // remove current preview image
            $(parent).find('#' + element_id).parent().find('.gc-library-preview-container img').remove();
            $(parent).find('#' + element_id).parent().find('.gc-library-preview-container video').remove();

            if ($(this).attr('data-file-type') == 'image') {
                //create preview image
                $(parent).find('#' + element_id).parent().find('.gc-library-preview-container').prepend(`
                    <img src="${image}" alt="" class="img-fluid" style="max-height: 250px">
                `);

            } else if ($(this).attr('data-file-type') == 'video') {
                // set video tag
                $(parent).find('#' + element_id).parent().find('.gc-library-preview-container').html(`
                    <video src="${file_url}" controls style="width: 100%; height: 100%"></video>
                `);
            } else if ($(this).attr('data-file-type') == 'application') {
                $(parent).find('#' + element_id).parent().find('.gc-library-preview-container').html(`
                    <div style="display:flex;flex-direction:column; padding : 10px;">
                        <img src="{{asset('storage/images/file.jpg')}}" alt="" class="img-fluid" style="max-height: 250px">
                        <a href="${file_url}" target="_blank" class="btn btn-primary btn-sm">İndir</a>
                    </div>
                `);
            }

            // close modal
            window.parent.closeModal();
        });
        @elseif(isset($page) && $page == 'form-dialog' && $is_multiple == 'yes')
        $(document).on('click', '.file-to-pick', function () {

            let image = $(this).find('img').attr('src');
            let fileId = $(this).attr('data-file-id');
            // parent element id
            let parent = window.parent.document;

            let modal = $(parent).find('#gc-media-library-dialog');

            let element_id = modal.attr('data-element-id');

            let is_multiple = modal.attr('data-is-multiple');

            // set file id
            let current_file_ids = $(parent).find('input[name=' + element_id + ']').val();


            if (current_file_ids == '') {
                current_file_ids = [];
            } else {
                current_file_ids = current_file_ids.split(',');
            }

            // add image id to input if not exists
            if (current_file_ids.indexOf(fileId) == -1) {
                current_file_ids.push(fileId);
            }
            current_file_ids.filter(function (el) {
                return el !== '';
            });

            $(parent).find('input[name=' + element_id + ']').val(current_file_ids.join(','));

            let container = $(parent).find('input[name=' + element_id + ']').parent();
            container.find('.thumbnail').remove();
            container.find('.gc-library-preview-container').removeClass('no-image');
            container.find('.gc-library-preview-container').addClass('has-image');
            ;


            let file_url = $(this).attr('data-file-url');

            if ($(this).attr('data-file-type') == 'image') {
                //create preview image
                $(parent).find('#' + element_id).parent().find('.gc-library-preview-container').prepend(`
                    <div class="image-item">
                    <img src="${image}" alt="" class="img-fluid" style="max-height: 250px">
                    <div class="remove-item"  data-element-id="${element_id}" data-file-id="${fileId}">Sil</div>
                    </div>
                `);

            } else if ($(this).attr('data-file-type') == 'video') {
                // set video tag
                $(parent).find('#' + element_id).parent().find('.gc-library-preview-container').append(`
                    <div class="image-item" data-element-id="${element_id}" data-file-id="${fileId}"><video src="${file_url}" controls style="width: 100%; height: 100%"></video><div class="remove-item">Sil</div></div>
                `);
            }

            // close modal
            window.parent.closeModal();
        });
        @elseif(isset($page) && $page == 'editor-dialog')
        $(document).on('click', '.file-to-pick', function () {
            let parent = window.parent.document;
            let file_url = $(this).attr('data-file-url');

            window.parent.addImageToEditor(file_url);
        });

        @endif

        @if(isset($_GET['active_tab']))

        var someTabTriggerEl = document.querySelector('#library-tab')
        var tab = new bootstrap.Tab(someTabTriggerEl)

        tab.show()

        @endif
    });
</script>
<style>
    .image-items {
        margin: 0;
    }

    .file-to-pick {
        border: 3px solid #eee;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .file-to-pick:hover {
        border: 3px solid #ddd !important;
        background: #ddd;
    }

    .progress {
        width: 100%;
    }

</style>
</body>
</html>
