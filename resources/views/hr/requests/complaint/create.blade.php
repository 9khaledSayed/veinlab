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
                    {{__('Complaint Request')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add" data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.hr.complaint.store')}}" method="post" class="kt-form" id="kt_contacts_add_form">
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
                                                                <div class="col-lg-6 col-md-9 col-sm-12">
                                                                    <label>  {{__('Directed To')}}<span class="required">*</span></label>
                                                                    <input class="form-control  @error('directed_department') is-invalid @enderror" type="text" value="{{ old('directed_department') }}" id="example-datetime-local-input" name="directed_department">
                                                                    @error('directed_department')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-6 col-md-9 col-sm-12">
                                                                    <label for="EndDate">{{__('Subject')}}<span class="required">*</span></label>
                                                                    <input class="form-control  @error('subject') is-invalid @enderror" type="text" value="{{ old('subject') }}" id="example-datetime-local-input" name="subject">
                                                                    @error('subject')
                                                                    <div class="invalid-feedback">{{ $errors->first('subject') }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row mt-2">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <label>{{__('Reason')}}<span class="required">*</span></label>
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
    <script src="{{asset('js/pages/complaint.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $('.kt-selectpicker').selectpicker();
        });
    </script>
@endpush
