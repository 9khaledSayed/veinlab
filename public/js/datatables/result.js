"use strict";
// Class definition

var KTDatatableRemoteAjaxDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Name': "الاسم",
            'Analysis': "التحاليل",
            'created': "تاريخ اﻹنشاء",
            'Date': "تاريخ اﻹنشاء",
            "Actions": "الاجراءات",
            'status': "الحالة",
            'Seiral Number': "رقم السريال",
            'Barcode': "الباركود",
            'Pending': "قيد التنفيذ",
            'Finished': "انتهي",
            'Are you sure to delete this item?': "هل انت متأكد أنك تريد مسح هذا العنصر؟",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'Yes, Delete!': "نعم امسح!",
            'No, cancel': "لا الغِ",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Deleted!': "تم المسح!",
            'Show': "عرض",
            'edit': "تعديل",
            'delete': "مسح",
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
                        method:'get',
                        url: '/dashboard/invoices_done',
                        // sample custom headers
                        // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        map: function(raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
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
                scroll: false,
                footer: false,
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#generalSearch'),
            },

            columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 30,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                }, {
                    field: 'patient.name',
                    title: locator.__('Name'),
                    textAlign: 'center',
                },  {
                    field: 'serial_no',
                    title: locator.__('Seiral Number'),
                    textAlign: 'center',
                }, {
                    field: 'barcode',
                    title: locator.__('Barcode'),
                    textAlign: 'center',
                    template: function(raw) {
                        return '<a class="h5" href="/dashboard/barcodes/' + raw.barcode + '"><i class="flaticon-reply"></i>Barcode</a>';
                    },
                }, {
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
                        return '\
                                    <a class="dropdown-item" href="/dashboard/results/' + raw.id  + '"><i class="flaticon-eye"></i><br>' + locator.__('Show Analysis') + '</a>\
                        ';
                    },
                }],

        });

        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'status');
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

        $('#kt_form_status,#kt_form_date').selectpicker();

    };

    return {
        // public functions
        init: function() {
            demo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableRemoteAjaxDemo.init();
});
