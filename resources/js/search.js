
$(document).on('click','.remove-filter', function () {


    let attributeValueId = $(this).data('attribute-value-id');

    $.ajax({
        url: $(this).data('url'),
        type: 'GET',
        data: {
            attribute_value_id: attributeValueId,
        },
        success: function (response) {
            if (response.status === 'success') {
                location.href = response.url;
                // console.log(response.url);
            }
        }
    });

});
