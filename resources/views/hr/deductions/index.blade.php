@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @include('hr.deductions.repeated-forms.late_deduction')
        @include('hr.deductions.repeated-forms.absent_deduction')
        @include('hr.deductions.repeated-forms.general_deduction')
    </div>
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Salary Reports')}}
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
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Deductions')}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{__('Add Deduction')}}</button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#kt_modal_3">{{__('General Deductions')}}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#kt_modal_5">{{__('Late Deduction')}}</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#kt_modal_4">{{__('Absent Deduction')}}</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-form kt-form--label-right kt-margin-t-10 kt-margin-b-30">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="{{__('Search')}} . . ." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                             <span><i class="la la-search"></i></span>
                            </span>
                                </div>
                            </div>
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>{{__('Date')}}:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_date">
                                            <option value="">{{__('All')}}</option>
                                            <option value="1">{{__('Today')}}</option>
                                            <option value="2">{{__('Last Week')}}</option>
                                            <option value="3">{{__('Last Month')}}</option>
                                            <option value="4">{{__('Last Year')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>{{__('Status')}}:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_status">
                                            <option value="">{{__('All')}}</option>
                                            <option value="1">{{__('Approved')}}</option>
                                            <option value="2">{{__('Cancelled')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                        <a href="#" class="btn btn-default kt-hidden">
                            <i class="la la-cart-plus"></i> New Order
                        </a>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <div class="kt-datatable" id="kt_apps_user_list_datatable"></div>

            <!--end: Datatable -->
        </div>
    </div>



@endsection

@push('scripts')
    <script src="{{asset('js/datatables/hr/deductions.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/pages/deductions.js')}}" type="text/javascript"></script>
@endpush
