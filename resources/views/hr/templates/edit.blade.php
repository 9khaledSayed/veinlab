@extends('layouts.hr')

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
                <a href="{{route('dashboard.hr.templates.index')}}" class="btn btn-secondary">
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
            <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.hr.templates.update', $template)}}">
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
                        <div class="col-lg-6 col-md-9 col-sm-12">
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
                                <a href="{{route('dashboard.hr.templates.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
                    "(Arabic)":"(عربي)",
                    "(English)":"(انجليزي)",
                    "Name":"اسم المنشأة",
                    'Employee Info':'بيانات الموظف',
                    'Full name':'اسم الموظف',
                    'HR name':'مدير الموارد البشرية',
                    'Salary':'الراتب',
                    'CEO Signature':'توقيع المدير',
                    'Nationality':'الجنسية',
                    'Joined date':'تاريخ الالتحاق',
                    'Jop title':'المسمي الوظيفي',
                    'Birthdate':'تاريخ الميلاد',
                    'Phone':'رقم الجوال',
                    'Deduction Reason':'سبب المخالفة',
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
            let t1 = 'employeeInfoBtn companyInfoBtn contractInfoBtn salaryInfoBtn terminationBtn othersBtn printDateBtn'
            @switch($template->type)
            @case(0)
                t1 = 'employeeInfoBtn companyInfoBtn salaryInfoBtn othersBtn printDateBtn'
            @break
            @case(1) // مخالصة استلام مستحقات نهاية خدمة
                t1 = 'employeeInfoBtn companyInfoBtn  salaryInfoBtn terminationBtn othersBtn printDateBtn'
            @break
            @case(2) // شهادة خدمة
                t1 = 'employeeInfoBtn companyInfoBtn   salaryInfoBtn terminationBtn othersBtn printDateBtn'
            @break
            @case(3)    // مسودة عقد منشأة
                t1 = 'employeeInfoBtn companyInfoBtn  contractInfoBtn salaryInfoBtn  printDateBtn'
            @break
            @case(4) // الانذار الكتابي
                t1 = 'employeeInfoBtn companyInfoBtn deductionBtn printDateBtn'
            @break
            @case(5) // ترويسة الورق الرسمي
                t1 = 'companyInfoBtn othersBtn   printDateBtn'
            @break
            @case(6)
                t1 = 'companyInfoBtn othersBtn  printDateBtn'
            @break
            @endswitch
            tinymce.init({
                selector: '#kt-tinymce-2',
                menu: {
                    custom: { title: locator.__('Variables'), items: t1 }
                },
                menubar: 'file edit insert custom table',
                toolbar: ['fontsizeselect |undo redo | cut copy | bold italic | lists | alignleft aligncenter alignright alignjustify',
                    'bullist numlist | advlist | autolink | print preview |  code |ltr rtl'],
                plugins : 'directionality advlist autolink link image lists charmap print preview code table',
                fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',

                setup: function(editor) {
                    editor.ui.registry.addNestedMenuItem('employeeInfoBtn', {
                        text: locator.__('Employee Info'),
                        getSubmenuItems: function() {
                            return [
                                {
                                type: 'menuitem',
                                text: locator.__('Full name') + locator.__('(Arabic)'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%employee.fullname_arabic%%</strong>');
                                }
                                },{
                                type: 'menuitem',
                                text: locator.__('Full name') + locator.__('(English)'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%employee.fullname_english%%</strong>');
                                }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Salary'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.salary%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Nationality') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.nationality_arabic%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Nationality') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.nationality_english%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Joined date'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.joined_date%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Jop title') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.jop_title_arabic%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Jop title') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.jop_title_english%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Birthdate'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.birthdate%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Phone'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.phone%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Identity num'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.identity_num%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Identity type') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.identity_type_arabic%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Identity type') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.identity_type_english%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Identity issueDate'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.identity_issuedate%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Identity expireDate'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%employee.identity_expiredate%%</strong>');
                                    }
                                },
                                ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('salaryInfoBtn', {
                        text: locator.__('Salary Information'),
                        getSubmenuItems: function() {
                            return [
                                {
                                    type: 'menuitem',
                                    text: locator.__('Basic salary'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%salary.basic_salary%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Allowance'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%salary.allowance%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Total salary'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%salary.total%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Salary breakdown table'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%salary.table%%</strong>');
                                    }
                                },
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('terminationBtn', {
                        text: locator.__('Termination Info'),
                        getSubmenuItems: function() {
                            return [{
                                type: 'menuitem',
                                text: locator.__('End of service'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%termination.end_of_service%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: locator.__('Entitlements'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%termination.entitlements%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: locator.__('Leave balance'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%termination.leave_balance%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: locator.__('Termination date'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%termination.date%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: locator.__('Termination reason'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%termination.reason%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: locator.__('Obligations'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%termination.obligations%%</strong>');
                                }
                            },{
                                type: 'menuitem',
                                text: locator.__('Total'),
                                onAction: function() {
                                    editor.insertContent(' <strong>%%termination.total%%</strong>');
                                }
                            },
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('companyInfoBtn', {
                        text: locator.__('Company Info'),
                        getSubmenuItems: function() {
                            return [
                                {
                                    type: 'menuitem',
                                    text: locator.__('Name') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.arabic_name%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Name') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.english_name%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('CR number'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.cr%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Address') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.address_arabic%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Address') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.address_english%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('CEO name') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.ceo_name_arabic%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('CEO name') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.ceo_name_english%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('CEO Signature'),
                                    onAction: function() {
                                        editor.insertContent('<img src="%%company.ceo_signature%%" alt="توقيع المدير" width="150"/>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('HR name') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.hr_name_arabic%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('HR name') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.hr_name_english%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('City') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.city_arabic%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('City') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.city_english%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Country') + locator.__('(Arabic)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.country_arabic%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Country') + locator.__('(English)'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.country_english%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Stamp'),
                                    onAction: function() {
                                        editor.insertContent('<img src="%%company.stamp%%" alt="ختم الشركة" width="150"/>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Email'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.email%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Telephone'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.telephone%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Postal code'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%company.postal_code%%</strong>');
                                    }
                                },
                            ];
                        }
                    });

                    editor.ui.registry.addNestedMenuItem('contractInfoBtn', {
                        text: locator.__('Contract Info'),
                        getSubmenuItems: function() {
                            return [
                                {
                                    type: 'menuitem',
                                    text: locator.__('Period'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%contract.period%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('Start date'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%contract.start_date%%</strong>');
                                    }
                                },{
                                    type: 'menuitem',
                                    text: locator.__('End date'),
                                    onAction: function() {
                                        editor.insertContent(' <strong>%%contract.end_date%%</strong>');
                                    }
                                },
                            ];
                        }
                    });
                    editor.ui.registry.addNestedMenuItem('othersBtn', {
                        text: locator.__('Others'),
                        getSubmenuItems: function() {
                            return [
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
                                        editor.insertContent('<img src="%%others.header_url%%" width="50" alt="شعار الترويسة" />');
                                    }
                                }, {
                                    type: 'menuitem',
                                    text: locator.__('Footer URL'),
                                    onAction: function() {
                                        editor.insertContent('<img src="%%others.footer_url%%" width="50" alt="شعار التذيل" />');
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
                    editor.ui.registry.addMenuItem('printDateBtn', {
                        text: locator.__('Print Date'),
                        onAction: function() {
                            editor.insertContent(' <strong>%%print.date%%</strong>');
                        }
                    });

                    editor.ui.registry.addMenuItem('deductionBtn', {
                        text: locator.__('Deduction Reason'),
                        onAction: function() {
                            editor.insertContent(' <strong>%%deduction.reason%%</strong>');
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
