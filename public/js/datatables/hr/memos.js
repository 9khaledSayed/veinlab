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
            'Yes, Cancel!': "نعم الغ!",
            'No': "لا",
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
            "Title":"العنوان",
            "Text":"النص",
            "Branch":"الفرع",
            'Are you sure to delete this item?': "هل انت متأكد أنك تريد مسح هذا العنصر؟",
            'Yes, Delete!': "نعم امسح!",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'No, cancel': "لا الغِ",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Deleted!': "تم المسح!",
            'Show': "عرض",
            'Edit': "تعديل",
            'Delete': "مسح",
            "Readers":"المشاهدون"
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
                        url: '/dashboard/hr/memos',
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
                    row.find('.show').on('click', function () {

                        var title = data.title_ar;
                        var text  = data.text_ar;

                        if (lang == "en" && data.title_en && data.text_en )
                        {
                            title = data.title_en;
                            text  = data.text_en;
                        }

                        Swal.fire(
                            title,
                            text,
                            data.icon
                        )
                    });

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
                                    },
                                });
                                $.ajax({
                                    method: 'DELETE',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: '/dashboard/hr/memos/' + data.id,
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
                    field: 'title_ar',
                    title: locator.__('Title'),
                    textAlign: 'center',
                },{
                    field: 'text_ar',
                    title: locator.__('Text'),
                    textAlign: 'center',
                },{
                    field: 'branch.name',
                    title: locator.__('Branch'),
                    textAlign: 'center',

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
                    template: function(row) {


                        // if (type != 1)
                        // {
                        //     var actionBtn = '<button type="button" class="btn btn-sm btn-default btn-font-sm show">' + '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</button>';
                        // }else
                        // {
                        //     var actionBtn = '<div class="dropdown">' +
                        //         '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">' +
                        //         '<i class="la la-ellipsis-h">' +  '</i>' +
                        //         '</a>'+
                        //         '<div class="dropdown-menu dropdown-menu-right">' +
                        //         '<a class="dropdown-item show">' + '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</a>' +
                        //         '<a class="dropdown-item discard-item" href="/dashboard/hr/memos/' + raw.id  + '"  >' + '<i class="fa fa-eye">' + '</i>' + locator.__('Readers') + '</a>' +
                        //         '</div>' +
                        //         '</div>';
                        // }

                        return `
                          <div class="dropdown">
                              <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                                  <i class="la la-ellipsis-h"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item show" href="/dashboard/hr/roles/${row.id}/edit"><i class="la la-leaf"></i>${locator.__('Show')}</a>
<!--                                  <a class="dropdown-item discard-item" href="/dashboard/hr/memos/${row.id}"><i class="la la-leaf"></i>${locator.__('Readers')}</a>-->
                                  <a class="dropdown-item delete-item" href="#"><i class="la la-leaf"></i>${locator.__('Delete')}</a>
                              </div>
                          </div>
                            
                        `

                        // return actionBtn;

                    },
                }],
        });


            $('#kt_form_branch').on('change', function() {
                var value = $(this).val();
                datatable.search(value, 'branch.name');
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

        }

        $('#kt_form_date , #kt_form_branch').selectpicker();




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
