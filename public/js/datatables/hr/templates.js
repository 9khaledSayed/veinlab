"use strict";
// Class definition

var KTUserListDatatable = function() {
    // Private functions
    var messages = {
        'ar': {
            'Name': "الاسم",
            'Email': "البريد الالكتروني",
            'Phone': "رقم الجوال",
            'Percentage': "النسبة المئوية",
            'Wallet': "المحفطة",
            'All Money': "جميع النقود",
            'Patients': "المرضي",
            "Actions": "الاجراءات",
            "Date": "تاريخ الانشاء",
            'Are you sure to delete this item?': "هل انت متأكد أنك تريد مسح هذا العنصر؟",
            'Yes, Delete!': "نعم امسح!",
            'No, cancel': "لا الغِ",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Deleted!': "تم المسح!",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'Show': "عرض",
            'edit': "تعديل",
            'delete': "مسح",
            'Payment Voucher': "سند الصرف",
            "Arabic Name":"الأسم بالعربي",
            "English Name":"الأسم بالانجليزي"

        }
    };

    var locator = new KTLocator(messages);

    // variables
    var datatable;
    // basic demo
    var init = function() {

         datatable = $('.kt-datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: '/dashboard/hr/templates',
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
                                     url: '/dashboard/doctors/' + data.id,
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
                    field: 'arabic_name',
                    title: locator.__('Arabic Name'),
                    textAlign: 'center',
                }, {
                    field: 'english_name',
                    title: locator.__('English Name'),
                    textAlign: 'center',
                }, {
                    field: 'Actions',
                    title: locator.__('Actions'),
                    sortable: false,
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    textAlign: 'center',
                    template: function(row) {
                        return '\
                        <a class="btn btn-sm btn-primary m-btn m-btn--icon" href="/dashboard/hr/templates/' + row.id + '/edit">\
                            <i class="fa fa-edit"></i>\
                            تعديل\
                        </a>\
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
                default:
                    datatable.search($(this).val().toLowerCase(), 'created_at');
            }
        });
        $('#kt_form_date').selectpicker();

    };

    return {
        // public functions
        init: function() {
            init();
        },
    };
}();

jQuery(document).ready(function() {
    KTUserListDatatable.init();
});
