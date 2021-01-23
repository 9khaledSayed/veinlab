"use strict";
// Class definition
var datatable;
var KTUserListDatatable = function() {
    // Private functions
    var messages = {
        'ar': {
            'Employee Name': "اسم الموظف",
            'Time In': "وقت الحضور",
            'Reason' : 'السبب',
            'Effective Date' : 'تاريخ تطبيق العملية',
            'Amount' : 'المبلغ',
            'Status' : 'الحالة',
            'Details' : 'تفاصيل',
            'Approved' : 'معتمد',
            'Cancelled' : 'ملغي',
            'Actions': "الاجراءات",
            'Employee Number':"الرقم الوظيفي",
            'Operation Date':"تاريخ العملية",
            'Employee':"الموظف",
            'Notes':"ملاحظات",
            'Created Date':"تاريخ الاضافة",
            'Modified Date':"تاريخ اخر تعديل",
            'Approve':"اعتماد",
            'Cancel':"الغاء",
            'Close':"اغلاق",
            'Are you sure to Approve this additions?':"متاكد من اعتماد هذا الاضافة ؟",
            'Are you sure to Cancel this additions?':"متاكد من الغاء هذا الاضافة ؟",
            'Yes, Confirm!':"نعم تاكيد",
            'No, back':"لا الغ",
            'Loading...':"انتظار",
            'Error!':"خطأ!",
            'Cancelled successfully!':"تم الغاء الاضافة !",
            'Approved successfully!':"تم اعتماد الاضافة !",
        }
    };
    var locator = new KTLocator(messages);
    // basic demo


    // init
    var init = function() {
        // init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable
        datatable = $('#kt_apps_user_list_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: '/dashboard/hr/loans',
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: false,
                serverSorting: true,
                saveState: {
                    cookie: true,
                    webstorage: true,
                },
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: true, // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#generalSearch'),
                delay: 400,
            },
            rows: {
                afterTemplate: function (row, data, index) {
                    row.find('.cancel-item').on('click', function () {
                        swal.fire({
                            buttonsStyling: false,

                            html: locator.__("Are you sure to Cancel this additions?"),
                            type: "info",

                            confirmButtonText: locator.__("Yes, Confirm!"),
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                            showCancelButton: true,
                            cancelButtonText: locator.__("No, back"),
                            cancelButtonClass: "btn btn-sm btn-bold btn-default"
                        }).then(function (result) {
                            if (result.value) {
                                swal.fire({
                                    title: locator.__('Loading...'),
                                    onOpen: function () {
                                        swal.showLoading();
                                    }
                                });
                                $.ajax({
                                    method: 'get',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: '/dashboard/hr/additions/cancel/' + data.id ,
                                    error: function (err) {
                                        if (err.hasOwnProperty('responseJSON')) {
                                            if (err.responseJSON.hasOwnProperty('message')) {
                                                swal.fire({
                                                    title: locator.__('Error!'),
                                                    text: err.responseJSON.message,
                                                    type: 'error'
                                                });
                                            }
                                        }
                                        console.log(err);
                                    }
                                }).done(function (res) {
                                    swal.fire({
                                        title: locator.__('Cancelled successfully!'),
                                        // text: locator.__(res.message),
                                        type: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: locator.__("OK"),
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    });
                                    setTimeout(location.reload(),2000);

                                });
                            }
                        });
                    });
                    row.find('.update-item').on('click', function () {
                        swal.fire({
                            buttonsStyling: false,

                            html: locator.__("Are you sure to Approve this additions?"),
                            type: "info",

                            confirmButtonText: locator.__("Yes, Confirm!"),
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                            showCancelButton: true,
                            cancelButtonText: locator.__("No, back"),
                            cancelButtonClass: "btn btn-sm btn-bold btn-default"
                        }).then(function (result) {
                            if (result.value) {
                                swal.fire({
                                    title: locator.__('Loading...'),
                                    onOpen: function () {
                                        swal.showLoading();
                                    }
                                });
                                $.ajax({
                                    method: 'get',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: '/dashboard/hr/additions/update/' + data.id ,
                                    error: function (err) {
                                        if (err.hasOwnProperty('responseJSON')) {
                                            if (err.responseJSON.hasOwnProperty('message')) {
                                                swal.fire({
                                                    title: locator.__('Error!'),
                                                    text: err.responseJSON.message,
                                                    type: 'error'
                                                });
                                            }
                                        }
                                        console.log(err);
                                    }
                                }).done(function (res) {
                                    swal.fire({
                                        title: locator.__('Approved successfully!'),
                                        // text: locator.__(res.message),
                                        type: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: locator.__("OK"),
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    });
                                    setTimeout(location.reload(),2000);

                                });
                            }
                        });
                    });
                }
            },

            // columns definition
            columns: [{
                field: "employee.fname_arabic",
                title: locator.__("Employee Name"),
                width: 200,
                // callback function support for column rendering
                template: function(data) {
                    var output = '';
                    var stateNo = KTUtil.getRandomInt(0, 6);
                    var states = [
                        'success',
                        'brand',
                        'danger',
                        'success',
                        'warning',
                        'primary',
                        'info'
                    ];
                    var state = states[stateNo];
                    let employee = data.employee
                    let name =   employee.fname_arabic
                    if ( ! employee.mname_arabic)
                    {
                        name =   employee.fname_arabic + ' ' + employee.lname_arabic
                    }else
                    {
                        name =  employee.fname_arabic + ' ' + employee.mname_arabic + ' ' + employee.lname_arabic
                    }
                    output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.employee.fname_arabic.substring(0, 2) + '</div>\
								</div>\
								<div class="kt-user-card-v2__details">\
									<a href="#" class="kt-user-card-v2__name">' + data.employee.emp_num + ' - ' + name + '</a>\
								</div>\
							</div>';
                    return output;
                }
            }, {
                field: 'reason',
                title: locator.__('Reason'),
                template: function(row) {
                    var stateNo = KTUtil.getRandomInt(0, 6);
                    var states = [
                        'success',
                        'brand',
                        'danger',
                        'success',
                        'warning',
                        'primary',
                        'info'
                    ];
                    var state = states[stateNo];
                    return '<span class="kt-badge kt-badge--' + state + ' kt-badge--inline kt-badge--pill">' + row.reason + '</span>';
                },
            }, {
                field: 'effective_date',
                title: locator.__('Effective Date'),
            }, {
                field: 'amount',
                title: locator.__('Amount'),
            }, {
                field: 'status',
                title: locator.__('Status'),
                template: function(row) {
                    var status = {
                        1: {'title': locator.__('Approved'), 'class': ' kt-badge--success'},
                        2: {'title': locator.__('Cancelled'), 'class': ' kt-badge--danger'},
                    };
                    return '<span class="kt-badge ' + status[row.status].class + ' kt-badge--inline kt-badge--pill">' + status[row.status].title + '</span>';
                },
            }, {
                field: "Actions",
                width: 80,
                title: locator.__("Actions"),
                sortable: false,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
                    let employee = row.employee;
                    var status = {
                        1: {'title': ('Approved'), 'class': ' kt-font-success'},
                        2: {'title': ('Cancelled'), 'class': ' kt-font-danger'},
                    };
                    if(row.notes == null){
                        row.notes = '';
                    }
                    let output = '<div class="modal fade" id="kt_' + row.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\
                                    <div class="modal-dialog modal-lg" role="document">\
                                        <div class="modal-content">\
                                            <div class="modal-header">\
                                                <h5 class="modal-title" id="exampleModalLabel">' + locator.__('Details') + '</h5>\
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>\
                                            </div>\
                                            <div class="modal-body">\
                                                <!--begin::Form-->\
                                                <form class="kt-form kt-form--label-right">\
                                                    <div class="kt-portlet__body">\
                                                        <div class="kt-section kt-section--first">\
                                                            <div class="kt-section__body">\
                                                            <div class="kt-section__content kt-section__content--border">\
                                                                <div class="form-group row ">\
                                                                    <div class="col-lg-3">\
                                                                        <label class="">' + locator.__('Employee Number') + ':</label>\
                                                                        <div class="">\
                                                                            <p class="form-control border-0 m-0">' + employee.emp_num + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                   <div class="col-lg-5">\
                                                                        <label>' + locator.__('Name') + ':</label>\
                                                                        <div>\
                                                                            <p class="form-control border-0 m-0">' + employee.fname_arabic + ' ' + employee.lname_arabic + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                    <div class="col-lg-4">\
                                                                        <label>' + locator.__('Joined Date') + ':</label>\
                                                                        <div>\
                                                                            <p class="form-control border-0 m-0">' + employee.joined_date + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                    <div class="col-lg-3">\
                                                                        <label>' + locator.__('Department/Section') + ':</label>\
                                                                        <div>\
                                                                            <p class="form-control border-0 m-0">' + employee.roles[0].name + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="kt-section__content kt-section__content--border">\
                                                                <div class="form-group row">\
                                                                    <div class="col-lg-4">\
                                                                        <label>' + locator.__('Number of months') + ':</label>\
                                                                        <div>\
                                                                            <p class="form-control border-0 m-0">' + row.num_of_months + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                    <div class="col-lg-4">\
                                                                        <label>' + locator.__('Start Date') + ':</label>\
                                                                        <div>\
                                                                            <p class="form-control border-0 m-0">' + row.effective_date + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                    <div class="col-lg-4">\
                                                                        <label>' + locator.__('Status') + ':</label>\
                                                                        <div>\
                                                                            <p class="form-control border-0 m-0 ' + status[row.status].class + '">' + status[row.status].title + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                    <div class="col-lg-4">\
                                                                        <label>' + locator.__('Amount') + ':</label>\
                                                                        <div>\
                                                                            <p class="form-control border-0 m-0"> ' + row.amount + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            </div>\
                                                            <div class="kt-section__content kt-section__content--border">\
                                                                <div class="form-group row ">\
                                                                    <div class="col-lg-6">\
                                                                        <label>' + locator.__('Created Date') + ':</label>\
                                                                        <div>\
                                                                            <p class="form-control border-0 m-0">' + row.created_at + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                    <div class="col-lg-6">\
                                                                        <label >' + locator.__('Modified Date') + ':</label>\
                                                                        <div >\
                                                                            <p class="form-control border-0 m-0">' + row.updated_at + '</p>\
                                                                        </div>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                    <div class="kt-portlet__foot">\
                                                        <div class="kt-form__actions">\
                                                            <div class="row">\
                                                                <div class="col-lg-6 text-center">\
                                                                    <a href="#" class="btn btn-success btn-wide update-item" style="width: 80%">' + locator.__('Approve') + '</a>\
                                                                </div>\
                                                                <div class="col-lg-6 text-center">\
                                                                    <a href="#" class="btn btn-warning btn-wider cancel-item" style="width: 80%">' + locator.__('Cancel') + '</a>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </form>\
                                                </div>\
                                            <div class="modal-footer">\
                                                <button type="button" class="btn btn-danger" id="close" data-dismiss="modal"><i class="fa fa-ban"></i>' +  locator.__('Close') + '</button>\
                                            </div>\
                                        </div>\
                                    </div>\
                                  </div>';
                    return output + '\
							<a class="btn btn-sm btn-outline-primary" href="#" data-toggle="modal" data-target="#kt_' + row.id + '">\
                                <i class="fa fa-info"></i>'+ locator.__('Details') + '\
                            </a>\
						';
                },
            }]
        });
    }

    // search
    var search = function() {

        $('#kt_form_status').on('change', function() {
            var value = $(this).val();
            datatable.search(value, 'status');
        });

        $('#kt_form_date').on('change', function() {
            var current_datetime = new Date()

            var dd = current_datetime.getDate();
            var mm = current_datetime.getMonth()+1;
            var yyyy = current_datetime.getFullYear();

            if(dd<10)
            {
                dd='0'+dd;
            }

            if(mm<10)
            {
                mm='0'+mm;
            }

            var value = $(this).val();

            switch (value) {
                case '1': // today
                    var currentDate = yyyy + '-' + mm + '-' + dd ;
                    datatable.search(currentDate, 'effective_date');

                    break;
                case '2':
                    current_datetime.setDate(current_datetime.getDate() - 7);
                    datatable.search(current_datetime.toDateString(), 'effective_date');
                    break;
                case '3':
                    current_datetime.setMonth(current_datetime.getMonth() - 1);
                    datatable.search(current_datetime.toLocaleString('default', { month: 'short' }), 'effective_date');
                    break;
                case '4':
                    current_datetime.setFullYear(current_datetime.getFullYear() - 1);
                    datatable.search(current_datetime.toLocaleString('default', { month: 'short' }), 'effective_date');
                    break;
                default:
                    datatable.search($(this).val().toLowerCase(), 'effective_date');
            }
        });

    }

    $('#kt_form_status , #kt_form_date').selectpicker();

    // selection
    var selection = function() {
        // init form controls
        //$('#kt_form_status, #kt_form_type').selectpicker();

        // event handler on check and uncheck on records
        datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',	function(e) {
            var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes(); // get selected records
            var count = checkedNodes.length; // selected records count

            $('#kt_subheader_group_selected_rows').html(count);

            if (count > 0) {
                $('#kt_subheader_search').addClass('kt-hidden');
                $('#kt_subheader_group_actions').removeClass('kt-hidden');
            } else {
                $('#kt_subheader_search').removeClass('kt-hidden');
                $('#kt_subheader_group_actions').addClass('kt-hidden');
            }
        });
    }

    // fetch selected records
    var selectedFetch = function() {
        // event handler on selected records fetch modal launch
        $('#kt_datatable_records_fetch_modal').on('show.bs.modal', function(e) {
            // show loading dialog
            var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
            loading.show();

            setTimeout(function() {
                loading.hide();
            }, 1000);

            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
                return $(chk).val();
            });

            // populate selected IDs
            var c = document.createDocumentFragment();

            for (var i = 0; i < ids.length; i++) {
                var li = document.createElement('li');
                li.setAttribute('data-id', ids[i]);
                li.innerHTML = 'Selected record ID: ' + ids[i];
                c.appendChild(li);
            }

            $(e.target).find('#kt_apps_user_fetch_records_selected').append(c);
        }).on('hide.bs.modal', function(e) {
            $(e.target).find('#kt_apps_user_fetch_records_selected').empty();
        });
    };

    // selected records status update
    var selectedStatusUpdate = function() {
        $('#kt_subheader_group_actions_status_change').on('click', "[data-toggle='status-change']", function() {
            var status = $(this).find(".kt-nav__link-text").html();

            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
                return $(chk).val();
            });

            if (ids.length > 0) {
                // learn more: https://sweetalert2.github.io/
                swal.fire({
                    buttonsStyling: false,

                    html: "Are you sure to update " + ids.length + " selected records status to " + status + " ?",
                    type: "info",

                    confirmButtonText: "Yes, update!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-default"
                }).then(function(result) {
                    if (result.value) {
                        swal.fire({
                            title: 'Deleted!',
                            text: 'Your selected records statuses have been updated!',
                            type: 'success',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        })
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: 'You selected records statuses have not been updated!',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });
                    }
                });
            }
        });
    }

    // selected records delete
    var selectedDelete = function() {
        $('#kt_subheader_group_actions_delete_all').on('click', function() {
            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
                return $(chk).val();
            });

            if (ids.length > 0) {
                // learn more: https://sweetalert2.github.io/
                swal.fire({
                    buttonsStyling: false,

                    text: "Are you sure to delete " + ids.length + " selected records ?",
                    type: "danger",

                    confirmButtonText: "Yes, delete!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-danger",

                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-brand"
                }).then(function(result) {
                    if (result.value) {
                        swal.fire({
                            title: 'Deleted!',
                            text: 'Your selected records have been deleted! :(',
                            type: 'success',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        })
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: 'You selected records have not been deleted! :)',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });
                    }
                });
            }
        });
    }

    var updateTotal = function() {
        datatable.on('kt-datatable--on-layout-updated', function () {
            //$('#kt_subheader_total').html(datatable.getTotalRows() + ' Total');
        });
    };

    return {
        // public functions
        init: function() {
            init();
            search();
            selection();
            selectedFetch();
            selectedStatusUpdate();
            selectedDelete();
            updateTotal();
        },
    };
}();

// On document ready
KTUtil.ready(function() {
    KTUserListDatatable.init();
});
