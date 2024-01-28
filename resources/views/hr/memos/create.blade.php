@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item mt-4" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Memos')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.memos.index')}}" class="btn btn-secondary">
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
                    <form action="{{route('dashboard.hr.memos.store')}}" method="post" class="kt-form"
                          id="kt_contacts_add_form">
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
                                                             <div class="row" >
                                                                 <div class="col-lg-6 col-md-6 col-sm-12">
                                                                     <label for="StartDate">{{__('Branch')}}<span class="required">*</span></label>
                                                                     <select class="form-control kt-selectpicker" data-val="true"  name="branch_id">
                                                                         <option value="">
                                                                             {{__('Choose')}}
                                                                         </option>
                                                                         @foreach( $branches as $branch )
                                                                             <option selected value="{{$branch->id}}">{{$branch->name}}</option>
                                                                         @endforeach

                                                                     </select>
                                                                     @error('branch_id')
                                                                     <div class="invalid-feedback">
                                                                         {{$message}}
                                                                     </div>
                                                                     @enderror
                                                                 </div>
                                                             </div> <br><br>
                                                                    <div class="form-group form-group-marginless">

                                                                        <label>أيقونة التنبية</label>
                                                                        <input type="radio" value="success"  name="icon" style="visibility:hidden">
                                                                        <br><br>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="kt-option kt-option--plain">
                                                                                    <span class="kt-option__control">
                                                                                        <span class="kt-radio kt-radio--check-bold kt-radio--brand">
                                                                                            <input checked type="radio" value="success"  name="icon">
                                                                                            <span></span>
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="kt-option__label">
                                                                                    <span class="kt-option__head">
                                                                                        <span class="kt-option__title">
                                                                                            <i class="fa fa-check fa-2x kt-font-success"> </i>
                                                                                        </span>
                                                                                    </span>
                                                                                </span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="kt-option kt-option--plain">
                                                                                        <span class="kt-option__control">
                                                                                            <span class="kt-radio kt-radio--check-bold kt-radio--brand">
                                                                                                <input type="radio" value="info" name="icon">
                                                                                                <span></span>
                                                                                            </span>
                                                                                        </span>
                                                                                    <span class="kt-option__label">
                                                                                    <span class="kt-option__head">
                                                                                        <span class="kt-option__title">
                                                                                            <i class="fa fa-info-circle fa-2x kt-font-warning"> </i>
                                                                                        </span>
                                                                                    </span>
                                                                                </span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="kt-option kt-option--plain">
                                                                                    <span class="kt-option__control">
                                                                                        <span class="kt-radio kt-radio--check-bold kt-radio--brand">
                                                                                            <input type="radio" value="error" name="icon">
                                                                                            <span></span>
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="kt-option__label">
                                                                                    <span class="kt-option__head">
                                                                                        <span class="kt-option__title">
                                                                                            <i class="fa fa-times fa-2x kt-font-danger"> </i>
                                                                                        </span>
                                                                                    </span>
                                                                                </span>
                                                                                </label>
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="form-group"><label
                                                                                        for="TitleArabic" class="">العنوان
                                                                                        عربي <span
                                                                                        class="required">*</span></label><input
                                                                                        autocomplete="off"
                                                                                        class="form-control"
                                                                                        name="title_ar"
                                                                                        placeholder="" type="text"
                                                                                        aria-invalid="false">
                                                                                </div>
                                                                                @error('title_ar')
                                                                                <div class="invalid-feedback">
                                                                                    {{$message}}
                                                                                </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="form-group"><label
                                                                                        for="TitleArabic" class="">العنوان
                                                                                        انجليزي <span
                                                                                            class="required">*</span></label><input
                                                                                        autocomplete="off"
                                                                                        class="form-control"
                                                                                        name="title_en"
                                                                                        placeholder="" type="text"
                                                                                        aria-invalid="false">
                                                                                </div>
                                                                                @error('title_en')
                                                                                <div class="invalid-feedback">
                                                                                    {{$message}}
                                                                                </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    النص عربي *
                                                                                </label>
                                                                                <textarea rows="5" class="form-control" name="text_ar"></textarea>
                                                                                @error('text_ar')
                                                                                <div class="invalid-feedback">
                                                                                    {{$message}}
                                                                                </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">

                                                                            <div class="form-group">
                                                                                <label>
                                                                                    النص انجليزي *
                                                                                </label>
                                                                                <textarea rows="5" class="form-control"name="text_en"></textarea>
                                                                                @error('text_en')
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
    <script src="{{asset('js/pages/memo.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.kt-selectpicker').selectpicker();
        });
    </script>
@endpush
