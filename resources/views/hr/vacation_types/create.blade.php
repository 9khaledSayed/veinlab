@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item mt-5" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Vacation Types')}}
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
                    <form action="{{route('dashboard.hr.vacation_types.store')}}" method="post" class="kt-form" id="kt_contacts_add_form">
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
                                                                    <label for="StartDate">{{__('Vacation Name')}}<span class="required">*</span></label>
                                                                    <input
                                                                        class="form-control @error('name') is-invalid @enderror"
                                                                        type="text"
                                                                        name="name"
                                                                        value="{{old('name')}}"
                                                                        id="example-text-input">
                                                                    @error('name')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <label for="StartDate">{{__('Number Of Days')}}<span class="required">*</span></label>
                                                                    <input
                                                                        class="form-control @error('no_days') is-invalid @enderror"
                                                                        type="text"
                                                                        name="no_days"
                                                                        value="{{old('no_days')}}"
                                                                        id="example-text-input">
                                                                    @error('no_days')
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
    <script src="{{asset('js/pages/vacation_type.js')}}" type="text/javascript"></script>
@endpush
