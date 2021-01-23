'use strict';
// Class definition

var KTDatatableLocalSortDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Name': "الاسم",
            'Email': "البريد الالكتروني",
            "Actions": "الاجراءات",
            "Dues": "المستحقات",
            'Phone': "رقم الهاتف",
            "All Money": "المدفوع حتي اﻷن",
            'Patient No': "عدد المرضي",
            'Created': "تاريخ اﻹنشاء",
            'Date': "تاريخ اﻹنشاء",
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
            'Receipt Voucher': "إنشاء سند القيض",
        }
    };

    var locator = new KTLocator(messages);
    // basic demo

    var demo = function() {
        var datatable = $('.kt-datatable').KTDatatable({
            records: {
                noRecords:locator.__('No records found')
            },
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'GET',
                        url: '/dashboard/hospitals',
                    },
                },
                pageSize: 10, // display 20 records per page
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
                    row.find('.delete-item').on('click', function () {
                        swal.fire({
                            buttonsStyling: false,

                            html: "Are you sure to delete this Game?",
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
                                    url: '/dashboard/hospitals/' + data.id,
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
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 30,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                }, {
                    field: 'name',
                    title: locator.__('Name'),
                    textAlign: 'center',
                }, {
                    field: 'email',
                    title: locator.__('Email'),
                    textAlign: 'center',

                }, {
                    field: 'dues',
                    title: locator.__('Dues'),
                    textAlign: 'center',
                }, {
                    field: 'phone',
                    title: locator.__('Phone'),
                    textAlign: 'center',
                }, {
                    field: 'no_patients',
                    title: locator.__('Patient No'),
                    textAlign: 'center',

                }, {
                    field: 'created_at',
                    title: locator.__('Created'),
                    textAlign: 'center',

                }, {
                    field: 'Actions',
                    width: 110,
                    title: locator.__('Actions'),
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    textAlign: 'center',
                    template: function(data) {
                        var dropdown = document.createElement('div');
                        var dropDownButton = document.createElement('a');
                        var dropdownIcon = document.createElement('i');
                        var dropdownMenu = document.createElement('div');
                        var dropdownNav = document.createElement('ul');
                        var showLi = document.createElement('li');
                        var showLink = document.createElement('a');
                        var showI = document.createElement('i');
                        var showSpan = document.createElement('span');
                        var editLi = document.createElement('li');
                        var editLink = document.createElement('a');
                        var editI = document.createElement('i');
                        var editSpan = document.createElement('span');
                        var deleteLi = document.createElement('li');
                        var deleteLink = document.createElement('a');
                        var deleteI = document.createElement('i');
                        var deleteSpan = document.createElement('span');
                        /**/
                        var payVoucherLi = document.createElement('li');
                        var payVoucherLink = document.createElement('a');
                        var payVoucherI = document.createElement('i');
                        var payVoucherSpan = document.createElement('span');

                        dropdown.classList.add('dropdown');
                        dropDownButton.classList.add('btn', 'btn-sm', 'btn-clean', 'btn-icon', 'btn-icon-md');
                        dropDownButton.href = 'javascript:;';
                        dropDownButton.setAttribute('data-toggle', 'dropdown');
                        dropdownIcon.classList.add('flaticon-more-1');
                        dropdownMenu.classList.add('dropdown-menu', 'dropdown-menu-right');
                        dropdownNav.classList.add('kt-nav');
                        showLi.classList.add('kt-nav__item');
                        showLink.classList.add('kt-nav__link');
                        showLink.href = '/dashboard/hospitals/'+ data.id ;
                        showI.classList.add('kt-nav__link-icon', 'flaticon-eye');
                        showSpan.classList.add('kt-nav__link-text');
                        editLi.classList.add('kt-nav__item');
                        editLink.classList.add('kt-nav__link');
                        editLink.href = '/dashboard/hospitals/'+ data.id +'/edit';
                        editI.classList.add('kt-nav__link-icon', 'flaticon2-contract');
                        editSpan.classList.add('kt-nav__link-text');
                        deleteLi.classList.add('kt-nav__item');
                        deleteLink.classList.add('kt-nav__link', 'delete-item');
                        deleteLink.setAttribute('data-id', data.id);
                        deleteI.classList.add('kt-nav__link-icon', 'flaticon2-trash');
                        deleteSpan.classList.add('kt-nav__link-text');
                        payVoucherLi.classList.add('kt-nav__item');
                        /**/
                        payVoucherLink.classList.add('kt-nav__link');
                        payVoucherLink.setAttribute('data-id', data.id);
                        payVoucherI.classList.add('kt-nav__link-icon', 'flaticon-file-1');
                        payVoucherSpan.classList.add('kt-nav__link-text');

                        showSpan.textContent = locator.__("Show");
                        showLink.appendChild(showI);
                        showLink.appendChild(showSpan);
                        showLi.appendChild(showLink);

                        editSpan.textContent = locator.__("edit");
                        editLink.appendChild(editI);
                        editLink.appendChild(editSpan);
                        editLi.appendChild(editLink);

                        deleteSpan.textContent = locator.__("delete");
                        deleteLink.href = "#";
                        deleteLink.appendChild(deleteI);
                        deleteLink.appendChild(deleteSpan);
                        deleteLi.appendChild(deleteLink);

                        payVoucherSpan.textContent = locator.__("Receipt Voucher");
                        payVoucherLink.href = "/dashboard/hospital_revenue/" + data.id + "/create";
                        payVoucherLink.appendChild(payVoucherI);
                        payVoucherLink.appendChild(payVoucherSpan);
                        payVoucherLi.appendChild(payVoucherLink);

                        dropdownNav.appendChild(showLi);
                        dropdownNav.appendChild(editLi);
                        dropdownNav.appendChild(deleteLi);
                        dropdownNav.appendChild(payVoucherLi);

                        dropDownButton.appendChild(dropdownIcon);
                        dropdownMenu.appendChild(dropdownNav);
                        dropdown.appendChild(dropDownButton);
                        dropdown.appendChild(dropdownMenu);
                        return dropdown;
                    },
                }],
        });

        // $('#kt_form_date').on('change', function() {
        //     var current_datetime = new Date()
        //     var value = $(this).val();
        //     switch (value) {
        //         case '1': // today
        //             datatable.search(current_datetime.toDateString(), 'created_at');
        //             break;
        //         case '2':
        //             current_datetime.setDate(current_datetime.getDate() - 7);
        //             datatable.search(current_datetime.toDateString(), 'created_at');
        //             break;
        //         case '3':
        //             current_datetime.setMonth(current_datetime.getMonth() - 1);
        //             datatable.search(current_datetime.toLocaleString('default', { month: 'short' }), 'created_at');
        //             break;
        //         default:
        //             datatable.search($(this).val().toLowerCase(), 'created_at');
        //     }
        // });
        // $('#kt_form_date').selectpicker();
        $('#kt_form_date').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'created_at');
        });

    };

    return {
        // public functions
        init: function() {
            demo();
        },
    };
}();

jQuery(document).ready(function() {
    $("#report").click(function (e){
        e.preventDefault();
        $("#date_form").submit();
    });
    $.fn.datepicker.dates['ar'] = {
        days: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
        daysShort: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
        daysMin: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
        months: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
        monthsShort: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
    };
    $('#kt_form_date').datepicker({
        rtl: true,
        language: 'ar',
        orientation: "bottom",
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
        clearBtn: true,
    });
    KTDatatableLocalSortDemo.init();
});
