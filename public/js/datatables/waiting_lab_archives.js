'use strict';
// Class definition

var KTDatatableChildRemoteDataDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Patient Name': "اسم المريض",
            'Analysis Name': "اسم التحليل",
            'Barcode': "الباركـود",
            'Serial No': "رقم السلسلة",
            'Result': "النتيجة",
            'status': "الحالة",
            'Test': "اختبار",
            'Unit': "الوحدة",
            'created': "تاريخ اﻹنشاء",
            'Date': "تاريخ اﻹنشاء",
            "Actions": "الاجراءات",
            'Load sub table': "اعرض الجدول الفرعي",
            'Are you sure to delete this item?': "هل انت متأكد أنك تريد مسح هذا العنصر؟",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'Yes, Delete!': "نعم امسح!",
            'No, cancel': "لا الغِ",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Deleted!': "تم المسح!",
            'Show': "عرض",
            'Edit Result': "تعديل النتيجة",
            'Create Result': "انشاء النتيجة",
            'Show Result': "عرض النتيجة",
            'delete': "مسح"
        }
    };

    var locator = new KTLocator(messages);

    // demo initializer
    var demo = function() {

        var datatable = $('.kt-datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method:'get',
                        url: '/dashboard/waiting_labs/archives',
                    },
                },
                pageSize: 10, // display 20 records per page
                serverPaging: true,
                serverFiltering: false,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: true,
                height: 400,
                footer: false,
            },

            // column sorting
            sortable: true,

            pagination: true,

            detail: {
                title: locator.__('Load sub table'),
                content: subTableInit,
            },

            search: {
                input: $('#generalSearch'),
            },

            // columns definition
            columns: [
                {
                    field: 'id',
                    title: '',
                    sortable: false,
                    width: 30,
                    textAlign: 'center',
                }, {
                    field: 'patient.name',
                    title: locator.__('Patient Name'),
                    sortable: 'asc',
                }, {
                    field: 'main_analysis.general_name',
                    title: locator.__('Analysis Name'),
                }, {
                    field: 'invoice.bar_code',
                    title: locator.__('Barcode'),
                    template: function(raw) {
                        return '<a class="h5" href="/dashboard/barcodes/' + raw.invoice.barcode + '"><i class="flaticon-reply"></i>Barcode</a>';
                    },
                }, {
                    field: 'invoice.serial_no',
                    title: locator.__('Serial No'),
                }, {
                    field: 'status',
                    title: locator.__('status'),
                    textAlign: 'center',
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            1: {'title': ('Pending'), 'class': ' kt-badge--danger'},
                            2: {'title': 'Finished', 'class': ' kt-badge--success'},
                            3: {'title': 'transfer', 'class': ' kt-badge--info'},
                        };
                        return '<span class="kt-badge ' + status[row.status].class + ' kt-badge--inline kt-badge--pill">' + status[row.status].title + '</span>';
                    },
                }, {
                    field: 'result',
                    title: locator.__('Result'),
                    textAlign: 'center',
                    template: function(raw) {
                        if(raw.result == 2){
                            return '<a class="h5" href="/dashboard/waiting_labs/' + raw.id + '/edit"><i class="flaticon-reply"></i>' + locator.__('Hide') + '</a>';
                        }else if(raw.result == 3){
                            return '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">' + locator.__('Finished') + '</span>';
                        }else{
                            return '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">' + locator.__('Pending') + '</span>';
                        }


                    },
                }, {
                    field: 'invoice.created_at',
                    title: locator.__('Date'),
                    textAlign: 'center',
                    template: function(row) {

                        var aestTime = new Date(row.created_at).toLocaleString("en-US", {timeZone: "Asia/Riyadh"})
                        return aestTime;

                    },
                }, {
                    field: 'Actions',
                    width: 110,
                    title: locator.__('Actions'),
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    template: function(row) {
                            return '\
		                  <div class="dropdown">\
		                      <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
		                          <i class="la la-ellipsis-h"></i>\
		                      </a>\
		                      <div class="dropdown-menu dropdown-menu-right">\
		                          <a class="dropdown-item" href="/dashboard/results/' + row.id + '/edit"><i class="la la-leaf"></i>' + locator.__('Edit Result') + '</a>\
		                          <a class="dropdown-item" href="/dashboard/waiting_labs/' + row.id + '"><i class="la la-eye"></i>' + locator.__('Show Result') + '</a>\
		                      </div>\
		                  </div>\
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

        $('#kt_form_status, #kt_form_date').selectpicker();

        function subTableInit(e) {
            $('<div/>').attr('id', 'child_data_ajax_' + e.data.id).appendTo(e.detailCell).KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method:'get',
                            url: '/dashboard/results?waiting_lab_id=' + e.data.id,
                        },
                    },
                    pageSize: 10,
                    serverPaging: true,
                    serverFiltering: false,
                    serverSorting: true,
                },

                // layout definition
                layout: {
                    scroll: true,
                    height: 300,
                    footer: false,

                    // enable/disable datatable spinner.
                    spinner: {
                        type: 1,
                        theme: 'default',
                    },
                },

                sortable: true,

                // columns definition
                columns: [
                    {
                        field: 'id',
                        title: '#',
                        sortable: false,
                    }, {
                        field: 'sub_analysis.name',
                        title: locator.__('Test'),
                    }, {
                        field: 'result',
                        title: locator.__('Result'),
                    }, {
                        field: 'sub_analysis.unit',
                        title: locator.__('Unit'),
                    } ,
                ],
            });
        }
    };

    return {
        // Public functions
        init: function() {
            // init dmeo
            demo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableChildRemoteDataDemo.init();
});
