"use strict";
// Class definition

var KTDatatableLocalSortDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Patient': "المريض",
            'Total Price': "السعر الكلي",
            'Serial No': "رقم الفاتور",
            'Payment Method': "طريقة الدفع",
            'Barcode': "الباركود",
            'status': "الحالة",
            'Success': "ناجحة",
            'Discarded': "المرتجعة",
            'Cash': "نقدي",
            'Credit': "شبكة",
            'Overdue': "مؤجل",
            'Date': "تاريخ اﻹنشاء",
            "Actions": "الاجراءات",
            "Discard": "ارتجاع",
            "Discarded successfully": "تم الارتجاع بنجاح",
            'Show Invoice': "عرض الفاتورة",
            'Are you sure to delete this item?': "هل انت متأكد أنك تريد مسح هذا العنصر؟",
            'Are you sure to Discard this item?': "هل انت متأكد أنك تريد ارتجاع هذه الفتورة؟",
            'Yes, Delete!': "نعم امسح!",
            'Yes, Discard!': "نعم ارتجاع!",
            'No, cancel': "لا الغِ",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Deleted!': "تم المسح!",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'Show invoice': "عرض الفاتورة",
            'Edit Invoice': "تعديل الفاتورة",
            'delete': "مسح",
            "Discarded successfully !":"تم الأرتجاع !",
            "Item Discarded Successfully":"تم إرتجاع الفاتوره بنجاح !"

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
                        url: '/dashboard/invoices',
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
            },
            rows: {
                afterTemplate: function (row, data, index) {
                    row.find('.discard-item').on('click', function () {
                        swal.fire({
                            buttonsStyling: false,

                            html: locator.__("Are you sure to Discard this item?"),
                            type: "info",

                            confirmButtonText: locator.__("Yes, Discard!"),
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
                                    method: 'get',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: '/dashboard/invoices/' + data.id  + '/delete',
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
                                        title: locator.__('Discarded successfully !'),
                                        text: locator.__('Item Discarded Successfully'),
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
                }, {
                    field: 'patient.name',
                    title: locator.__('Patient'),
                    textAlign: 'center',
                }, {
                    field: 'total_price',
                    title: locator.__('Total Price'),
                    textAlign: 'center',
                }, {
                    field: 'serial_no',
                    title: locator.__('Serial No'),
                    textAlign: 'center',
                }, {
                    field: 'barcode',
                    title: locator.__('Barcode'),
                    textAlign: 'center',
                    template: function(raw) {
                        return '<a class="btnprn h5" onclick="window.print();" href="/dashboard/barcodes/' + raw.barcode + '"><i class="flaticon-reply"></i>'+ locator.__('Barcode') +'</a>';

                        },
                }, {
                    field: 'status',
                    title: locator.__('status'),
                    textAlign: 'center',
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            1: {'title': locator.__('Success'), 'class': ' kt-badge--success'},
                            2: {'title': locator.__('Discarded'), 'class': ' kt-badge--danger'},
                        };
                        return '<span class="kt-badge ' + status[row.status].class + ' kt-badge--inline kt-badge--pill">' + status[row.status].title + '</span>';
                    },
                }, {
                    field: 'pay_method',
                    title: locator.__('Payment Method'),
                    textAlign: 'center',
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            1: {'title': locator.__('Cash'), 'class': ' kt-badge--primary'},
                            2: {'title': locator.__('Credit'), 'class': ' kt-badge--warning'},
                            3: {'title': locator.__('Overdue'), 'class': ' kt-badge--brand'},
                        };
                        return '<span class="kt-badge ' + status[row.pay_method].class + ' kt-badge--inline kt-badge--pill">' + status[row.pay_method].title + '</span>';
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
                    template: function(row) {

                        return '\
		                  <div class="dropdown">\
		                      <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
		                          <i class="la la-ellipsis-h"></i>\
		                      </a>\
		                      <div class="dropdown-menu dropdown-menu-right">\
		                          <a class="dropdown-item" href="/dashboard/invoices/' + row.id  + '"><i class="flaticon-eye"></i>' + locator.__('Show Invoice') + '</a>\
		                          <a class="dropdown-item" href="/dashboard/invoices/' + row.id  + '/edit"><i class="flaticon2-contract"></i>' + locator.__('Edit Invoice') + '</a>\
                                  <a class="dropdown-item discard-item" href="#" ><i class="fa fa-trash"></i>' + locator.__('Discard') + '</a>\
		                      </div>\
		                  </div>\
                        ';
                    },
                }],
        });

        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'status');
        });
        $('#kt_form_method').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'pay_method');
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
        $('#kt_form_status, #kt_form_date,#kt_form_method').selectpicker();

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
