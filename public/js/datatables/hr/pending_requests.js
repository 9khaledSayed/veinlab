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
            'Are you sure ?': "هل انت متأكد ؟",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'Yes !': "نعم !",
            'No, cancel': "لا الغِ",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Sent!': "تم الأرسال!",
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
            "Request Type" : "نوع الطلب",
            "Status":"الحاله",
            'Finished' :"تم الانتهاء",
            "Choose":"اختر",
            "Agree":"موافق",
            "Disagree":"غير موافق",
            "Comments":"التعليقات",
            "Request Date":"تاريخ الطلب",
            "My Requests":"طلباتي",
            "details of the complainant":"تفاصيل الشكوي",
            "Subject of the complainant":"موضوع الشكوي",
            "side of the complainant":"جهه الشكوي",
            "Reason":"السبب",
            "repayment Months":"عدد شهور السداد",
            "Amount":"المبلغ",
            "Loan Date":"تاريخ السلفه",
            "City":"المدنه",
            "Country":"البلد",
            "To":"الي",
            "From":"من",
            "Leave Date":"تاريخ الاستئذان",
            "Number Of Days":"عدد الأيام",
            "End Date":"تاريخ النهايه",
            "Start Date":"تاريخ البدايه",
            "Close":"إغلاق",
            "Choose File":"اختر الملف",
            "Vacation Type":"نوع الاجازه",
            "Print":"طبع",
            "Paid Or Not":"الاجازه مدفوعه الأجر",
            "Sent !":"تم الأرسال !"
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
                        url: '/dashboard/hr/requests/pending',
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
                    row.find('.send_response').on('click', function (e) {

                        e.preventDefault();

                        var commentInp    = document.getElementById("comment" + data.id).value;
                        var responseInp   = document.getElementById("response" + data.id).value;
                        var paidOrNotInp  = null;
                        if ( document.getElementById("paid" + data.id) )
                        {
                            var id = "paid" + data.id;

                            if ($('#' + id).is(":checked")) {
                                paidOrNotInp = 1;
                            } else {
                                paidOrNotInp = 0;
                            }
                        }

                        swal.fire({
                            title: locator.__('Loading...'),
                            onOpen: function () {
                                swal.showLoading();
                            }
                        });
                        $.ajax({
                            method: 'PUT',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '/dashboard/hr/request/' + data.id,
                            data:{comment:commentInp,response:responseInp,paid:paidOrNotInp},
                            error: function (err) {
                                // if (err.hasOwnProperty('responseJSON')) {
                                //     if (err.responseJSON.hasOwnProperty('message')) {
                                //         swal.fire({
                                //             title: locator.__('Error!'),
                                //             text: locator.__(err.responseJSON.message),
                                //             type: 'error'
                                //         });
                                //     }
                                // }
                                console.log(err);
                            }
                        }).done(function (res) {
                            swal.fire({
                                title: locator.__('Sent !'),
                                text: locator.__(res.message),
                                type: 'success',
                                buttonsStyling: false,
                                confirmButtonText: locator.__("OK"),
                                confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                            });
                            datatable.reload();
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
                    title: locator.__('Request Type'),
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

                }, {
                    field: 'Actions',
                    title: locator.__('Actions'),
                    sortable: false,
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    textAlign: 'center',
                    template: function(raw) {

                        var status = {
                            2: {'title': locator.__('Pending')},
                            1: {'title': locator.__('Finished')},
                        };
                        var status_name  = status[raw.status].title;
                        var diffDays = 0;
                        if ( raw.type == 2)
                        {
                            const date1 = new Date(raw.from_date );
                            const date2 = new Date(raw.to_date );
                            const diffTime = Math.abs(date2 - date1);
                            diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        }

                        var modalID      = "myModal" + raw.id
                        var responseID   = "response" + raw.id;
                        var commentID    = "comment"  + raw.id;
                        var paidOrNot    = "paid"     + raw.id;

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
                                    '</div>'
                                    ,'actionBody':
                                     '<div class="kt-section__content kt-section__content--border" data-select2-id="8">'+
                                    '<form>' +
                                    '<div class="row">' +
                                    '<div class="col-md-12">'+
                                   ' <div class="form-group">'+
                                   ' <label class="control-label font-weight-bold">' + locator.__('Actions') + '</label>'+
                                   ' <select class="form-control" id = '+ responseID +' name="response" style="padding:5px" >'+
                                   '<option value="1">' +  locator.__("Agree") +
                                    '</option>' +
                                    '<option value="0">' +
                                                          locator.__("Disagree") +
                                    '</option>' +
                                    '</select>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label class="control-label">' + locator.__('Comments') + '</label>' +
                                    '<textarea name = "comment" id = '+ commentID +'  class="form-control" rows="3">' + '</textarea>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</form>' +
                                    '</div>'
                                    ,'actionBtn': '<div class="dropdown">' +
                                    '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">' +
                                    '<i class="la la-ellipsis-h">' +  '</i>' +
                                    '</a>'+
                                    '<div class="dropdown-menu dropdown-menu-right">' +
                                    '<a class="dropdown-item" href="" data-toggle="modal" data-target= ' + "#" + modalID +'>' + '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</a>' +
                                    '<a class="dropdown-item discard-item"  href="/dashboard/hr/salary_letter/' + raw.employee_id  + '" >' + '<i class="flaticon2-printer">' + '</i>' + locator.__('Print') + '</a>' +
                                    '</div>' +
                                    '</div>'
                                    },
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
                                    '</div>'
                                ,'actionBody':
                                    '<div class="kt-section__content kt-section__content--border" data-select2-id="8">'+
                                    '<form>' +
                                    '<div class="row">' +
                                    '<div class="col-md-12">'+
                                    ' <div class="form-group">'+
                                    ' <label class="control-label font-weight-bold">' + locator.__('Actions') + '</label>'+
                                    ' <select class="form-control" id = '+ responseID +' name="response" style="padding:5px" >'+
                                    '<option value="1">' +  locator.__("Agree") +
                                    '</option>' +
                                    '<option value="0">' +
                                    locator.__("Disagree") +
                                    '</option>' +
                                    '</select>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-md-6">' +
                                    '<div class="form-group row">' +
                                    '<div class="kt-checkbox-list ml-3 mr-3 checkbox">' +
                                    '<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">' +
                                    '<input name="paid"  type="checkbox"  id = "' + paidOrNot + '" >' +
                                    locator.__('Paid Or Not') +
                                    '<span>' +'</span>' +
                                    '</label>' +
                                    '</div>'   +
                                    '</div>'   +
                                    '</div>'   +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label class="control-label">' + locator.__('Comments') + '</label>' +
                                    '<textarea name = "comment" id = '+ commentID +'  class="form-control" rows="3">' + '</textarea>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</form>' +
                                    '</div>'
                                ,'actionBtn': '<button type="button"  class="btn btn-sm btn-default btn-font-sm" data-toggle="modal" data-target= ' + "#" + modalID +' >' +
                                    '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</button>'
                            },
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
                                    '<label><strong> ' + locator.__('Leave Date') + '</strong></label>' +
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
                                    '</div>'
                                ,'actionBody':
                                    '<div class="kt-section__content kt-section__content--border" data-select2-id="8">'+
                                    '<form>' +
                                    '<div class="row">' +
                                    '<div class="col-md-12">'+
                                    ' <div class="form-group">'+
                                    ' <label class="control-label font-weight-bold">' + locator.__('Actions') + '</label>'+
                                    ' <select class="form-control" id = '+ responseID +' name="response" style="padding:5px" >'+
                                    '<option value="1">' +  locator.__("Agree") +
                                    '</option>' +
                                    '<option value="0">' +
                                    locator.__("Disagree") +
                                    '</option>' +
                                    '</select>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-md-6">' +
                                    '<div class="form-group row">' +
                                    '<br>' +
                                    '<div class="kt-checkbox-list ml-3 mr-3 checkbox">' +
                                    '<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">' +
                                    '<input name="paid"  type="checkbox"  id = "' + paidOrNot + '" >' +
                                    locator.__('Paid Or Not') +
                                    '<span>' +'</span>' +
                                    '</label>' +
                                    '</div>'   +
                                    '</div>'   +
                                    '</div>'   +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label class="control-label">' + locator.__('Comments') + '</label>' +
                                    '<textarea name = "comment" id = '+ commentID +'  class="form-control" rows="3">' + '</textarea>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</form>' +
                                    '</div>'
                                ,'actionBtn': '<button type="button"  class="btn btn-sm btn-default btn-font-sm" data-toggle="modal" data-target= ' + "#" + modalID +' >' +
                                    '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</button>'},
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
                                    '</div>'
                                ,'actionBody':
                                    '<div class="kt-section__content kt-section__content--border" data-select2-id="8">'+
                                    '<form>' +
                                    '<div class="row">' +
                                    '<div class="col-md-12">'+
                                    ' <div class="form-group">'+
                                    ' <label class="control-label font-weight-bold">' + locator.__('Actions') + '</label>'+
                                    ' <select class="form-control" id = '+ responseID +' name="response" style="padding:5px" >'+
                                    '<option value="1">' +  locator.__("Agree") +
                                    '</option>' +
                                    '<option value="0">' +
                                    locator.__("Disagree") +
                                    '</option>' +
                                    '</select>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label class="control-label">' + locator.__('Comments') + '</label>' +
                                    '<textarea name = "comment" id = '+ commentID +'  class="form-control" rows="3">' + '</textarea>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</form>' +
                                    '</div>'
                                ,'actionBtn': '<button type="button"  class="btn btn-sm btn-default btn-font-sm" data-toggle="modal" data-target= ' + "#" + modalID +' >' +
                                    '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</button>'
                            },
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
                                    '</div>'
                                ,'actionBody':
                                    '<div class="kt-section__content kt-section__content--border" data-select2-id="8">'+
                                    '<form>' +
                                    '<div class="row">' +
                                    '<div class="col-md-12">'+
                                    ' <div class="form-group">'+
                                    ' <label class="control-label font-weight-bold">' + locator.__('Actions') + '</label>'+
                                    ' <select class="form-control" id = '+ responseID +' name="response" style="padding:5px" >'+
                                    '<option value="1">' +  locator.__("Agree") +
                                    '</option>' +
                                    '<option value="0">' +
                                    locator.__("Disagree") +
                                    '</option>' +
                                    '</select>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label class="control-label">' + locator.__('Comments') + '</label>' +
                                    '<textarea name = "comment" id = '+ commentID +'  class="form-control" rows="3">' + '</textarea>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</form>' +
                                    '</div>'
                                ,'actionBtn': '<button type="button"  class="btn btn-sm btn-default btn-font-sm" data-toggle="modal" data-target= ' + "#" + modalID +' >' +
                                    '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</button>'
                            },
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
                                    '</div>'
                                ,'actionBody':
                                    '<div class="kt-section__content kt-section__content--border" data-select2-id="8">'+
                                    '<form>' +
                                    '<div class="row">' +
                                    '<div class="col-md-12">'+
                                    ' <div class="form-group">'+
                                    ' <label class="control-label font-weight-bold">' + locator.__('Actions') + '</label>'+
                                    ' <select class="form-control" id = '+ responseID +' name="response" style="padding:5px" >'+
                                    '<option value="1">' +  locator.__("Agree") +
                                    '</option>' +
                                    '<option value="0">' +
                                    locator.__("Disagree") +
                                    '</option>' +
                                    '</select>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-md-12">' +
                                    '<div class="form-group">' +
                                    '<label class="control-label">' + locator.__('Comments') + '</label>' +
                                    '<textarea name = "comment" id = '+ commentID +'  class="form-control" rows="3">' + '</textarea>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</form>' +
                                    '</div>'
                                ,'actionBtn': '<button type="button"  class="btn btn-sm btn-default btn-font-sm" data-toggle="modal" data-target= ' + "#" + modalID +' >' +
                                    '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</button>'
                            },
                            };


                        var request_type = request[raw.type].title;
                        var request_body = request[raw.type].htmlBody;
                        var actionBody    = request[raw.type].actionBody;
                        var actionBtn    = request[raw.type].actionBtn;



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
                                                  ' + actionBody + '\
                                                </div>\
                                            </div>\
                                            <div class="modal-footer">\
                                                <div class="kt-form__acdtions">\
                                                    <button type="submit" class="btn btn-brand send_response" data-dismiss="modal">ارسال</button>\
                            \
                                                    <a href="/" class="btn btn-secondary" data-dismiss="modal">\
                                                        إلغاء\
                                                    </a>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                                 \    ' + actionBtn + ' \
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

