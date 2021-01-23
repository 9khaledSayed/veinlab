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
            'Cancelled' : 'ملغي',
            'Actions': "الاجراءات",
            'Employee Number':"الرقم الوظيفي",
            'Employee':"الموظف",
            'Notes':"ملاحظات",
            'Decision No':"رقم القرار",
            'Created Date':"تاريخ الاضافة",
            'Modified Date':"تاريخ اخر تعديل",
            'Approve':"اعتماد",
            'Service Termination':"قرار نهاية خدمة",
            'Salary Suspend':"قرار ايقاف الراتب",
            'Decision Type':"نوع القرار",
            'Cancel':"الغاء",
            'Close':"اغلاق",

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
                        url: '/dashboard/hr/decisions/my_decisions',
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

            // columns definition
            columns: [
                {
                    field: 'id',
                    title: locator.__('Decision No'),
                    width: 80
                },
                {
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
                field: 'created_at',
                title: locator.__('Created Date'),
            }, {
                field: 'type',
                title: locator.__('Decision Type'),
                template: function(row) {
                    var type = {
                        1: {'title': locator.__('Service Termination'), 'class': ''},
                        2: {'title': locator.__('Salary Suspend'), 'class': ''},
                    };
                    return '<span class="kt-badge ' + type[row.type].class + ' kt-badge--inline kt-badge--pill">' + type[row.type].title + '</span>';
                }
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

        $('#kt_form_decision').on('change', function() {
            datatable.search($(this).val(), 'type');
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

        $('#kt_form_date , #kt_form_status , #kt_form_decision').selectpicker();
    }



    var updateTotal = function() {
        datatable.on('kt-datatable--on-layout-updated', function () {
            //$('#kt_subheader_total').html(datatable.getTotalRows() + ' Total');
        });
    };

    var modalSubRemoteDatatable = function(id) {
        var el = $('#modal_sub_datatable_ajax_source');
        var type = {
            1: {'title': locator.__('Service Termination')},
            2: {'title': locator.__('Salary Suspend')},
        };

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
                let notes = (data.notes == null)? '': data.notes;
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
                    <div class="kt-separator kt-separator--dashed"></div>\
                    <div class="row">\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="ModifiedDate"><strong>' + locator.__('Decision Type') + '</strong></label><p>' + type[data.type].title + '</p></div>\
                        </div>\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="CreatedDate"><strong>' + locator.__('Created Date') + '</strong></label><p>' + data.created_at + '</p></div>\
                        </div>\
                    </div>\
                    <div class="kt-separator kt-separator--dashed"></div>\
                    <div class="row">\
                        <div class="col-md-6">\
                            <div class="form-group"><label for="Note"><strong>' + locator.__('Notes') + '</strong></label><p>' + notes + '</p></div>\
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
