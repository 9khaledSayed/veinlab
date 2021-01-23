$(function() {

    let form = $('form');
    let totalInvoiceAmount = $("#total_amount");
    let amount_paid = $("#amount_paid");
    let rest = $("#rest");
    var messages = {
        'ar': {
            'The given data was invalid.': "خطأ! هناك في البيانات",
            'Discount Found!': "يوجد خصم!",
            'This customer has a ' :'هذا العميل لديه ',
            ' discount to bring the value of his purchases to ' :' خصم لوصول قيمة مشترياته الى ',
        }
    };
    var locator = new KTLocator(messages);

    $(".kt-selectpicker").selectpicker();

    $('#calculate_price').on('click',function () {
        $.ajax({
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/dashboard/waiting_labs',
            data:  form.serialize() ,
            error: function (err) {
                let response = err.responseJSON;
                let errors = '';
                $.each(response.errors, function( index, value ) {
                    errors += value + '\n';
                });
                swal.fire({
                    title: locator.__(response.message),
                    text: errors,
                    type: 'error'
                });
                console.log(err);
            }
        }).done(function (res) {
            totalInvoiceAmount.text(res.total_price.toFixed(2));
            amount_paid.val('');
            rest.val('');
            if(res.has_invoice_discount){
                swal.fire({
                    title: locator.__('Discount Found!'),
                    text: locator.__("This customer has a ") + res.discount + locator.__(" discount to bring the value of his purchases to ") + res.maximum_reach_value,
                    type: 'success',
                    buttonsStyling: false,
                    confirmButtonText: locator.__("OK"),
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                });
            }
        });
    })



    amount_paid.keyup(function () {
        let result = $(this).val() - totalInvoiceAmount.text()
        rest.val(result.toFixed(2))
    });


});