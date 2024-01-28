"use strict";
// Class definition

var KTDatatableLocalSortDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Item': "اسم المنتج",
            'Quantity': "الكمية",
            'Company': "الشركة",
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
            "Days":"الأيام",
            "Finished":"تم الرد"
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
                        url: '/dashboard/hr/vacations',
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
                    field: 'from_date',
                    title: locator.__('Start Date'),
                    textAlign: 'center',

                },{
                    field: 'to_date',
                    title: locator.__('End Date'),
                    textAlign: 'center',
                },{
                    field: 'id',
                    title: locator.__('Days'),
                    textAlign: 'center',
                    template: function(row) {
                        const date1 = new Date(row.from_date );
                        const date2 = new Date(row.to_date );
                        const diffTime = Math.abs(date2 - date1);
                        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        return diffDays;
                    },

                },{
                    field: 'status',
                    title: locator.__('Status'),
                    textAlign: 'center',
                    template: function(row) {
                        var status = {
                            0: {'title': locator.__('Pending'), 'class': ' kt-badge--danger'},
                            1: {'title': locator.__('Finished'), 'class': ' kt-badge--success'},
                        };
                        return '<span class="kt-badge ' + status[row.status].class + ' kt-badge--inline kt-badge--pill">' + status[row.status].title + '</span>';
                    },

                },{
                    field: 'created_at',
                    title: locator.__('Date'),
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

                        var status = {
                            0: {'title': locator.__('Pending'),
                                'cancelBtn':'<button type="submit" class="btn btn-danger cancel_request"  style="background-color:#C82333" data-dismiss="modal">الغاء</button>'
                            },
                            1: {'title': locator.__('Finished'),
                                'cancelBtn':'<button type="submit" class="btn btn-danger"  style="background-color:#C82333;display:none" data-dismiss="modal">الغاء</button>'
                            },
                        };
                        var status_name  = status[raw.status].title;
                        var cancelBtn    = status[raw.status].cancelBtn;

                        var response = {
                            0: {'title': locator.__('Pending')},
                            1: {'title': locator.__('Agree')},
                            2: {'title': locator.__('Disagree')},
                        };


                        var diffDays = 0;
                        if ( raw.type == 2)
                        {
                            const date1 = new Date(raw.from_date );
                            const date2 = new Date(raw.to_date );
                            const diffTime = Math.abs(date2 - date1);
                            diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        }

                        var request_body   =   '<div class="row">' +
                            '<div class="col-md-12">' +
                            '<div class="form-group">' +
                            '<label><strong>الحالة</strong></label>' +
                            '<p>' +
                            '<span class="kt-font-info"> <i class="flaticon2-hourglass-1"></i> ' + status_name + ' </span>'+
                            '</p>'+
                            '</div>'+
                            '<hr>'  +
                            '</div>'+

                            '<div class="col-md-3">' +
                            '<div class="form-group">'+
                            '<label><strong>نوع الاجازه</strong></label>' +
                            '<p>'+
                            '<span class="kt-font-info"> ' + raw.vacation_type.name + '</span>' +
                            '</p>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-3">' +
                            '<div class="form-group">'+
                            '<label><strong>تاريخ البدايه</strong></label>' +
                            '<p>'+
                            '<span class="kt-font-info"> ' + raw.from_date + '</span>' +
                            '</p>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-3">' +
                            '<div class="form-group">'+
                            '<label><strong>تاريخ النهايه</strong></label>' +
                            '<p>'+
                            '<span class="kt-font-info"> ' + raw.to_date + '</span>' +
                            '</p>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-3">' +
                            '<div class="form-group">'+
                            '<label><strong>عدد الأيام</strong></label>' +
                            '<p>'+
                            '<span class="kt-font-info"> ' + diffDays + '</span>' +
                            '</p>'+
                            '</div>'+
                            '</div>'+
                            '</div>';

                        var request_type   = locator.__('vacation request');
                        var modalID        = "myModal" + raw.id
                        var response_name  = response[raw.response].title;
                        var commentBody;

                        if ( raw.comment )
                        {
                            commentBody = raw.comment;
                        }else
                        {
                            commentBody = locator.__('no comment yet');
                        }
                        return '\
                        \    <div  class="modal fade" role="dialog" id = '+ modalID +' >\
                                    <div class="modal-dialog">\
                            \
                                        <!-- Modal content-->\
                                        <div class="modal-content">\
                                            <div class="modal-header">\
                                                <h4 class="modal-title">أجازات الموظفين\
                                                </h4>\
                                                <button type="button" class="close" data-dismiss="modal"></button>\
                                            </div>\
                                            <div class="modal-body">\
                                                <div class="kt-section__content kt-section__content--border">\
                            \
                            \
                                                    <div class="row">\
                                                        <div class="col-md-4">\
                                                            <div class="form-group"><label for="Request.CreatedDate"><strong> ' + raw.employee.fname_arabic +'</strong></label><p></p></div>\
                                                        </div>\
                                                        <div class="col-md-4">\
                                                            <div class="form-group"><label for="Request.CreatedDate"><strong>تاريخ الطلب</strong></label><p>'+ raw.created_at +'</p></div>\
                                                        </div>\
                                                        <div class="col-md-4">\
                                                            <div class="form-group"><label for="Request.RequestType"><strong>نوع الطلب</strong></label><p> ' + request_type + ' </p></div>\
                                                        </div>\
                                                    </div>\
                                                    <hr>\  \
                            \                     ' + request_body + ' \
                            \
                                                    <hr>\
                            \
                                                    <div class="kt-section__content kt-section__content--border" data-select2-id="8">\
                                                        <!-- Begin Action Form-->\
                                                        <form method="post" enctype="multipart/form-data" data-block-on-submit="" action="" >\
                                                            <div class="row">\
                            \
                                                                <div class="col-md-6">\
                                                                    <div class="form-group">\
                                                                        <label><strong> الاجراء</strong></label>\
                                                                        <p>\
                                                                        <span class="kt-font-info"> '+ response_name +' </span>\
                                                                        </p>\
                                                                    </div>\
                                                                </div>\
                                                                \
                            \
                            \
                                                                 <div class="col-md-6">\
                                                                    <div class="form-group">\
                                                                        <label><strong> التعليفات</strong></label>\
                                                                        <p>\
                                                                        <span class="kt-font-info"> '+ commentBody +' </span>\
                                                                        </p>\
                                                                    </div>\
                                                                </div>\
                            \
                                                            </div>\
                            \
                                                    </div>\
                            \
                                                </div>\
                                            </div>\
                                            <div class="modal-footer">\
                                                <div class="kt-form__acdtions">\
                              \                     ' + cancelBtn + ' \
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
