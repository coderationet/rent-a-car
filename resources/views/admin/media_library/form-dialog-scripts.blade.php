<div class="modal fade" id="gc-media-library-dialog" tabindex="-1" role="dialog"
     aria-labelledby="gc-media-library-dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <iframe src="{{route('admin.media-library.iframe')}}?page=form-dialog" frameborder="0"
                    style="width: 100%;height: 500px;"></iframe>
        </div>
    </div>
</div>

<script>

    function gc_library_element(element) {

        if (element.attr('multiple')) {
            gc_multiple_library_element(element);
        } else {
            gc_single_library_element(element);
        }
    }

    function gc_single_library_element(element) {

        element.css('display', 'none');

        if ($(element).attr('value') == '' && $('.gc-library-preview-container[data-element-id="' + element.attr('name') + '"]').length === 0) {
            element.after(`
        <div class="gc-library-preview-container single-image no-image" data-element-id="${element.attr('name')}">
            <img class="thumbnail" src="{{asset('storage/images/default-thumb.jpg')}}"/>
            <!-- <span class=" placeholder-name"> {{__('admin/media_library.choose_image')}} </span> -->
        </div>
        <div class="gc-image-preview-container-buttons">
            <button type="button" class="btn btn-primary btn-sm add-new single-image" data-element-id="${element.attr('name')}"> {{__('admin/general.add_new')}} </button>
            <button type="button" class="btn btn-primary btn-sm remove single-image" data-element-id="${element.attr('name')}"> {{__('admin/general.remove')}} </button>
        </div>
        `);
        }

    }

    function gc_multiple_library_element(element) {
        element.css('display', 'none');

        if ($(element).attr('value') == '') {
            element.after(`
        <div class="gc-library-preview-container multiple-image no-image" data-element-id="${element.attr('name')}">
            <img class="thumbnail" src="{{asset('storage/images/default-thumb.jpg')}}"/>
            <!-- <span class=" placeholder-name"> {{__('admin/media_library.choose_image')}} </span>  -->
        </div>
        <div class="gc-image-preview-container-buttons">
            <button type='button' class="btn btn-primary btn-sm multiple-image add-new" data-element-id="${element.attr('id')}"> {{__('admin/general.add_new')}} </button>
        </div>
        `);

            // add new button
        }
    }

    var gc_media_library = function() {
        let library_elements = $('.gc-image-library-field');
        // foreach for elements
        library_elements.each(function (index, element) {
            gc_library_element($(element));
        });
    }

    gc_media_library();

    $(function () {

        $(document).on('click', '.gc-library-preview-container.multiple-image.has-image .image-item .remove-item', function (e) {
            e.preventDefault();
            let element = $(this);
            let element_id = element.attr('data-element-id');
            let file_id = element.attr('data-file-id');
            let input_element = $('#'+element_id);
            let value = input_element.val();
            let values = value.split(',');
            let new_values = [];
            values.forEach(function (item) {
                if (item != file_id) {
                    new_values.push(item);
                }
            });
            input_element.val(new_values.join(','));
            element.parent().remove();
        });


        // multiple

        $(document).on('click', '.gc-image-preview-container-buttons .multiple-image.remove', function (e) {
            e.preventDefault();
            let element = $(this);
            let element_id = element.data('element-id');
            let input_element = $(`input[data-element-id="${element_id}"]`);
            input_element.val('');
            input_element.trigger('change');
        });

        $(document).on('click', '.gc-image-preview-container-buttons .add-new.multiple-image', function (e) {

            e.preventDefault();

            let element = $(this);
            let element_id = element.attr('data-element-id');
            let dialog = $('#gc-media-library-dialog');

            dialog.find('iframe').attr('src', '{{route('admin.media-library.iframe')}}?page=form-dialog&is_multiple=yes');

            dialog.attr('data-element-id', element_id);
            dialog.attr('data-is-multiple', 'yes');

            dialog.modal('show');
        });


        $(document).on('click', '.gc-image-preview-container-buttons .remove.single-image', function (e) {
            let element = $(this);
            let element_id = element.attr('data-element-id');
            let input_element = $('#' + element_id);
            input_element.val('');

            let preview_container = input_element.parent().find('.gc-library-preview-container');
            preview_container.removeClass('has-image');
            preview_container.find('img').remove();
            preview_container.find('video').remove();

            preview_container.append(`
                <img class="" src="{{asset('storage/images/default-thumb.jpg')}}"/>
            `);

        });

        $(document).on('click', '.gc-image-preview-container-buttons .add-new.single-image', function (e) {

            let element = $(this);
            let element_id = element.attr('data-element-id');
            let dialog = $('#gc-media-library-dialog');

            dialog.attr('src', '{{route('admin.media-library.iframe')}}?page=form-dialog&is_multiple=no?');
            dialog.attr('data-is-multiple', 'no');
            dialog.attr('data-element-id', element_id);
            dialog.modal('show');

        });


    });

    window.closeModal = function () {
        $('#gc-media-library-dialog').modal('hide');
    };
</script>


