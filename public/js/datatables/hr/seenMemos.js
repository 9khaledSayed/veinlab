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
            "Title":"العنوان",
            "Text":"النص",
            "Branch":"الفرع",
            "Readers":"المشاهدون",
            "Name":"الأسم",
            "Phone":"رقم الجوال"
        }
    };

    var locator = new KTLocator(messages);

    // basic demo
    var demo = function() {

        var currentLink = window.location.href;

        var datatable = $('.kt-datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: currentLink,
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
                }
            },

            // columns definition
            columns: [
                {
                    field: 'employee.fname_arabic',
                    title: locator.__('Name'),
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
                    field: 'employee.phone',
                    title: locator.__('Phone'),
                    textAlign: 'center',
                },{
                    field: 'Actions',
                    title: locator.__('Actions'),
                    sortable: false,
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    textAlign: 'center',
                    template: function(raw) {

                        var actionBtn = '<a  href="/dashboard/hr/employees/' + raw.employee.id  + '"  class="btn btn-sm btn-default btn-font-sm show">' + '<i class="flaticon2-document">' + '</i>' + locator.__('Show') + '</a>';


                        return actionBtn;

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
