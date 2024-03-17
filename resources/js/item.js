import Swiper from 'swiper';
import 'swiper/css';


const item_slider = new Swiper('.item-slider', {
    loop: true,
});


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}



const configObject = {
    // lookBehind: true,
    language: 'auto',
    // seperator
    separator: ' - ',
    beforeShowDay:  function (t) {

        let availability = true;

        let today = new Date(t.getFullYear(), t.getMonth(), t.getDate());
        today = formatDate(today);

        let start_of_month = new Date(t.getFullYear(), t.getMonth(), 1);
        let end_of_month = new Date(t.getFullYear(), t.getMonth() + 1, 0);

        // check if item availability is not loaded
        if (typeof window.item_availability[today] === 'undefined') {
            updateItemCalendarAjax(formatDate(start_of_month), formatDate(end_of_month));
        }

        let classs = ''

        // if value exists
        if ( typeof window.item_availability[today] !== 'undefined' && window.item_availability[today] !== null ) {
            availability = window.item_availability[today];
            classs = availability ? 'available' : 'testset';
        }

        return [availability, classs, ''];
    }
}




function updateItemCalendarAjax(startDate, endDate) {

    if (window.item_availability !== undefined && window.item_availability[startDate] && window.item_availability[endDate]) {
        return;
    }

    $.ajax({
        url: $('#date-range').data('item-calendar-url'),
        type: 'GET',
        async: false,
        cache: true,
        data: {
            date_start: startDate,
            date_end: endDate,
            item_id: $('#item-id').val(),
        },
        success: function (response) {
            if (response.status_code === 200) {
                $.each(response.data.availability_data, function (key, value) {
                    window.item_availability[key] = value;
                });
            }
        }
    });
}

window.onload = function () {


    if (document.querySelector('#date-range')) {

        window.item_availability = available_dates;

        $.dateRangePickerLanguages['tr'] = {
            'selected': 'Seçildi:',
            'day': 'Gün',
            'days': 'Gün',
            'apply': 'Tamam',
            'week-1': 'pzt',
            'week-2': 'sal',
            'week-3': 'çar',
            'week-4': 'per',
            'week-5': 'cum',
            'week-6': 'cmt',
            'week-7': 'paz',
            'week-number': 'H',
            'month-name': ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
            'shortcuts': 'Kısayollar',
            'past': 'Geçmiş',
            'following': 'Takip Eden',
            'previous': 'Önceki',
            'prev-week': 'Hafta',
            'prev-month': 'Ay',
            'prev-year': 'Yıl',
            'next': 'Sonraki',
            'next-week': 'Hafta',
            'next-month': 'Ay',
            'next-year': 'Yıl',
            'less-than': 'Tarih aralığı %d gün\'den fazla olmamalıdır',
            'more-than': 'Tarih aralığı %d gün\'den az olmamalıdır',
            'default-more': '%d günden daha uzun bir tarih seçiniz',
            'default-single': 'Lütfen bir tarih seçiniz',
            'default-less': '%d günden daha kısa bir tarih seçiniz',
            'default-range': '%d ve %d gün arasında bir tarih seçiniz',
            'default-default': 'Lütfen bir tarih seçiniz'
        };

        $('#date-range').dateRangePicker(configObject);

        $('.open-calendar').click(function () {
            setTimeout(function () {
                $('#date-range').data('dateRangePicker').open();
            }, 100);
        });

        $(document).mouseup(function (e) {

            var container = $(".date-picker-wrapper");

            if (container.has(e.target).length === 0) {
                // container.hide();
            }
        });

        $('.date-picker-wrapper .apply-btn').click(function () {
            // $('.date-picker-wrapper').hide();
        });


    }
}

