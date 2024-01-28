@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Main Analysis')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('All Main Analysis')}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{route('dashboard.index')}}" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        {{__('Back')}}
                    </a>
                    @can('view_reports')
                    <a href="/export/main_analysis" class="btn btn-danger btn-icon-sm ml-2 mr-2">
                        <i class="la la-file-excel-o"></i> {{__('Export')}}
                    </a>
                    @endcan
                    @can('create_main_analysis')
                    <a href="{{route('dashboard.main_analysis.create')}}" class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> {{__('Add New')}}
                    </a>
                    @endcan
                    @can('view_reports')
                    <a href="#" id="report" class="btnprn btn btn-primary btn-icon-sm mx-2">
                        <i class="flaticon2-download"></i> {{__('Report')}}
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="{{__('Search')}}..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>
{{--                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">--}}
{{--                                <div class="kt-form__group kt-form__group--inline">--}}
{{--                                    <div class="kt-form__label">--}}
{{--                                        <label>{{__('Date')}}:</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="kt-form__control">--}}
{{--                                        <select class="form-control bootstrap-select" id="kt_form_date">--}}
{{--                                            <option value="">{{__('All')}}</option>--}}
{{--                                            <option value="1">{{__('Today')}}</option>--}}
{{--                                            <option value="2">{{__('Last Week')}}</option>--}}
{{--                                            <option value="3">{{__('Last Month')}}</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                                <form method="get" action="{{route('dashboard.main_analysis.report')}}" id="date_form">
                                    @csrf
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>{{__('Date')}}:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <div class="input-group date">
                                                <input name="date" type="text" class="form-control datepic" id="kt_form_date" readonly/>
                                                <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <div class="kt-datatable" id="child_data_local"></div>

            <!--end: Datatable -->
        </div>
    </div>
    <!-- end:: Content -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @if($isLab && !$isSuperAdmin)
        <script src="{{asset('js/datatables/lab_main_analysis.js')}}" type="text/javascript"></script>
    @else
        <script src="{{asset('js/datatables/main_analysis.js')}}" type="text/javascript"></script>
    @endif
@endpush
