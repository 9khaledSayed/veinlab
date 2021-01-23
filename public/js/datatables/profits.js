'use strict';
// Class definition

var KTDatatableLocalSortDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Name': "الاسم",
            'Email': "البريد الالكتروني",
            "Actions": "الاجراءات",
            'Wallet': "المحفظة",
            'Patient No': "عدد المرضي",
            'created': "تاريخ اﻹنشاء",
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
            'Payment Voucher': "سند الصرف",
            ' SAR' : " ريـــال" ,
            'Value': "القيمة"
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
                        url: '/dashboard/profits',
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
                    field: 'value',
                    title: locator.__('Value'),
                    textAlign: 'center',
                    template: function(row) {
                    return row.value + locator.__(' SAR');
                    },

                }, {
                    field: 'created_at',
                    title: locator.__('Date'),
                    textAlign: 'center',

                },
                // {
                //     field: 'Actions',
                //     width: 110,
                //     title: locator.__('Actions'),
                //     sortable: false,
                //     overflow: 'visible',
                //     autoHide: false,
                //     textAlign: 'center',
                //     template: function(data) {
                //         var dropdown = document.createElement('div');
                //         var dropDownButton = document.createElement('a');
                //         var dropdownIcon = document.createElement('i');
                //         var dropdownMenu = document.createElement('div');
                //         var dropdownNav = document.createElement('ul');
                //         var showLi = document.createElement('li');
                //         var showLink = document.createElement('a');
                //         var showI = document.createElement('i');
                //         var showSpan = document.createElement('span');
                //         var editLi = document.createElement('li');
                //         var editLink = document.createElement('a');
                //         var editI = document.createElement('i');
                //         var editSpan = document.createElement('span');
                //         var deleteLi = document.createElement('li');
                //         var deleteLink = document.createElement('a');
                //         var deleteI = document.createElement('i');
                //         var deleteSpan = document.createElement('span');
                //         /**/
                //         var payVoucherLi = document.createElement('li');
                //         var payVoucherLink = document.createElement('a');
                //         var payVoucherI = document.createElement('i');
                //         var payVoucherSpan = document.createElement('span');
                //
                //         dropdown.classList.add('dropdown');
                //         dropDownButton.classList.add('btn', 'btn-sm', 'btn-clean', 'btn-icon', 'btn-icon-md');
                //         dropDownButton.href = 'javascript:;';
                //         dropDownButton.setAttribute('data-toggle', 'dropdown');
                //         dropdownIcon.classList.add('flaticon-more-1');
                //         dropdownMenu.classList.add('dropdown-menu', 'dropdown-menu-right');
                //         dropdownNav.classList.add('kt-nav');
                //         showLi.classList.add('kt-nav__item');
                //         showLink.classList.add('kt-nav__link');
                //         showLink.href = '/dashboard/hospitals/'+ data.id ;
                //         showI.classList.add('kt-nav__link-icon', 'flaticon-eye');
                //         showSpan.classList.add('kt-nav__link-text');
                //         editLi.classList.add('kt-nav__item');
                //         editLink.classList.add('kt-nav__link');
                //         editLink.href = '/dashboard/hospitals/'+ data.id +'/edit';
                //         editI.classList.add('kt-nav__link-icon', 'flaticon2-contract');
                //         editSpan.classList.add('kt-nav__link-text');
                //         deleteLi.classList.add('kt-nav__item');
                //         deleteLink.classList.add('kt-nav__link', 'delete-item');
                //         deleteLink.setAttribute('data-id', data.id);
                //         deleteI.classList.add('kt-nav__link-icon', 'flaticon2-trash');
                //         deleteSpan.classList.add('kt-nav__link-text');
                //         payVoucherLi.classList.add('kt-nav__item');
                //         /**/
                //         payVoucherLink.classList.add('kt-nav__link');
                //         payVoucherLink.setAttribute('data-id', data.id);
                //         payVoucherI.classList.add('kt-nav__link-icon', 'flaticon-file-1');
                //         payVoucherSpan.classList.add('kt-nav__link-text');
                //
                //         showSpan.textContent = locator.__("Show");
                //         showLink.appendChild(showI);
                //         showLink.appendChild(showSpan);
                //         showLi.appendChild(showLink);
                //
                //         editSpan.textContent = locator.__("edit");
                //         editLink.appendChild(editI);
                //         editLink.appendChild(editSpan);
                //         editLi.appendChild(editLink);
                //
                //         deleteSpan.textContent = locator.__("delete");
                //         deleteLink.href = "#";
                //         deleteLink.appendChild(deleteI);
                //         deleteLink.appendChild(deleteSpan);
                //         deleteLi.appendChild(deleteLink);
                //
                //         payVoucherSpan.textContent = locator.__("Payment Voucher");
                //         payVoucherLink.href = "/dashboard/exports/create?hospital_id=" + data.id;
                //         payVoucherLink.appendChild(payVoucherI);
                //         payVoucherLink.appendChild(payVoucherSpan);
                //         payVoucherLi.appendChild(payVoucherLink);
                //
                //         dropdownNav.appendChild(showLi);
                //         dropdownNav.appendChild(editLi);
                //         dropdownNav.appendChild(deleteLi);
                //         dropdownNav.appendChild(payVoucherLi);
                //
                //         dropDownButton.appendChild(dropdownIcon);
                //         dropdownMenu.appendChild(dropdownNav);
                //         dropdown.appendChild(dropDownButton);
                //         dropdown.appendChild(dropdownMenu);
                //         return dropdown;
                //     },
               // }
                ],
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
            demo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableLocalSortDemo.init();
});
