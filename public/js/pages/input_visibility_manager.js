$(function() {
    let hospitalsDiv = $("#hospitals");
    let doctorsDiv = $("#doctors");
    let promoCodesDiv = $('#promo_codes');
    let sectorsDiv = $('#sectors');
    let packageDiv = $("#package");
    let transfer = $("input[name='transfer']");
    let promo_code = $("input[name='promo_code']");
    let companiesDiv = $("#companies");


    validation();

    promo_code.eq(0).on('click', function () {  // No Codes
        DivToggle({elementsToHide:[promoCodesDiv]});
    });
    promo_code.eq(1).on('click', function () {
        DivToggle( {elementsToHide:[promoCodesDiv],elementsToShow:[promoCodesDiv]});
    });

    transfer.on('click', function () {
        let visibleDiv = $("input[name='transfer']:checked").data('action');
        DivToggle({elementsToShow:[$(visibleDiv)]});
    });


    function DivToggle({elementsToHide = [doctorsDiv, sectorsDiv, hospitalsDiv, companiesDiv, packageDiv], elementsToShow = []}) {
        $.each(elementsToHide, function( index, element ) {
            element.fadeOut(1);
        });
        $.each(elementsToShow, function( index, element ) {
            element.fadeIn();
        });
    }

    function validation() {
        if(promo_code.eq(1).prop("checked")) { // was a promoCode
            DivToggle( {elementsToHide:[promoCodesDiv],elementsToShow:[promoCodesDiv]});
        }

        let visibleDiv = $("input[name='transfer']:checked").data('action');
        DivToggle({elementsToShow:[$(visibleDiv)]});
    }

});