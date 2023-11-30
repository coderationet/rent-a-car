if (document.querySelector('.driver-info-page')) {
    $('#driver-info-form').validate({
        lang: 'auto',
        rules: {
            individual_billing_country: {
                required: '#individual-billing-type:checked, [name="enable_billing"][value="1"]',
            },
            individual_billing_city: {
                required: '#individual-billing-type:checked, [name="enable_billing"][value="1"]',
            },
            individual_billing_district: {
                required: '#individual-billing-type:checked, [name="enable_billing"][value="1"]',
            },
            individual_billing_address: {
                required: '#individual-billing-type:checked, [name="enable_billing"][value="1"]',
            },
            company_name: {
                required: '#company-billing-type:checked, [name="enable_billing"][value="1"]',
            },
            tax_number: {
                required: '#company-billing-type:checked, [name="enable_billing"][value="1"]',
            },
            company_billing_country: {
                required: '#company-billing-type:checked, [name="enable_billing"][value="1"]',
            },
            company_billing_city: {
                required: '#company-billing-type:checked, [name="enable_billing"][value="1"]',
            },
            company_billing_district: {
                required: '#company-billing-type:checked, [name="enable_billing"][value="1"]',
            }
        }
    });
    $('.billing-type-radio-button').click(function () {
        $('.billing-tab').addClass('hidden');
        if ($(this).val() == 'individual') {
            $('.billing-tab.individual-billing').removeClass('hidden');
        } else {
            $('.billing-tab.company-billing').removeClass('hidden');
        }
    });
    $('.open-billing-area').click(function () {

        let enable_billing = $('.enable_billing').val();

        if (enable_billing == '1') {
            $('.enable_billing').val('0');
            enable_billing = '0';
            $('.billing-type-area').addClass('hidden');
        }else {
            $('.enable_billing').val('1');
            enable_billing = '1';
            $('.billing-type-area').removeClass('hidden');
        }

        if (enable_billing == '1' && $('.billing-type-radio-button:checked').val() == 'individual') {
            $('.billing-tab.individual-billing').removeClass('hidden');
        }else {
            $('.billing-tab.individual-billing').addClass('hidden');
        }

        if (enable_billing == '1' && $('.billing-type-radio-button:checked').val() == 'company') {
            $('.billing-tab.company-billing').removeClass('hidden');
        }else {
            $('.billing-tab.company-billing').addClass('hidden');
        }
    })
}
