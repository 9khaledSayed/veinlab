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
                    {{__('Employees Services')}}
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
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Trip Request')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add" data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.hr.trip.store')}}" method="post" class="kt-form" id="kt_contacts_add_form">
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
                                                            <div class="form-group row mt-1">
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <label for="StartDate">{{__('Country')}}<span class="required">*</span></label>
                                                                    <input
                                                                        class="form-control @error('country') is-invalid @enderror"
                                                                        type="text"
                                                                        name="country"
                                                                        value="{{old('country')}}"
                                                                        id="example-text-input">
                                                                    @error('country')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <label for="StartDate">{{__('City')}}<span class="required">*</span></label>
                                                                    <input
                                                                        class="form-control @error('city') is-invalid @enderror"
                                                                        type="text"
                                                                        name="city"
                                                                        value="{{old('city')}}"
                                                                        id="example-text-input">
                                                                    @error('city')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row mt-1">
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
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
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
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
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <label>{{__('Reason')}}</label>
                                                                    <textarea
                                                                        class="form-control @error('description') is-invalid @enderror"
                                                                        name="description"
                                                                        rows="5"
                                                                        value="{{old('description')}}"
                                                                        id="example-email-input"></textarea>
                                                                    @error('description')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                    @enderror
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
    <script src="{{asset('js/pages/trip.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $(function() {

        $('.kt-selectpicker').selectpicker();
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

        });
    </script>
@endpush
