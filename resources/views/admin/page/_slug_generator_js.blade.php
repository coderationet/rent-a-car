<script type="module">
    $('#name').change(function (){
        // if slug is empty then set slug value
        // doesnt allow space and special chars except -
        if($('#slug').val() == ''){
            $.get('{{route('admin.generate-slug')}}',{title:$(this).val()},function (data){
                $('#slug').val(data.slug);
            });
        }
    });

    $('#slug').change(function (){
        // doesnt allow space and special chars except -
        $.get('{{route('admin.generate-slug')}}',{title:$(this).val()},function (data){
            $('#slug').val(data.slug);
        });
    });

    $('#slug').keyup(function (e) {

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
