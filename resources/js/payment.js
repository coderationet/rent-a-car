import Inputmask from "inputmask";

if (document.querySelector('#card-number')) {

    let im_card_number = new Inputmask("9999 - 9999 - 9999 - 9999");
    im_card_number.mask(document.getElementById("card-number"));

    var im_calid_date = new Inputmask("99 / 99");
    im_calid_date.mask(document.getElementById("card-expiry"));

// CVV
    var im_cvv = new Inputmask("999");
    im_cvv.mask(document.getElementById("card-cvv"));

    $('#card-number, #card-valid-date,#card-name,#card-expiry').click(function(){
        $('.cc-card-inner').removeClass('turn-back');
    });

    $('#card-number, #card-valid-date,#card-name,#card-expiry').on('keyup', function(){
        $('.cc-card-inner').removeClass('turn-back');
    });

    $('#card-cvv').click(function(){
        $('.cc-card-inner').addClass('turn-back');
    });

    $('#card-cvv').keyup(function(){
        $('.cc-card-inner').addClass('turn-back');
    });

    let front_page = function(){

        var card_number = $('#card-number').val();
        var card_valid_date = $('#card-expiry').val();
        var card_name = $('#card-name').val();
        var card_cvv = $('#card-cvv').val();


        $('#cc-number-1').text(card_number.split(' - ')[0] == "" ? "----" : card_number.split(' - ')[0]);
        $('#cc-number-2').text(card_number.split(' - ')[1]);
        $('#cc-number-3').text(card_number.split(' - ')[2]);
        $('#cc-number-4').text(card_number.split(' - ')[3]);


        $('#card-valid-date-holder').text(card_valid_date);
        $('#card-name-holder').text(card_name == "" ? "--- ---" : card_name);
        $('#card-cvv-holder').text(card_cvv);
        $('#card-expiry-holder').text(card_valid_date);


    };

    $('#card-number, #card-expiry, #card-name, #card-cvv').on('keyup', front_page);

// all lose focus
    $('#card-number, #card-expiry, #card-name, #card-cvv').on('focusout', function(){
        $('.cc-card-inner').removeClass('turn-back');
    });

}
