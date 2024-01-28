@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Suspend Salary')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <div class="kt-portlet" >
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add" data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.hr.decisions.suspend_employee')}}" method="post" class="kt-form" style="width: 80%" id="kt_contacts_add_form">
                    @csrf
                    <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <div class="form-group row">
                                                            <div class="col-lg-4">
                                                                <label for="kt_select2">{{__('Employee Name / ID')}} *</label>
                                                                <select class="form-control kt-select2"
                                                                        id="kt_select2"
                                                                        name="employee_id">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label for="termination_date">{{__('From Date')}} *</label>
                                                                <div class="input-group date">
                                                                    <input name="sus_from_date" type="text" class="form-control month_pic" readonly/>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label for="termination_date">{{__('To Date')}}</label>
                                                                <div class="input-group date">
                                                                    <input name="sus_end_date" type="text" class="form-control month_pic" readonly/>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto" style="display: block" data-ktwizard-type="action-submit">
                                {{__('Submit')}}
                            </div>
                        </div>

                        <!--end: Form Actions -->
                    </form>

                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/pages/suspend_employee.js')}}" type="text/javascript"></script>
    <script>
        $(function (){
            var arrows;
            if (KTUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            } else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }
            $('.month_pic').datepicker({
                orientation: "bottom",
                rtl: KTUtil.isRTL(),
                language: 'ar',
                clearBtn: true,
                format: "yyyy-mm",
                viewMode: "months",
                minViewMode: "months"
            });
            // CSRF Token
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            function locationResultTemplater(location) {
                if(typeof location.fname_arabic == 'undefined' && typeof location.lname_arabic == 'undefined'){
                    return 'searching....';
                }
                return location.fname_arabic + " " + location.lname_arabic;
            }
            $( "#kt_select2" ).select2({
                placeholder: "{{__('Choose')}}",
                allowClear: true,
                ajax: {
                    url: "/dashboard/hr/employees",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                },
                templateResult: locationResultTemplater,
                templateSelection: function(item) { return item.fname_arabic || item.text; }
            });


        });
    </script>
@endpush
