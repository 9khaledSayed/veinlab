"use strict";

// Class definition
var KTContactsAdd = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
	var avatar;

    let messages = {
        'ar': {
            "please fill the required data":"الرجاء مليء الحقول المطلوبة",
            "The operation has been done successfully !":"لقد تمت العملية بنجاح !",
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
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				// Step 1
                fname_arabic: {
					required: true
				},
                lname_arabic: {
					required: true,
				},
                fname_english: {
					required: true
				},
                lname_english: {
					required: true
				},
                birthdate: {
					required: true,
                    date:true
				},
                nationality_id: {
					required: true
				},
                id_num: {
					required: true,
                    number: true
				},
                emp_num: {
					required: true
				},
                joined_date: {
					required: true,
                    date:true
				},
                role_id: {
					required: true
				},
                branch_id: {
					required: true
				},
                contract_type: {
					required: true
				},
                start_date: {
					required: true,
                    date:true
				},
                contract_period: {
					required: true,
                    number:true,
				},
                phone: {
					required: true,
				},
                email: {
					required: true,
					email: true
				},
                password: {
					required: false,
				},
                password_confirmation: {
					required: false,
				},
                basic_salary: {
					required: true
				}
			},

			// Display error
			invalidHandler: function(event, validator) {
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
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');

		btn.on('click', function(e) {
			e.preventDefault();

			if (validator.form()) {
				// See: src\js\framework\base\app.js
				KTApp.progress(btn);
				//KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					success: function(response) {
						KTApp.unprogress(btn);
						//KTApp.unblock(formEl);
                        if(response.status == 3){
                            swal.fire({
                                "title": "",
                                "text": response.message,
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }else{
                            swal.fire({
                                "title": "",
                                "text": locator.__("The operation has been done successfully !"),
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            }).then(function (){
                                window.location.replace("/dashboard/hr/employees");
                            });
                        }

					}
					,error:function (err){
                        KTApp.unprogress(btn);
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
			formEl = $('#kt_contacts_add_form');

			initWizard();
			initValidation();
			initSubmit();
			initAvatar();
		}
	};
}();

jQuery(document).ready(function() {
    let select_contract = $("select[name='contract_type']");
    $('.kt-selectpicker').selectpicker();
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
    // enable clear button
    $('.datepicker').datepicker({
        rtl: KTUtil.isRTL(),
        todayBtn: "linked",
        format:'yyyy-mm-dd',
        clearBtn: true,
        todayHighlight: true,
        templates: arrows
    });
    if(select_contract.val() == 1){
        $('#period').hide()
    }
    select_contract.change(function (){
        if($(this).val() == 1){
            $('#period').hide()
        }else{
            $('#period').show()
        }
    })
	KTContactsAdd.init();
});
