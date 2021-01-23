@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item mt-5" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Additions / Deductions Types')}}
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

    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add"
                 data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.hr.adds_deds_types.update',$additionDeductionTypes->id)}}" method="post" class="kt-form"
                          id="kt_contacts_add_form">
                    @method('PUT')
                    @csrf
                    <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"
                             data-ktwizard-state="current">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <div class="kt-portlet__body">
                                                            <div class="form-group form-group-marginless">


                                                                <div class="form-group row mt-5 mb-5">
                                                                    <div class="col-6">
                                                                        <label>{{__('Name Arabic')}} *</label>
                                                                        <input name="name_ar" class="form-control" type="text" value="{{$additionDeductionTypes->name_ar}}">
                                                                        @error('name_ar')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label>{{__('Name English')}} *</label>
                                                                        <input name="name_en" class="form-control"  type="text" value="{{$additionDeductionTypes->name_en}}">
                                                                        @error('name_en')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mt-5 mb-5">
                                                                    <div class="col-12">
                                                                        <label>{{__('Operation Type')}} *</label>
                                                                        <select class="form-control kt-selectpicker" data-val="true" name="operation_type" >
                                                                            <option value="">
                                                                                {{__('Choose')}}
                                                                            </option>

                                                                            <option @if($additionDeductionTypes->operation_type == 2) selected @endif value="2">
                                                                                {{__('Addition')}}
                                                                            </option>
                                                                            <option  @if($additionDeductionTypes->operation_type == 1) selected @endif  value="1">
                                                                                {{__('Deduction')}}
                                                                            </option>
                                                                        </select>

                                                                        @error('operation_type')
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
                        </div>
                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div
                                class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto"
                                style="display: block" data-ktwizard-type="action-submit">
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

    <script type="text/javascript">
        var editPage = true;
    </script>

    <script src="{{asset('js/pages/adds_deds_types.js')}}" type="text/javascript"></script>
@endpush
