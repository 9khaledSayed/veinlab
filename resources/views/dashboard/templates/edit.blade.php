@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Templates')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.templates.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Update Info')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.templates.update', $template)}}">
                @csrf
                @method('put')
                <div class="kt-portlet__body">
                    <div class="form-group row mt-2">
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <label>{{__('Arabic Name')}} *</label>
                            <input
                                class="form-control @error('arabic_name') is-invalid @enderror"
                                type="text"
                                name="arabic_name"
                                value="{{old('arabic_name') ?? $template->arabic_name}}"
                                id="example-text-input">
                            @error('arabic_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <label>{{__('English Name')}} *</label>
                            <input
                                class="form-control @error('english_name') is-invalid @enderror"
                                type="text"
                                name="english_name"
                                value="{{old('english_name') ?? $template->english_name}}"
                                id="example-text-input">
                            @error('english_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-9 col-sm-12">
                            <label>{{__('Template Type')}} *</label>
                            <select class="form-control @error('type') is-invalid @enderror kt-select2"
                                    id="kt_select2_1"
                                    disabled>
                                <option value=""></option>
                                @forelse($types as $key => $value)
                                    <option
                                        value="{{$key}}"
                                        @if($template->type == $key) selected @endif
                                    >{{$value}}</option>
                                @empty
                                    <option disabled>{{__('There is no Types')}}</option>
                                @endforelse
                            </select>
                            @error('type')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <div class="kt-checkbox-inline">
                                <label class="kt-checkbox">
                                    <input type="checkbox" name="header" @if($template->header == 1) checked @endif> {{__('Header')}}
                                    <span></span>
                                </label>
                                <label class="kt-checkbox">
                                    <input type="checkbox" name="footer" @if($template->footer == 1) checked @endif> {{__('Footer')}}
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-5">
                        <div class="col-lg-12">
                            <textarea id="kt-tinymce-2" name="body" class="tox-target">
                                {!! $template->body !!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                <a href="{{route('dashboard.templates.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')
    <script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/tinymce/src/plugin.js')}}" type="text/javascript"></script>
    <script>
        $(function (){
            var messages = {
                'ar': {
                    'Variables':'المتغيرات',

                    'Employee Info':'بيانات الموظف',
                    'Full name':'اسم الموظف',
                    'Salary':'الراتب',
                    'Nationality':'الجنسية',
                    'Joined date':'تاريخ الالتحاق',
                    'Jop title':'المسمي الوظيفي',
                    'Birthdate':'تاريخ الميلاد',
                    'Phone':'رقم الجوال',
                    'Identity num':'رقم الهوية',
                    'Identity type':'نوع الهوية',
                    'Identity issueDate':'تاريخ اصدار الهوية',
                    'Identity expireDate':'تاريخ انتهاء الهوية',
                    'Salary Information':'بيانات الراتب',
                    'Basic salary':'الراتب الاساسي',
                    'Allowance':'البدلات',
                    'Total salary':'اجمالي الرتب',
                    'Salary breakdown table':'جدول تفاصيل الراتب',
                    'Termination Info':'بيانت نهاية الخدمة',
                    'End of service':'مكافاءة نهاية الخدمة',
                    'Entitlements':'المستحقات',
                    'Leave balance':'رصيد الاجازات',
                    'Termination date':'تاريخ انتهاء الخدمة',
                    'Termination reason':'سبب انتهاء الخدمة',
                    'Obligations':'الالتزامات',
                    'Total':'الاجمالي',
                    'Company Info':'بيانات المنشأة',
                    'Company name':'اسم المنشأة',
                    'CR number':'رقم السجل التجاري',
                    'Address':'العنوان',
                    'CEO name':'اسم مدير المنشأة',
                    'City':'المدينة',
                    'Country':'الدولة',
                    'Stamp':'ختم الشركة',
                    'Email':'البريد الاكتروني',
                    'Telephone':'رقم الهاتف',
                    'Postal code':'الرقم البريدي',
                    'Contract Info':'بيانات العقد',
                    'Period':'مدة العقد',
                    'Start date':'تاريخ بداية العقد',
                    'End date':'تاريخ انتهاء العقد',
                    'Others':'اخري',
                    'Logo URL':'شعار المنشأة',
                    'WebApp URL':'رابط المنشأة',
                    'HR Manager':'اسم موظف الموارد',
                    'Print Date':'تاريخ الطباعة',
                    'Choose':'اختر',
                }
            };
            var locator = new KTLocator(messages);
            let t1 = ''
            @switch($template->type)
                @case (7)
                     t1 = 'patientInfoBtn  invoiceInfoBtn  othersBtn';
                @break
                @case (8)
                    t1 = 'patientInfoBtn analysisInfoBtn othersBtn invoiceInfoBtn'
                @break
                @case (9)
                    t1 = 'voucherBtn'
                @break
                @case (10)
                    t1 = 'voucherBtn'
                @break
                @case (11)
                    t1 = 'stockBtn'
                @break
            @endswitch
            tinymce.init({
                selector: '#kt-tinymce-2',
                menu: {
                    custom: { title: 'Variables', items: 'patientInfoBtn  invoiceInfoBtn  othersBtn' }
                },
                menubar: 'file edit insert custom',
                toolbar: ['fontsizeselect |undo redo | cut copy | bold italic | lists | alignleft aligncenter alignright alignjustify',
                    'bullist numlist | advlist | autolink | print preview |  code |ltr rtl'],
                    plugins : 'directionality advlist autolink link image lists charmap print preview code table',
                    fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',

                setup: function(editor) {
                    editor.ui.registry.addNestedMenuItem('patientInfoBtn', {
                        text: 'Patient Info',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Arabic Name',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.arabic_name%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'English Name',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.english_name%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Identity no',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.id_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Gender',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.gender%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Age',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.age%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'File No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%patient.id%%</strong>');
                                }
                            },
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('analysisInfoBtn', {
                        text: 'Analysis Info',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Analysis Results Tables',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%analysis.analysis_results_tables%%</strong>');
                                }
                            },
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('invoiceInfoBtn', {
                        text: 'Invoice Info',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Date',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.date%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Approved Date',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.approved_date%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Time',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.time%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Invoice No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Serial No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.serial_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Hospital',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.hospital%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Company',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.company%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Doctor',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.doctor%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Policy No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.policy_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Amount without tax',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.without_tax%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Discount',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.discount%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Amount with tax',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.with_tax%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Amount Paid',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.amount_paid%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Due',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.due%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Payment method',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.pay_method%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Receiver',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%invoice.receiver%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Barcode',
                                onAction: function() {
                                    editor.insertContent(' <img src="%%invoice.barcode%%" alt="barcode"/>');
                                }
                            },
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('voucherBtn', {
                        text: 'Voucher Info',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Amount',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.amount%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Date',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.date%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Company Name',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.company_name%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'About',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.about%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Check No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.check%%</strong>');
                                }
                            },{
                                type: 'menuitem'    ,
                                text: 'Bank',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.bank%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Check Date',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.checkDate%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Receiver',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.receiver%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Accountant',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%voucher.accountant%%</strong>');
                                }
                            }
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('stockBtn', {
                        text: 'Stock Info',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Total',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%stock.total%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Invoice No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%stock.invoice_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Date',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%stock.date%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Company Name',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%stock.company_name%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Logo',
                                onAction: function() {
                                    editor.insertContent('<img src="%%stock.logo_url%%" alt="شعار الشركة" />');
                                }
                            },{
                                type: 'menuitem'    ,
                                text: 'Perchase Table',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%stock.purchases_table%%</strong>');
                                }
                            }
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('othersBtn', {
                        text: 'Others',
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: 'Tax No',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%others.tax_no%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: 'Purchase Table',
                                onAction: function() {
                                    editor.insertContent(' <strong>%%others.purchase_table%%</strong>');
                                }
                            },
                                {
                                    type: 'menuitem',
                                    text: locator.__('Logo URL'),
                                    onAction: function() {
                                        editor.insertContent('<img src="%%others.logo_url%%" class="d-block m-auto" width="100" height="100" alt="شعار الشركة" />');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('WebApp URL'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%others.app_url%%</strong>');
                                    }
                                },
                                {
                                    type: 'menuitem',
                                    text: locator.__('Logo URL'),
                                    onAction: function() {
                                        editor.insertContent('<img src="%%others.logo_url%%" alt="شعار الشركة" />');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Header URL'),
                                    onAction: function() {
                                        editor.insertContent('<img src="%%others.header_url%%" alt="شعار الترويسة" />');
                                    }
                                }, {
                                    type: 'menuitem',
                                    text: locator.__('Footer URL'),
                                    onAction: function() {
                                        editor.insertContent('<img src="%%others.footer_url%%" alt="شعار التذيل" />');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('WebApp URL'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%others.app_url%%</strong>');
                                    }
                                },
                            ];
                        }
                    });
                }

            });

            $('#kt_select2_1, #kt_select2_1_validate').select2({
                placeholder: "{{__('Choose')}}",
            });
        });
    </script>
@endpush
