'use strict';
// Class definition

var KTDatatableChildRemoteDataDemo = function() {
    // Private functions
    var messages = {
        'ar': {
            'Arabic Name': "الاسم بالعربية",
            'English Name': "الاسم بالانجليزية",
            'Load sub table': "اظهار الجدول الفرعي",
            'created': "تاريخ اﻹنشاء",
            'Created': "تاريخ اﻹنشاء",
            "Actions": "الاجراءات",
            'Ability': "الدور",
            'Type': "النوع",
            'System Role': "صلاحية نظام",
            'Are you sure to delete this item?': "هل انت متأكد أنك تريد مسح هذا العنصر؟",
            'Yes, Delete!': "نعم امسح!",
            'Item Deleted Successfully': "تم مسح العنصر بنجاح",
            'No, cancel': "لا الغِ",
            'OK': "تم",
            'Loading...': "تحميل...",
            'Error!': "خطأ!",
            'Deleted!': "تم المسح!",
            'Show': "عرض",
            'edit': "تعديل",
            'delete': "مسح",
            "Error Can't Delete System Role!": "لا يمكنك مسح صلاحية النظام"
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
                        url: '/dashboard/roles',
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
                                    },
                                });
                                if (data.type == 1) {
                                    swal.fire({
                                        title: locator.__('Error Can\'t Delete System Role!'),
                                        type: 'error',
                                    });
                                }else {
                                    $.ajax({
                                        method: 'DELETE',
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                        url: '/dashboard/roles/' + data.id,
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

                            }
                        });
                    });
                }
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
                    field: 'checkbox',
                    title: '',
                    template: '{{id}}',
                    sortable: false,
                    width: 20,
                    textAlign: 'center',
                    selector: {class: 'kt-checkbox--solid'},
                }, {
                    field: 'name_arabic',
                    title: locator.__('Arabic Name'),
                    sortable: 'asc',
                }, {
                    field: 'name_english',
                    title: locator.__('English Name'),
                    sortable: 'asc',
                },{

                    field: 'type',
                    title: locator.__('Type'),
                    textAlign: 'center',
                    template: function(row) {
                        var type = {
                            1: {'title': locator.__('System Role')  , 'class': ' kt-badge--danger'},
                            2: {'title': ''  , 'class': ''},
                        };
                        return '<span class="kt-badge ' + type[row.type].class + ' kt-badge--inline kt-badge--pill">' + type[row.type].title + '</span>';
                    },
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
                        showLink.href = '/dashboard/roles/' + data.id;
                        showI.classList.add('kt-nav__link-icon', 'flaticon-eye');
                        showSpan.classList.add('kt-nav__link-text');
                        editLi.classList.add('kt-nav__item');
                        editLink.classList.add('kt-nav__link');
                        editLink.href = '/dashboard/roles/' + data.id + '/edit';
                        editI.classList.add('kt-nav__link-icon', 'flaticon2-contract');
                        editSpan.classList.add('kt-nav__link-text');
                        deleteLi.classList.add('kt-nav__item');
                        deleteLink.classList.add('kt-nav__link', 'delete-item');
                        deleteLink.setAttribute('data-id', data.id);
                        deleteI.classList.add('kt-nav__link-icon', 'flaticon2-trash');
                        deleteSpan.classList.add('kt-nav__link-text');

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

                        dropdownNav.appendChild(showLi);
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

        $('#kt_form_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Type');
        });

        $('#kt_form_status,#kt_form_date').selectpicker();

        function subTableInit(e) {
            $('<div/>').attr('id', 'child_data_ajax_' + e.data.id).appendTo(e.detailCell).KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            method:'get',
                            url: '/dashboard/abilities?role_id=' + e.data.id,
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
                        field: 'label',
                        title: locator.__('Ability'),
                    }, {
                        field: 'created_at',
                        title: locator.__('Created'),
                    }
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
