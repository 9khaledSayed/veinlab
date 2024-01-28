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
                    {{__('Holidays')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.holidays.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <div class="kt-portlet" >
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('New Holiday')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add" data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.hr.holidays.store')}}" method="post" class="kt-form" style="width: 80%" id="kt_contacts_add_form">
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
                                                            <div class="col-lg-6">
                                                                <label>{{__('Arabic Name')}} *</label>
                                                                <input name="name_arabic"
                                                                       type="text"
                                                                       class="form-control"
                                                                       aria-describedby="basic-addon1">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>{{__('English Name')}} *</label>
                                                                <input name="name_english"
                                                                       type="text"
                                                                       class="form-control"
                                                                       aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" >
                                                            <div class="col-lg-6">
                                                                <label>{{__('From Date')}} *</label>
                                                                <div class="input-group date">
                                                                    <input name="from_date" type="text" class="form-control datepic" readonly />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <span class="alert-success" id="message1"></span>
                                                                <span class="alert-danger" id="message2"></span>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>{{__('To Date')}} *</label>
                                                                <div class="input-group date">
                                                                    <input name="to_date" type="text" class="form-control datepic" readonly />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <span class="alert-success" id="message1"></span>
                                                                <span class="alert-danger" id="message2"></span>
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
    <script src="{{asset('js/pages/holidays.js')}}" type="text/javascript"></script>
@endpush
