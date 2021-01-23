    "use strict";
// Class definition

var KTUserListDatatable = function() {
    // Private functions
    var messages = {
        'ar': {
            'Employee Name': "اسم الموظف",
            'Amount': "المبلغ",
            'Check no': "رقم الشيك",
            'Bank': "البنك",
            'Check Date': "تاريخ الشيك",
            'This About': "وذلك عن",
            'Source': "المصدر",
            'Serial No': "رقم السلسلة",
            'Wallet': "المحفطة",
            'All Money': "جميع النقود",
            'Patients': "المرضي",
            "Actions": "الاجراءات",
            'Invoice':"فاتورة",
            'Insurance Company':"شركة تأمين",
            'Hospital':"مركز طبي",
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
                        url: '/dashboard/revenue',
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
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    width: 30,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                },
                {
                    field: 'employee.name',
                    title: locator.__('Employee Name'),
                    textAlign: 'center',
                    template:function(row){
                        let employee = row.employee;
                        return row.employee.fname_arabic + ' ' + employee.lname_arabic
                    }
                },
                {
                    field: 'amount',
                    title: locator.__('Amount'),
                    textAlign: 'center',
                },{
                    field: 'bank',
                    title: locator.__('Bank'),
                    textAlign: 'center',
                    template:function (row){
                        if(!row.bank){
                            return '-';
                        }else{
                            return row.bank;
                        }
                    }
                },{
                    field: 'type',
                    title: locator.__('Source'),
                    textAlign: 'center',
                    template: function(row) {
                        var type = {
                            1: {'title': locator.__('Invoice')              , 'class': ' kt-badge--danger'},
                            2: {'title': locator.__('Insurance Company')    , 'class': ' kt-badge--primary'},
                            3: {'title': locator.__('Hospital')    , 'class': ' kt-badge--warning'},
                        };
                        return '<span class="kt-badge ' + type[row.type].class + ' kt-badge--inline kt-badge--pill">' + type[row.type].title + '</span>';
                    },
                },{
                    field: 'serial_no',
                    title: locator.__('Serial No'),
                    textAlign: 'center',
                },{
                    field: 'created_at',
                    title: locator.__('Patients'),
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
                                  <a class="dropdown-item" href="/dashboard/revenue/' +  row.id + '" ><i class="la la-leaf"></i>' + locator.__('Print Voucher') + '</a>\
                              </div>\
                          </div>\
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
        $('').selectpicker();

        $('#kt_form_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'type');
        });

        $('#kt_form_date,#kt_form_type').selectpicker();

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
