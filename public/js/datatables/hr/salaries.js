"use strict";
// Class definition

var KTDatatableLocalSortDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Employee': "الموظف",
            "Total Additions":"اجمالي الاضافي",
            "Total Deductions":"إجمالي الحسومات",
            "Net Salary":"صافي الراتب",
            "Net Pay":"صافي المبلغ",
            "Total Days":"ايام العمل",
            "Actions":"اجراءات",
            "Details":"التفاصيل",
            "Basic Salary":"الراتب الاساسي",
            "Payslip Details":"تفاصيل مسير الراتب",
            "Close":"اغلاق",
        }
    };

    var locator = new KTLocator(messages);

    // basic demo
    var demo = function() {

        var datatable = $('.kt-datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: '/dashboard/hr/salary_reports/' + salary_report_id,
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
                footer: false, // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#generalSearch'),
            }, rows: {
                afterTemplate: function (row, data, index) {
                    row.find('.delete-item').on('click', function () {
                        swal.fire({
                            buttonsStyling: false,

                            html: locator.__("Are you sure to delete this item?"),
                            type: "info",

                            confirmButtonText: locator.__("Yes, Delete!"),
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                            showCancelButton: true,
                            cancelButtonText: locator.__("No, cancel"),
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
                                    method: 'DELETE',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: '/dashboard/home_visits/' + data.id,
                                    error: function (err) {
                                        if (err.hasOwnProperty('responseJSON')) {
                                            if (err.responseJSON.hasOwnProperty('message')) {
                                                swal.fire({
                                                    title: locator.__('Error!'),
                                                    text: locator.__(err.responseJSON.message),
                                                    type: 'error'
                                                });
                                            }
                                        }
                                        console.log(err);
                                    }
                                }).done(function (res) {
                                    swal.fire({
                                        title: locator.__('Deleted!'),
                                        text: locator.__(res.message),
                                        type: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: locator.__("OK"),
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    });
                                    datatable.reload();
                                });
                            }
                        });
                    });
                }
            },

            // columns definition
            columns: [
                {
                    field: "employee.fname_arabic",
                    title: locator.__("Employee"),
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
									<a href="#" class="kt-user-card-v2__name">' + name + '</a>\
									<span class="kt-user-card-v2__desc">' + data.employee.roles[0].name_arabic + '</span>\
								</div>\
							</div>';

                        return output;
                    }
                }, {
                    field: 'salary',
                    title: locator.__('Net Salary'),
                }, {
                    field: 'additions',
                    title: locator.__('Total Additions'),
                    template:function(row){
                       return '<span class="kt-font-success">' + row.additions + '</span>';

                    }
                }, {
                    field: 'deductions',
                    title: locator.__('Total Deductions'),
                    template:function(row){
                        return '<span class="kt-font-danger">' + row.deductions + '</span>';
                    }
                }, {
                    field: 'net_salary',
                    title: locator.__('Net Pay'),
                    template:function(row){
                        return '<span class="kt-font-primary">' + row.net_salary + '</span>';
                    }
                }, {
                    field: 'total_days',
                    title: locator.__('Total Days'),
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



        datatable.on('click', '[data-record-id]', function() {
            modalSubRemoteDatatable($(this).data('record-id'));
            $('#kt_modal_sub_KTDatatable_remote').modal('show');
        });
    };
    var modalSubRemoteDatatable = function(id) {
        var el = $('#modal_sub_datatable_ajax_source');
        var content = ''
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            method: "get",
            url: "/dashboard/hr/salaries/" + id,
            data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                };
            },
            success:function(data){
                var employee = data.employee
                content = '<div class="modal-header">\
                            <h3 class="modal-title">\
                                ' + locator.__('Payslip Details') + '\
                            </h3>\
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>\
                        </div>\
                        <div class="modal-body">\
                            <div id="payslip-details-div">\
                                <div class="kt-widget kt-widget--user-profile-1 employee-card employee-card-medium" style="padding-bottom:unset;">\
                                    <div class="kt-widget__head">\
                                        <div class="kt-widget__media">\
                                                <div class="kt-badge kt-badge--xl kt-badge--success">SA</div>\
                                            <div class="text-center kt-font-bold kt-margin-t-5">\
                                                ' + employee.emp_num + '\
                                            </div>\
                                        </div>\
                                        <div class="kt-widget__content">\
                                            <div class="kt-widget__section">\
                                                <a href="#" class="kt-widget__username">\
                                                    ' + employee.fname_arabic + ' ' + employee.lname_arabic +'\
                                                </a>\
                                                <span class="kt-widget__subtitle">\
                                                   ' + employee.roles[0].name + '\
                                                </span>\
                                                <span class="kt-widget__subtitle">\
                                                    ' + employee.joined_date + '\
                                                </span>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                                <hr>\
                                <div class="kt-widget4">\
                                    <div class="kt-widget4__item">\
                                        <span class="kt-widget4__icon">\
                                            <i class="fa fa-plus-circle kt-font-success"></i>\
                                        </span>\
                                        <a href="#" class="kt-widget4__title kt-widget4__title--light">\
                                            ' + locator.__('Basic Salary') + '\
                                        </a>\
                                        <span class="kt-widget4__number kt-font-success">\
                                            ' + employee.basic_salary + '\
                                        </span>\
                                    </div>\
                                </div>\
                                <div class="kt-widget kt-widget--user-profile-3">\
                                    <div class="kt-widget__bottom">\
                                        <div class="kt-widget__item">\
                                                <div class="kt-widget__icon">\
                                                    <i class="flaticon-coins"></i>\
                                                </div>\
                                                <div class="kt-widget__details">\
                                                    <span class="kt-widget__title">\
                                                        ' + locator.__('Net Salary') + '\
                                                    </span>\
                                                    <span class="kt-widget__value ">\
                                                        ' + data.salary +'\
                                                    </span>\
                                                </div>\
                                            </div>\
                                        <div class="kt-widget__item">\
                                            <div class="kt-widget__icon">\
                                                <i class="flaticon-coins kt-font-success"></i>\
                                            </div>\
                                            <div class="kt-widget__details">\
                                                <span class="kt-widget__title">\
                                                    ' + locator.__('Total Additions') + '\
                                                </span>\
                                                <span class="kt-widget__value kt-font-success">\
                                                    ' + data.additions +'\
                                                </span>\
                                            </div>\
                                        </div>\
                                        <div class="kt-widget__item">\
                                            <div class="kt-widget__icon">\
                                                <i class="flaticon-coins kt-font-danger"></i>\
                                            </div>\
                                            <div class="kt-widget__details">\
                                                <span class="kt-widget__title">\
                                                    ' + locator.__('Total Deductions') + '\
                                                </span>\
                                                <span class="kt-widget__value kt-font-danger">\
                                                    ' + data.deductions +'\
                                                </span>\
                                            </div>\
                                        </div>\
                                        <div class="kt-widget__item">\
                                            <div class="kt-widget__icon">\
                                                <i class="flaticon-coins kt-font-brand"></i>\
                                            </div>\
                                            <div class="kt-widget__details">\
                                                <span class="kt-widget__title">\
                                                    ' + locator.__('Net Pay') + '\
                                                </span>\
                                                <span class="kt-widget__value kt-font-brand">\
                                                    ' + data.net_salary +'\
                                                </span>\
                                            </div>\
                                        </div>\
                                        <div class="kt-widget__item">\
                                            <div class="kt-widget__icon">\
                                                <i class="flaticon-calendar"></i>\
                                            </div>\
                                            <div class="kt-widget__details">\
                                                <span class="kt-widget__title">\
                                                    ' + locator.__('Total Days') + '\
                                                </span>\
                                                <span class="kt-widget__value kt-font-brand">\
                                                    ' + data.total_days +'\
                                                </span>\
                                            </div>\
                                        </div>\
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
            }, 1000
        );



    };


    return {
        // public functions
        init: function() {
            demo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableLocalSortDemo.init();
});
