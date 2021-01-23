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
            'Deleted!': "تم الألغاء !",
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
            "Comments":"التعليقات",
            "Request Date":"تاريخ الطلب",
            "Request Type":"نوع الطلب",
            "My Requests":"طلباتي",
            "details of the complainant":"تفاصيل الشكوي",
            "Subject of the complainant":"موضوع الشكوي",
            "side of the complainant":"جهه الشكوي",
            "Reason":"السبب",
            "repayment Months":"عدد شهور السداد",
            "Amount":"المبلغ",
            "Loan Date":"تاريخ السلفه",
            "City":"المدينه",
            "Country":"البلد",
            "To":"الي",
            "From":"من",
            "Leave Date":"تاريخ الاستئذان",
            "Number Of Days":"عدد الأيام",
            "End Date":"تاريخ النهايه",
            "Start Date":"تاريخ البدايه",
            "Close":"إغلاق",
            "No Comments !":"لا يوجد نعليقات !",
            "Respone Status":"حاله الرد",
            "Cancel":"الغاء",
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
                        url: '/dashboard/hr/requests/mine',
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
                                    url: '/dashboard/hr/request/' + data.id,
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
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 30,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                },{
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
                    field: 'type',
                    title: locator.__('Vacation Type'),
                    textAlign: 'center',
                    template: function(row) {
                        var status = {
                            1: {'title': locator.__('salary induction request'), 'class': ' kt-badge--success'},
                            2: {'title': locator.__('vacation request'), 'class': ' kt-badge--success'},
                            3: {'title': locator.__('leave request'), 'class': ' kt-badge--success'},
                            4: {'title': locator.__('trip request'), 'class': ' kt-badge--success'},
                            5: {'title': locator.__('loan request'), 'class': ' kt-badge--success'},
                            6: {'title': locator.__('complaint request'), 'class': ' kt-badge--success'},
                        };
                        return '<span class="kt-badge ' + status[row.type].class + ' kt-badge--inline kt-badge--pill">' + status[row.type].title + '</span>';
                    },

                },{
                    field: 'status',
                    title: locator.__('Status'),
                    textAlign: 'center',
                    template: function(row) {
                        var status = {
                            2: {'title': locator.__('Pending'), 'class': ' kt-badge--danger'},
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
                            2: {'title': locator.__('Pending'),
                                'cancelBtn':'<button type="submit" class="btn btn-danger cancel_request"  style="background-color:#C82333" data-dismiss="modal">' + locator.__('Cancel') + '</button>'
                            },
                            1: {'title': locator.__('Finished'),
                                'cancelBtn':'<button type="submit" class="btn btn-danger"  style="background-color:#C82333;display:none" data-dismiss="modal">' + locator.__('Cancel') + '</button>'
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

                        var request = {
                            1: {'title': locator.__('salary induction request'),'htmlBody':  '<div class="row">' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label><strong>' + locator.__('Status') + '</strong></label>' +
                                    '<p>' +
                                    '<span class="kt-font-info"> <i class="flaticon2-hourglass-1"></i> ' + status_name + ' </span>'+
                                    '</p>'+
                                    '</div>'+
                                    '<hr>'+
                                    '</div>'+

                                    '<div class="col-md-12">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Reason') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.reason + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'},
                            2: {'title': locator.__('vacation request'),'htmlBody':  '<div class="row">' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label><strong>' + locator.__('Status') + '</strong></label>' +
                                    '<p>' +
                                    '<span class="kt-font-info"> <i class="flaticon2-hourglass-1"></i> ' + status_name + ' </span>'+
                                    '</p>'+
                                    '</div>'+
                                    '<hr>'  +
                                    '</div>'+

                                    '<div class="col-md-3">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Vacation Type') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.vacation_type + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-3">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Start Date') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.from_date + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-3">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('End Date') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.to_date + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-3">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Number Of Days') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + diffDays + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'},
                            3: {'title': locator.__('leave request'),'htmlBody':  '<div class="row">' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label><strong>' + locator.__('Status') + '</strong></label>' +
                                    '<p>' +
                                    '<span class="kt-font-info"> <i class="flaticon2-hourglass-1"></i> ' + status_name + ' </span>'+
                                    '</p>'+
                                    '</div>'+
                                    '<hr>'+
                                    '</div>'+

                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Leave Date') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.date + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('From') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.from_time + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('To') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.to_time + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'},
                            4: {'title': locator.__('trip request'),'htmlBody':  '<div class="row">' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label><strong>' + locator.__('Status') + '</strong></label>' +
                                    '<p>' +
                                    '<span class="kt-font-info"> <i class="flaticon2-hourglass-1"></i> ' + status_name + ' </span>'+
                                    '</p>'+
                                    '</div>'+
                                    '<hr>'+
                                    '</div>'+

                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Country') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.country + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('City') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.city + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Reason') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.description + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'},
                            5: {'title': locator.__('loan request'),'htmlBody':  '<div class="row">' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label><strong>' + locator.__('Status') + '</strong></label>' +
                                    '<p>' +
                                    '<span class="kt-font-info"> <i class="flaticon2-hourglass-1"></i> ' + status_name + ' </span>'+
                                    '</p>'+
                                    '</div>'+
                                    '<hr>'+
                                    '</div>'+

                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Loan Date') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.date + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Amount') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.amount + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-4">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('repayment Months') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.no_months + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-12">' +
                                    '<hr>' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Reason') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.description + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'},
                            6: {'title': locator.__('complaint request'),'htmlBody': '<div class="row">' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label><strong>' + locator.__('Status') + '</strong></label>' +
                                    '<p>' +
                                    '<span class="kt-font-info"> <i class="flaticon2-hourglass-1"></i> ' + status_name + ' </span>'+
                                    '</p>'+
                                    '</div>'+
                                    '<hr>'+
                                    '</div>'+

                                    '<div class="col-md-6">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('side of the complainant') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.directed_department + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-6">' +
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('Subject of the complainant') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.subject + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="col-md-12">' +
                                    '<hr>'+
                                    '<div class="form-group">'+
                                    '<label><strong>' + locator.__('details of the complainant') + '</strong></label>' +
                                    '<p>'+
                                    '<span class="kt-font-info"> ' + raw.description + '</span>' +
                                    '</p>'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'},
                        };


                        var request_type   = request[raw.type].title;
                        var request_body   = request[raw.type].htmlBody;
                        var modalID        = "myModal" + raw.id
                        var response_name  = response[raw.response].title;
                        var commentBody;

                        if ( raw.comment )
                        {
                            commentBody = raw.comment;
                        }else
                        {
                            commentBody = locator.__('No Comments !');
                        }
                        return '\
                        \    <div  class="modal fade" role="dialog" id = '+ modalID +' >\
                                    <div class="modal-dialog">\
                            \
                                        <!-- Modal content-->\
                                        <div class="modal-content">\
                                            <div class="modal-header">\
                                                <h4 class="modal-title">' + locator.__('My Requests') + '\
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
                                                            <div class="form-group"><label for="Request.CreatedDate"><strong>' + locator.__('Request Date') + '</strong></label><p>'+ raw.created_at +'</p></div>\
                                                        </div>\
                                                        <div class="col-md-4">\
                                                            <div class="form-group"><label for="Request.RequestType"><strong>' + locator.__('Request Type') + '</strong></label><p> ' + request_type + ' </p></div>\
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
                                                                        <label><strong> ' + locator.__('Respone Status') + '</strong></label>\
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
                                                                        <label><strong> ' + locator.__('Comments') + '</strong></label>\
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
                                                        ' + locator.__('Close') + '\
                                                    </a>\
                                                </div>\
                                            </div>\
                                        </div>\
                            \
                                    </div>\
                                </div>\
                            <button type="button" class="btn btn-sm btn-default btn-font-sm" data-toggle="modal" data-target= ' + "#" + modalID +' ><i class="flaticon2-document"></i>' + locator.__('Show') + '</button>\
                        ';


                    },
                }],
        });

        $('#kt_form_status').on('change', function() {
            var value = $(this).val();
            datatable.search(value, 'status');
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

        $('#kt_form_request').on('change', function() {
            var value = $(this).val();
            switch (value) {
                case '1': // today
                    datatable.search( value , 'type');
                    break;
                case '2':
                    datatable.search( value, 'type');
                    break;
                case '3':
                    datatable.search( value, 'type');
                    break;
                case '4':
                    datatable.search( value, 'type');
                    break;
                default:
                    datatable.search(value, 'type');
            }
        });

        $('#kt_form_date').selectpicker();

        $('#kt_form_status').selectpicker();

        $('#kt_form_request').selectpicker();


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
