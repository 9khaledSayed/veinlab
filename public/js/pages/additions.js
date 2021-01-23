"use strict";

// Class definition
var KTContactsAdd = function () {
    // Base elements
    // var wizardEl;
    var formEl1;
    var formEl2;
    var formEl3;
    var validator1;
    var validator2;
    var validator3;
    var wizard;
    var avatar;


    let messages = {
        'ar': {
            "please fill the required data":"الرجاء مليء الحقول المطلوبة",
            "The operation has been done successfully !":"لقد تمت العملية بنجاح !",
            "Choose":"اختر",
        }
    };

    let locator = new KTLocator(messages);

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_contacts_add', {
            startStep: 1, // initial active step number
            clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })

        // Change event
        wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });
    }

    var initValidation = function() {
        validator1 = formEl1.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                employee_id: {
                    required: true
                },

                effective_date: {
                    required: true
                },
                reason: {
                    required: true
                },
                amount: {
                    required: true
                }
            },

            // Display error
            invalidHandler: function(event, validator1) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": locator.__("please fill the required data"),
                    "type": "error",
                    "buttonStyling": false,
                    "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
        validator2 = formEl2.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules Absent
            rules: {
                employee_id: {
                    required: true
                },
                minutes: {
                    required: true
                },
                hours: {
                    required: true,
                    min:0,
                    max:8
                },
                effective_date: {
                    required: true
                },
                operational_date: {
                    required: true
                }
            },

            // Display error
            invalidHandler: function(event, validator2) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": locator.__("please fill the required data"),
                    "type": "error",
                    "buttonStyling": false,
                    "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
        validator3 = formEl3.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules Late
            rules: {
                employee_id: {
                    required: true
                },
                minutes: {
                    required: true
                },
                hours: {
                    required: true
                },
                effective_date: {
                    required: true
                },
                operational_date: {
                    required: true
                }
            },

            // Display error
            invalidHandler: function(event, validator3) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": locator.__("please fill the required data"),
                    "type": "error",
                    "buttonStyling": false,
                    "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    }

    var initSubmit = function() {
        var btn1 = formEl1.find('[data-ktwizard-type="action-submit"]');
        var btn2 = formEl2.find('[data-ktwizard-type="action-submit"]');
        var btn3 = formEl3.find('[data-ktwizard-type="action-submit"]');

        btn1.on('click', function(e) {
            e.preventDefault();

            if (validator1.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn1);

                //KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl1.ajaxSubmit({
                    success: function(response) {
                        KTApp.unprogress(btn1);
                        //KTApp.unblock(formEl);
                        if(response.message == 2){
                            swal.fire({
                                "title": "",
                                "text": 'Cannot add / modify operations to an already issued payroll',
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }else{
                            swal.fire({
                                "title": "",
                                "text": locator.__("The operation has been done successfully !"),
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                            datatable.reload();
                        }
                    }
                    ,error:function (err){
                        var errors = '';
                        $.each( err.responseJSON.errors, function (key, value) {
                            errors += '' + value;
                        });
                        if(errors.length === 0) {
                            errors = err.responseJSON.message
                        }
                        console.log(errors)
                        swal.fire({
                            "title": "",
                            "text": errors,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                });
            }
        });
        btn2.on('click', function(e) {
            e.preventDefault();

            if (validator2.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn2);

                //KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl2.ajaxSubmit({
                    success: function(response) {
                        KTApp.unprogress(btn2);
                        //KTApp.unblock(formEl);
                        if(response.message == 2){
                            swal.fire({
                                "title": "",
                                "text": 'Cannot add / modify operations to an already issued payroll',
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }else{
                            swal.fire({
                                "title": "",
                                "text": locator.__("The operation has been done successfully !"),
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                            datatable.reload();
                        };
                    }
                    ,error:function (err){
                        var errors = '';
                        $.each( err.responseJSON.errors, function (key, value) {
                            errors += '' + value;
                        });
                        if(errors.length === 0) {
                            errors = err.responseJSON.message
                        }
                        console.log(errors)
                        swal.fire({
                            "title": "",
                            "text": errors,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                });
            }
        });
        btn3.on('click', function(e) {
            e.preventDefault();

            if (validator3.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn3);

                //KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl3.ajaxSubmit({
                    success: function(response) {
                        KTApp.unprogress(btn3);
                        //KTApp.unblock(formEl);
                        if(response.message == 2){
                            swal.fire({
                                "title": "",
                                "text": 'Cannot add / modify operations to an already issued payroll',
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }else{
                            swal.fire({
                                "title": "",
                                "text": locator.__("The operation has been done successfully !"),
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                            datatable.reload();
                        }
                    }
                    ,error:function (err){
                        var errors = '';
                        $.each( err.responseJSON.errors, function (key, value) {
                            errors += '' + value;
                        });
                        if(errors.length === 0) {
                            errors = err.responseJSON.message
                        }
                        console.log(errors)
                        swal.fire({
                            "title": "",
                            "text": errors,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                });
            }
        });
    }

    var initAvatar = function() {
        avatar = new KTAvatar('kt_contacts_add_avatar');
    }

    return {
        // public functions
        init: function() {
            formEl1 = $('#general_deduction');
            formEl2 = $('#late_deduction');
            formEl3 = $('#absent_deduction');

            initWizard();
            initValidation();
            initSubmit();
            initAvatar();
        }
    };
}();

jQuery(document).ready(function() {
    var hourly_rate_value = 0;
    var daily_rate_value = 0;
    let select_employee = $("select[name='employee_id']");
    let late_employee = $("#late_employee");
    let absent_employee = $("#absent_employee");
    let hourly_rate_field = $("input[name='hourly_rate']");
    let hours_field = $("input[name='hours']");
    let minutes_field = $("input[name='minutes']");
    let messages = {
        'ar': {
            "Choose":"اختر",
        }
    };
    let locator = new KTLocator(messages);
    var timeDisplay = $("#time");
    function refreshTime() {
        var dateString = new Date().toLocaleString("en-US", {timeZone: "Asia/Riyadh"});
        var formattedString = dateString.replace(", ", " - ");
        timeDisplay.val(formattedString);
    }
    setInterval(refreshTime, 1000);
    $('.kt-selectpicker').selectpicker();
    KTContactsAdd.init();

    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
    // $.fn.datetimepicker.dates['ar'] = {
    //     days: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
    //     daysShort: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
    //     daysMin: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
    //     months: ['محرّم', 'صفر', 'ربيع الأول', 'ربيع الآخر أو ربيع الثاني', 'جمادى الاول', 'جمادى الآخر أو جمادى الثاني', 'رجب', 'شعبان', 'رمضان', 'شوّال', 'ذو القعدة', 'ذو الحجة'],
    //     monthsShort: ['محرّم', 'صفر', 'ربيع الأول', 'ربيع الآخر أو ربيع الثاني', 'جمادى الاول', 'جمادى الآخر أو جمادى الثاني', 'رجب', 'شعبان', 'رمضان', 'شوّال', 'ذو القعدة', 'ذو الحجة'],
    //     today: ""
    // };
    // enable clear button
    $('.datepic').datepicker({
        rtl: KTUtil.isRTL(),
        language: 'ar',
        todayBtn: "linked",
        format: 'yyyy-mm-dd',
        clearBtn: true,
        todayHighlight: true,
        templates: arrows
    });
    $('.month_pic').datepicker({
        orientation: "bottom",
        rtl: KTUtil.isRTL(),
        language: 'ar',
        clearBtn: true,
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months"
    });
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    function locationResultTemplater(location) {
        return location.fname_arabic + " " + location.lname_arabic;
    }
    $( ".kt-select2" ).select2({
        placeholder: locator.__('Choose'),
        allowClear: true,
        ajax: {
            url: "/dashboard/hr/employees",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        },
        templateResult: locationResultTemplater,
        templateSelection: function(item) { return item.fname_arabic || item.text; }
    });
    function salaryAjax (id){
        if(id != null){
            $.ajax({
                method: "get",
                url: "/dashboard/hr/employee/salary/" + id,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                    };
                },
                success:function(data){
                    hourly_rate_value = (data.salary / (30 * 24))
                    daily_rate_value = (data.salary / 30)
                }
            });
        }

    }
    late_employee.change(function (){
        let id = late_employee.val();
        salaryAjax(id);
        setTimeout(function(){
                calculateLateAmount(hourly_rate_value);
            }, 500
        );
    });
    absent_employee.change(function (){
        let id = absent_employee.val();
        salaryAjax(id)
        setTimeout(function(){
            calculateAbsentAmount(daily_rate_value);
            }, 500
        );
    });
    $("input[name='hours'],input[name='minutes']").focusout(function(){
        calculateLateAmount(hourly_rate_value);
    });

    function calculateLateAmount(hourly_rate_value){
        let minutes_rate = hourly_rate_value / (60)
        let amount = (hours_field.val() * hourly_rate_value) + (minutes_field.val() * minutes_rate)
        $('#hourly_rate_field').val(hourly_rate_value);
        $("#late_amount").val(amount);
    }
    function calculateAbsentAmount(daily_rate_value){
        $('#daily_rate_field').val(daily_rate_value);
        $("#absent_amount").val(daily_rate_value);
    }
    $(".month_pic").focusout(function(){
        console.log()
        if($(this).val() != ''){
            let month = parseInt($(this).val().split('-')[1]);
            $.ajax({
                method: "get",
                url: "/dashboard/hr/salary_reports/" + month + "/check_status",
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                    };
                },
                success:function(data){

                    let message1 = $("#message1");
                    let message2 = $("#message2");
                    switch (data.status){
                        case 2 :
                            message2.text("Cannot add / modify operations to an already issued payroll");
                            message1.text("");
                            break;

                        case 1 :
                            message1.text("you must reissue Salary report to see operations");
                            message2.text("");
                            break;
                        case 3 :
                            message1.text("you must reissue Salary report to see operations");
                            message2.text("");
                            break;
                        case 4 :
                            message1.text("you must reissue Salary report to see operations");
                            message2.text("");
                            break;

                        default :
                            message1.text("");
                            message2.text("");
                            break;

                    }
                }
            });
        }
    });
});
