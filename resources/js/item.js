import Swiper from 'swiper';
import 'swiper/css';


const item_slider = new Swiper('.item-slider', {
    loop: true,
});


const configObject = {
    // lookBehind: true,
    language: 'auto',
    // seperator
    separator: ' - ',
}

if (document.querySelector('#date-range')) {

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
