    @extends('layouts.dashboard')
    @section('content')
        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        {{__('Invoices')}}
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
                        {{__('All Invoices')}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{route('dashboard.index')}}" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        {{__('Back')}}
                    </a>
                    @can('create_patients')
                    <a href="{{route('dashboard.waiting_labs.create')}}" class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> {{__('Add New')}}
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="{{__('Search')}}..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
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
                                            <option value="1">{{__('Success')}}</option>
                                            <option value="2">{{__('Discarded')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>{{__('Payment Method')}}:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_method">
                                            <option value="">{{__('All')}}</option>
                                            <option value="1">{{__('Cash')}}</option>
                                            <option value="2">{{__('Credit')}}</option>
                                        </select>
                                    </div>
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
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <div class="kt-datatable" id="ajax_data"></div>

            <!--end: Datatable -->
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.printPage.js')}}"></script>

    <script src="{{ asset('js/datatables/invoices.js') }}"></script>

@endpush
