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
            'total price cannot be less than or equal 0' :'اجمالي الفاتورة لا يمكن ان يكون اقل من او تساوي صفر',
        }
    };
    var locator = new KTLocator(messages);

    $(".kt-selectpicker").selectpicker();

    $('#calculate_price').on('click',function () {
        calculateTotalPrice();
    })



    amount_paid.keyup(function () {
        let result = $(this).val() - totalInvoiceAmount.text()
        rest.val(result.toFixed(2))
    });

    $("#submit-btn").click(function (e) {
        e.preventDefault();

        if (calculateTotalPrice(false) <= 0){
            /** sweet alert **/
            swal.fire({
                title: locator.__("total price cannot be less than or equal 0"),
                type: 'error'
            });
        }else{
            /** submit form **/
            $("#waiting-lab-form").submit();
        }

    });

    function calculateTotalPrice( displayErrors = true){
        var price = 0;
        $.ajax({
            method: 'post',
            async: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: $("#waiting-lab-form").attr('action'),
            data:  form.serialize() ,
            success:function (res) {
                totalInvoiceAmount.text(res.total_price.toFixed(2));
                if (displayErrors){
                    amount_paid.val('');
                    rest.val('');
                }

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

                price =  res.total_price.toFixed(2);
            },
            error: function (err) {
                if (displayErrors){
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
            }
        });
        return price;

    }


});