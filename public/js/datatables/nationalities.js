"use strict";
// Class definition

var KTDatatableLocalSortDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'English Name': "الاسم بالانجليزية",
            'Arabic Name': "الاسم بالعربية",
            'Created': "تاريخ اﻹنشاء",
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
                        method: 'GET',
                        url: '/dashboard/nationalities',
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
                                    url: '/dashboard/nationalities/' + data.id,
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
                }, {
                    field: 'nationality',
                    title: locator.__('Arabic Name'),
                    textAlign: 'center',
                }, {
                    field: 'name_english',
                    title: locator.__('English Name'),
                    textAlign: 'center',
                },{
                    field: 'created_at',
                    title: locator.__('Created'),
                    textAlign: 'center',

                }, {
                    field: 'Actions',
                    title: locator.__('Actions'),
                    sortable: false,
                    width: 110,
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

                        dropdown.classList.add('dropdown');
                        dropDownButton.classList.add('btn', 'btn-sm', 'btn-clean', 'btn-icon', 'btn-icon-md');
                        dropDownButton.href = 'javascript:;';
                        dropDownButton.setAttribute('data-toggle', 'dropdown');
                        dropdownIcon.classList.add('flaticon-more-1');
                        dropdownMenu.classList.add('dropdown-menu', 'dropdown-menu-right');
                        dropdownNav.classList.add('kt-nav');
                        showLi.classList.add('kt-nav__item');
                        showLink.classList.add('kt-nav__link');
                        showLink.href = '#';
                        showI.classList.add('kt-nav__link-icon', 'flaticon2-contract');
                        showSpan.classList.add('kt-nav__link-text');
                        editLi.classList.add('kt-nav__item');
                        editLink.classList.add('kt-nav__link');
                        editLink.href = '/dashboard/nationalities/'+ data.id +'/edit';
                        editI.classList.add('kt-nav__link-icon', 'flaticon2-contract');
                        editSpan.classList.add('kt-nav__link-text');
                        deleteLi.classList.add('kt-nav__item');
                        deleteLink.classList.add('kt-nav__link', 'delete-item');
                        deleteLink.setAttribute('data-id', data.id);
                        deleteI.classList.add('kt-nav__link-icon', 'flaticon2-trash');
                        deleteSpan.classList.add('kt-nav__link-text');

                        //showSpan.textContent = locator.__("Show");
                        //showLink.appendChild(showI);
                        //showLink.appendChild(showSpan);
                        //showLi.appendChild(showLink);

                        editSpan.textContent = locator.__("edit");
                        editLink.appendChild(editI);
                        editLink.appendChild(editSpan);
                        editLi.appendChild(editLink);

                        deleteSpan.textContent = locator.__("delete");
                        deleteLink.href = "#";
                        deleteLink.appendChild(deleteI);
                        deleteLink.appendChild(deleteSpan);
                        deleteLi.appendChild(deleteLink);

                        //dropdownNav.appendChild(showLi);
                        dropdownNav.appendChild(editLi);
                        dropdownNav.appendChild(deleteLi);

                        dropDownButton.appendChild(dropdownIcon);
                        dropdownMenu.appendChild(dropdownNav);
                        dropdown.appendChild(dropDownButton);
                        dropdown.appendChild(dropdownMenu);
                        return dropdown;
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
            demo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableLocalSortDemo.init();
});
