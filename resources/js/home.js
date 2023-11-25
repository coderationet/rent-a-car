$('.home-search-button').click(function ( e ) {

    e.preventDefault();


    let form_date = $('#home-search-form').serialize();

    // add token
    form_date += '&_token=' + $('meta[name="csrf-token"]').attr('content');

    $.post('/validate-home-search', form_date, function (data) {

        if (data.success == true) {
            $('#home-search-form').submit();
        } else {

            let error_html = '';

            error_html += '<ul class="error_list">';

            $.each(data.errors, function (key, value) {
                error_html += '<li>' + value + '</li>';
            });

            error_html += '</ul>';

            $('.home-search-errors').html(error_html);
        }
    });
});
