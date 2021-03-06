"use strict";
// Class definition
var datatable;
var KTUserListDatatable = function() {
    // Private functions
    var messages = {
        'ar': {
            'Employee Name': "اسم الموظف",
            'Status' : 'الحالة',
            'Details' : 'تفاصيل',
            'Approved' : 'معتمد',
            'To Date' : 'الي تاريخ',
            'From Date' : 'من تاريخ',
            'Employee' : 'الموظف',
            'Cancelled' : 'ملغي',
            'Actions': "الاجراءات",
            'Employee Number':"الرقم الوظيفي",
            'Notes':"ملاحظات",
            'Created':"تاريخ الاضافة",
            'Updated':"تاريخ اخر تعديل",
            'Approve':"اعتماد",
            'Cancel':"الغاء",
            'Close':"اغلاق",
            'Are you sure ?':"متاكد من اعتماد هذا الحسم ؟",
            'Yes, Confirm!':"نعم تاكيد",
            'No, back':"لا الغ",
            'Loading...':"انتظار",
            'Error!':"خطأ!",
            'Cancelled successfully!':"تم الغاء الحسم !",
            'Approved successfully!':"تم اعتماد الحسم !",
        }
    };
    var locator = new KTLocator(messages);
    // basic demo
    // variables


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
                        url: '/dashboard/hr/decisions/suspended_employees',
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

                            html: locator.__("Are you sure to Cancel this deduction?"),
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
                                    url: '/dashboard/hr/deductions/cancel/' + data.id ,
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

                            html: locator.__("Are you sure to Approve this deduction?"),
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
                                    url: '/dashboard/hr/deductions/update/' + data.id ,
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
                width: 150,
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

                    output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.employee.fname_arabic.substring(0, 2) + '</div>\
								</div>\
								<div class="kt-user-card-v2__details">\
									<a href="#" class="kt-user-card-v2__name">' + data.employee.emp_num + ' - ' + data.employee.fname_arabic + '</a>\
								</div>\
							</div>';
                    return output;
                }
            }, {
                field: 'from_date',
                title: locator.__('From Date'),
            }, {
                field: 'to_date',
                title: locator.__('To Date'),
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
                title: locator.__("Actions"),
                sortable: false,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
                    return '\
		                  <button data-record-id="' + row.id + '" class="btn btn-sm btn-default btn-font-sm" title="Edit details">\
		                      <i class="flaticon2-document"></i> ' + locator.__('Details') +'\
		                  </button>';
                },
            }]
        });
        datatable.on('click', '[data-record-id]', function() {
            modalSubRemoteDatatable($(this).data('record-id'));
            $('#kt_modal_sub_KTDatatable_remote').modal('show');
        });
    }

    // search
    var search = function() {
        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val(), 'status');
        });

        $('#kt_form_date').on('change', function() {
            var current_datetime = new Date()
            var value = $(this).val();
            switch (value) {
                case '1': // today
                    datatable.search(current_datetime.toDateString(), 'created_at');
                    break;
                case '2':
                    current_datetime.setDate(current_datetime.getDate() - 7);
                    datatable.search(current_datetime.toDateString(), 'created_at');
                    break;
                case '3':
                    current_datetime.setMonth(current_datetime.getMonth() - 1);
                    datatable.search(current_datetime.toLocaleString('default', { month: 'short' }), 'created_at');
                    break;
                default:
                    datatable.search($(this).val().toLowerCase(), 'created_at');
            }
        });


        $('#kt_form_date, #kt_form_status').selectpicker();
    }

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

    var modalSubRemoteDatatable = function(id) {
        var el = $('#modal_sub_datatable_ajax_source');
        var content = ''
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            method: "get",
            url: "/dashboard/hr/decisions/suspend_employee/" + id,
            data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                };
            },
            success:function(data){
                let employee = data.employee;
                let status = (data.status == 1)? locator.__('Approved') : locator.__('Cancelled');
                content = '<div class="modal-header">\
                            <h3 class="modal-title">\
                                ' + locator.__('Details') + '\
                            </h3>\
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>\
                        </div>\
                        <div class="modal-body">\
                            <div id="details-div">\
                    <div class="row">\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="Employee.EmployeeNumber"><strong>' + locator.__('Employee Number') + '</strong></label><p>' + data.employee.emp_num + '</p></div>\
                        </div>\
                        <div class="col-md-6">\
                            <div class="form-group">\
                            <label for="Employee.FullName"><strong>' + locator.__('Employee') + '</strong></label>\
                                <p>' + data.employee.fname_arabic + ' ' + data.employee.lname_arabic +'</p>\
                            </div>\
                        </div>\
                    </div>\
                    <div class="row">\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="StartDate"><strong>' + locator.__('From Date') + '</strong></label><p>' + data.from_date + '</p></div>\
                        </div>\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="EndDate"><strong>' + locator.__('To Date') + '</strong></label><p>' + data.to_date + '</p></div>\
                        </div>\
                    </div>\
                    <div class="kt-separator kt-separator--dashed"></div>\
                    <div class="row">\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="ModifiedDate"><strong>' + locator.__('Updated') + '</strong></label><p>' + data.updated_at + '</p></div>\
                        </div>\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="CreatedDate"><strong>' + locator.__('Created') + '</strong></label><p>' + data.created_at + '</p></div>\
                        </div>\
                    </div>\
                    <div class="kt-separator kt-separator--dashed"></div>\
                    <div class="row">\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="Note"><strong>' + locator.__('Notes') + '</strong></label><p>-</p></div>\
                        </div>\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="Status"><strong>' + locator.__('Status') + '</strong></label><p>' + status + '</p></div>\
                        </div>\
                    </div>\
                    <div class="kt-separator kt-separator--dashed"></div>\
                    <div class="row">\
                        <div class="col">\
                            <a class="btn btn-sm btn-block btn-success" href="/dashboard/hr/decisions/suspend_employee/approve/' + data.id +'">\
                                ' + locator.__('Approve') + '\
                            </a>\
                        </div>\
                        <div class="col">\
                            <a class="btn btn-sm btn-block btn-warning " href="/dashboard/hr/decisions/suspend_employee/cancel/' + data.id +'">\
                                ' + locator.__('Cancel') + '\
                            </a>\
                        </div>\
                    </div>\
                    </div>\
                        </div>\
                        <div class="modal-footer">\
                            <button class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i>' + locator.__('Close') + '</button>\
                        </div>';
            }
        });

        var datatable = '';
        setTimeout(function(){
                datatable = el.html(content);
            }, 300
        );



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
