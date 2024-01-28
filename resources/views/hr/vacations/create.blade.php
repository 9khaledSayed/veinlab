@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item mt-4" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Give A Vacation')}}
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
                    <form action="/dashboard/hr/vacations" method="post" class="kt-form" id="kt_contacts_add_form">
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
                                                        <div class="kt-portlet__body">
                                                            <div class="form-group row mb-4">
                                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                                    <label for="LeaveTypeId">
                                                                        {{__('Employee')}}
                                                                    </label>
                                                                    <select class="form-control kt-selectpicker" data-val="true" style="padding:5px" name="employee_id" id="employee_id">
                                                                        <option value="">
                                                                            {{__('Choose')}}
                                                                        </option>
                                                                        @foreach($employees as $employee)
                                                                            <option value="{{$employee->id}}">{{$employee->fname_arabic .' ' . $employee->mname_arabic . ' ' . $employee->lname_arabic}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('employee_id')
                                                                    <div class="invalid-feedback">{{ $errors->first('employee_id') }}</div>
                                                                    @enderror
                                                                </div>

                                                                    <div class="col-3">
                                                                        <label for="LeaveTypeId" style="visibility:hidden">
                                                                            {{__('Employee')}}
                                                                        </label>
                                                                            <div class="kt-checkbox-list ml-3 mr-3 checkbox mt-2">
                                                                                 <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                                                                    <input name="paid"  type="checkbox" >
                                                                                        {{__('Paid Or Not')}}
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                    </div>

                                                            </div>
                                                            <div class="form-group row mt-1">
                                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                                    <label for="LeaveTypeId">
                                                                        {{__('vacation type')}}
                                                                    </label>
                                                                    <select class="form-control kt-selectpicker" data-val="true"  style="padding:5px" name="vacation_id" id="vacation_id">
                                                                        <option value="">
                                                                            {{__('Choose')}}
                                                                        </option>
                                                                        @foreach($vacationTypes as $vacationType)
                                                                        <option value="{{$vacationType->id}}">{{$vacationType->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('vacation_type')
                                                                    <div class="invalid-feedback">{{ $errors->first('vacation_type') }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                                    <label for="from_date">{{__('start date')}}<span class="required">*</span></label>
                                                                    <div class="input-group date">
                                                                        <input name="from_date" type="text" class="form-control from_datee" readonly id="kt_datepicker_2" />
                                                                        <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar"></i>
                                                                    </span>
                                                                        </div>
                                                                        @error('from_date')
                                                                        <div class="invalid-feedback">{{ $errors->first('from_date') }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                                    <label for="to_date">{{__('end date')}}<span class="required">*</span></label>
                                                                    <div class="input-group date">
                                                                        <input name="to_date" type="text" class="form-control to_datee" readonly id="kt_datepicker_3" />
                                                                        <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar"></i>
                                                                    </span>
                                                                        </div>
                                                                        @error('to_date')
                                                                        <div class="invalid-feedback">{{ $errors->first('to_date') }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mt-3">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="kt-portlet kt-portlet--unelevate kt-portlet--bordered">
                                                                        <div class="kt-portlet__body text-center">
                                                                            <span class="display-4" id="vacation_days">0</span>
                                                                            {{__('vacation days')}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="kt-portlet kt-portlet--unelevate kt-portlet--bordered">
                                                                        <div class="kt-portlet__body text-center">
                                                                        <span class="display-4" id="vacation_balance">
                                                                            0
                                                                        </span>
                                                                            {{__('credit')}}
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
    <script src="{{asset('js/pages/give_vacation.js')}}" type="text/javascript"></script>
    <script>


        $( document ).ready(function() {
            var vacation_id;
            var employee_id;

            $('.kt-selectpicker').selectpicker();

            $("#vacation_id").change(function() {
                 vacation_id = $("#vacation_id").val();
                 employee_id = $("#employee_id").val();

                if ( $("#employee_id").val() != "")
                {
                    $.ajax({
                        type:'GET',
                        url:'/dashboard/hr/vacations/getLeaveBalance',
                        data:
                            {
                                employee_id:employee_id,
                                vacation_id:vacation_id,
                            },
                        success:function(data) {
                            if (data.no_days)
                            {
                                $("#vacation_balance").html(data.no_days);
                            }else
                            {
                                $("#vacation_balance").html(0);
                            }
                        },
                    });
                }
            });

            $("#employee_id").change(function() {

                vacation_id = $("#vacation_id").val();
                employee_id = $("#employee_id").val();

                if ( vacation_id != "")
                {
                    $.ajax({
                        type:'GET',
                        url:'/dashboard/hr/vacations/getLeaveBalance',
                        data:
                            {
                                employee_id:employee_id,
                                vacation_id:vacation_id,
                            },
                        success:function(data) {
                            if (data.no_days)
                            {
                                $("#vacation_balance").html(data.no_days);
                            }else
                            {
                                $("#vacation_balance").html(0);
                            }
                            },
                    });
                }
            });

        });





        $( ".from_datee" ).focusout(function() {

            var to_date = $( ".to_datee" ).val();

            if ( to_date)
            {
                const date1 = new Date(to_date);
                const date2 = new Date(this.value);
                const diffTime = Math.abs(date2 - date1);
                diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                $("#vacation_days").html(diffDays);
                console.log(diffDays)
            }
        });

        $( ".to_datee" ).focusout(function() {
                // $( "#focus-count" ).text( "focusout fired: " + focus + "x" );
            var from_date = $( ".from_datee" ).val();

            if ( from_date)
            {
                const date1 = new Date(from_date);
                const date2 = new Date(this.value);
                const diffTime = Math.abs(date2 - date1);
                diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                $("#vacation_days").html(diffDays);

            }
            });

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
        // enable clear button
        $('#kt_datepicker_3, #kt_datepicker_3_validate').datepicker({
            rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            format:'yyyy-mm-dd',
            clearBtn: true,
            todayHighlight: true,
            templates: arrows
        });
        // enable clear button
        $('#kt_datepicker_2, #kt_datepicker_2_validate').datepicker({
            rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            clearBtn: true,
            format:'yyyy-mm-dd',
            todayHighlight: true,
            templates: arrows
        });

    </script>
@endpush
