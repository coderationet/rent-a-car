import 'jquery-ui/dist/jquery-ui.min.js';

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

var queryString = location.search
let params = new URLSearchParams(queryString)

$("#price-range").slider({
    step: 100,
    range: true,
    min: 0,
    max: 100000,
    values: [params.get('min_price') ?? 0, params.get('max_price') ?? 100000],
    slide: function (event, ui) {
        $('#min_price').val(ui.values[0]);
        $('#max_price').val(ui.values[1]);
    }
});

// $("#priceRange").val($("#price-range").slider("values", 0) + " - " + $("#price-range").slider("values", 1));
