import './bootstrap';


$('.accordion-header').click(function () {

    let isShow = $(this).parent().find('.accordion-collapse').hasClass('show');

    if (isShow){
        let innerHeight = 0;
        $(this).parent().find('.accordion-collapse').css('max-height', innerHeight + 'px');
    }else {
        let innerHeight = $(this).parent().find('.accordion-collapse').prop('scrollHeight');
        $(this).parent().find('.accordion-collapse').css('max-height', innerHeight + 'px');
    }


    $(this).parent().find('.accordion-collapse').toggleClass('show');

});
