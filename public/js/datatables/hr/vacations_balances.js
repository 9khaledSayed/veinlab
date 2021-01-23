"use strict";
// Class definition

var KTDatatableLocalSortDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Date': "تاريخ اﻹنشاء",
            "Actions": "الاجراءات",
            'Total Price': "السعر الكلي",
            'Load sub table': "اعرض الجدول الفرعي",
            'Are you sure to cancel this request?': "هل انت متأكد أنك تريد الغاء هذا الطلب؟",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'Yes, Cancel!': "نعم الغ!",
            'No': "لا",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Deleted!': "تم المسح!",
            'Show': "عرض",
            'edit': "تعديل",
            'delete': "مسح",
            'salary induction request' : "طلب تعريف بالراتب",
            'vacation request' : "طلب اجازه",
            'leave request' : "طلب استئذان",
            'trip request' : "طلب رحله عمل",
            'loan request' : "طلب سلفه",
            'complaint request' : "طلب شكوي",
            'Pending':"انتظار المدير",
            "Employee" :"الموظف",
            "Vacation Type" : "نوع الاجازه",
            "Status":"الحاله",
            "Agree":"تمت الموافقه",
            "Disagree":"تم الرفض",
            "no comment yet":"لا يوجد تعليقات بعد",
            "Start Date":"تاريخ البدايه",
            "End Date":"تاريخ النهايه",
            "Days":"الأيام المتبقيه",
            "Year":"السنه",
            "Carried Days":"الأيام المرحله",
            "Balance": "الرصيد"
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
                        url: '/dashboard/hr/vacations/balances',
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
                delay: 400,
            }, rows: {
                afterTemplate: function (row, data, index) {
                    row.find('.cancel_request').on('click', function () {
                        swal.fire({
                            buttonsStyling: false,

                            html: locator.__("Are you sure to cancel this request?"),
                            type: "info",

                            confirmButtonText: locator.__("Yes, Cancel!"),
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                            showCancelButton: true,
                            cancelButtonText: locator.__("No"),
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
                                    url: '/dashboard/stock/' + data.id,
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
                    field: 'employee.fname_arabic',
                    title: locator.__('Employee'),
                    textAlign: 'center',
                    template: function(row) {

                        if ( ! row.employee.mname_arabic)
                        {
                            return  row.employee.fname_arabic + ' ' + row.employee.lname_arabic
                        }else
                        {
                            return  row.employee.fname_arabic + ' ' + row.employee.mname_arabic + ' ' + row.employee.lname_arabic
                        }
                    },
                },{
                    field: 'vacation_type.name',
                    title: locator.__('Vacation Type'),
                    textAlign: 'center',

                },{
                    field: 'year',
                    title: locator.__('Year'),
                    textAlign: 'center',
                },{
                    field: 'no_days',
                    title: locator.__('Days'),
                    textAlign: 'center',

                },{
                    field: 'no_days_carried',
                    title: locator.__('Carried Days'),
                    textAlign: 'center',

                },  {
                    field: 'Actions',
                    title: locator.__('Actions'),
                    sortable: false,
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    textAlign: 'center',
                    template: function(raw) {

                        var modalID        = "myModal" + raw.id


                        return '\
                        \    <div  class="modal fade" role="dialog" id = '+ modalID +' >\
                                    <div class="modal-dialog">\
                            \
                                        <!-- Modal content-->\
                                        <div class="modal-content">\
                                            <div class="modal-header">\
                                                <h4 class="modal-title"> رصيد أجازات الموظفين \
                                                </h4>\
                                                <button type="button" class="close" data-dismiss="modal"></button>\
                                            </div>\
                                            <div class="modal-body">\
                                                <div class="kt-section__content kt-section__content--border">\
                            \
                            \
                                                    <div class="row">\
                                                        <div class="col-md-4">\
                                                            <div class="form-group"><label for="Request.CreatedDate"><strong>الموظف</strong></label><p> ' + raw.employee.fname_arabic  +'</p></div>\
                                                        </div>\
                                                        <div class="col-md-4">\
                                                            <div class="form-group"><label for="Request.CreatedDate"><strong>السنه</strong></label><p>'+ raw.year +'</p></div>\
                                                        </div>\
                                                        <div class="col-md-4">\
                                                            <div class="form-group"><label for="Request.RequestType"><strong>نوع الأجازه</strong></label><p> ' + raw.vacation_type.name + ' </p></div>\
                                                        </div>\
                                                    </div>\
                                                    <hr>\  \
                                                    \   <div class="row">\
                                                        <div class="col-6">\
                                                            <div class="form-group"><label for="Request.CreatedDate"><strong> ' + locator.__('Days') + ' </strong></label><p> ' + raw.no_days +'</p></div>\
                                                        </div>\
                                                        <div class="col-6">\
                                                            <div class="form-group"><label for="Request.RequestType"><strong> ' + locator.__('Carried Days') + ' </strong></label><p> ' + raw.no_days_carried + ' </p></div>\
                                                        </div>\
                                                    </div>\
                            \
                            \
                                                    <div class="kt-section__content kt-section__content--border" data-select2-id="8">\
                                                        <!-- Begin Action Form-->\
                            \
                            \
                                                    </div>\
                            \
                                                </div>\
                                            </div>\
                                            <div class="modal-footer">\
                                                <div class="kt-form__acdtions">\
                            \
                                                    <a href="/" class="btn btn-secondary" data-dismiss="modal">\
                                                        اغلاق\
                                                    </a>\
                                                </div>\
                                            </div>\
                                        </div>\
                            \
                                    </div>\
                                </div>\
                            <button type="button"  class="btn btn-sm btn-default btn-font-sm" data-toggle="modal" data-target= ' + "#" + modalID +' ><i class="flaticon2-document"></i>' + locator.__('Show') + '</button>\
                        ';


                    },
                }],
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
                case '4':
                    current_datetime.setFullYear(current_datetime.getFullYear() - 1);
                    datatable.search(current_datetime.toLocaleString('default', { month: 'short' }), 'created_at');
                    break;
                default:
                    datatable.search($(this).val().toLowerCase(), 'created_at');
            }
        });

        $('#kt_form_date').selectpicker();

        $('#kt_form_vacation').on('change', function() {

            var value = $(this).val();

            datatable.search(value, 'vacation_type.name');

        });

        $('#kt_form_vacation').selectpicker();


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
