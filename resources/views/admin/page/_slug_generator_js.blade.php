<script type="module">
    $('#name').change(function (){


        // if slug is empty then set slug value
        // doesnt allow space and special chars except -
        if($('#slug').val() == ''){
            $('#slug').val($(this).val().replace(/[^a-z0-9\s]/gi, '-').replace(/[_\s]/g, '-').toLowerCase());
        }


    });

    $('#slug').keyup(function (e) {

        // doesnt allow space and special chars except -
        $(this).val($(this).val().replace(/[^a-z0-9\s]/gi, '-').replace(/[_\s]/g, '-').toLowerCase());

        var except_post_id = '';

        @if(isset($item))
            except_post_id = '{{$item->id}}';
        @endif

        $.get("{{route('admin.pages.get_page')}}?slug="+$(this).val()+"&except_post_id="+except_post_id,function (data) {

            if(data.exists === true){

                $('.alert-success').addClass('d-none');
                $('.alert-danger').removeClass('d-none');
                $('.alert-danger').html(data.msg);

            }else {

                $('.alert-success').removeClass('d-none');
                $('.alert-danger').addClass('d-none');
                $('.alert-success').html(data.msg);

            }
        });
    });
</script>
