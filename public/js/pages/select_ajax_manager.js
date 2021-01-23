$(function() {
    let discount_perc  = 0;
    let select_category = $("select[name='category_id']");
    let select_analysis = $("#main_analysis");
    let form = $('form');
    let transfer = $("input[name='transfer']");
    let transferValue = $("input[name='transfer']:checked").val();

    chooseTransferPrices(transferValue);

    $("select[name='company_id']").change(function() {
        categoryAjax(this.value);
    });

    $('#patients').on('change', function() {
        patientAjax(this.value)
    });

    transfer.on('click', function () {
        let transferValue = $("input[name='transfer']:checked").val();
        chooseTransferPrices(transferValue);
    });

    function categoryAjax (id){
        if(id != null && id !== ''){
            $.ajax({
                method: "get",
                url: "/dashboard/categories?company_id=" + id,
                success:function(data){
                    select_category.empty();
                    for(let i=0; i< data.length;i++)
                        select_category.append('<option value="' + data[i].id + '">' + data[i].percentage + " % " + data[i].name + '</option>');
                    select_category.selectpicker('refresh');
                }
            })
        }
    }

    function patientAjax (id){
        if(id != null && id !== ''){
            $.ajax({
                type:'GET',
                url:'/dashboard/checkNoVisits/' + id,
                data:form.serialize(),
                success:function (response) {
                    if (response.status === 1)
                    {
                        swal("هذا العميل لديه خصم "+ " % " + response.discount
                            , ""
                            , "success"
                        )
                        discount_perc = response.discount;
                    }else {discount_perc = 0;}
                }
            });
        }
    }

    function chooseTransferPrices(transferValue){
        $.ajax({
            method: "get",
            url: "/dashboard/transferPrice/" + transferValue,
            success:function(data){
                select_analysis.empty();
                for(let i=0; i< data.length;i++)
                    select_analysis.append('<option value="' + data[i].id + '">' + data[i].general_name + " - " + data[i].price + " SAR" + data[i].code + '</option>');
                select_analysis.selectpicker('refresh');
            }
        });
    }
});