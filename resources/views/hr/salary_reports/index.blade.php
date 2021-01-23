@extends('layouts.hr')
@section('content')

        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                            {{__('Salary Reports')}}
                        </h3>
                        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <a href="#" class="">
                    </a>
                    <a href="{{route('dashboard.hr.salary_reports.create')}}" class="btn btn-label-brand btn-bold">
                        <i class="fa fa-plus"></i>
                        {{__('Add New')}}
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
                        {{__('All Salary Reports')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-form kt-form--label-right kt-margin-b-30">
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
                                            <label>{{__('Date')}}:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_date">
                                                <option value="">{{__('All')}}</option>
                                                @foreach($dates as $date)
                                                    <option value="{{ Date::parse($date)->format('F Y') }}">{{ Date::parse($date)->format('F Y') }}</option>
                                                @endforeach
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
                                                <option value="{{__('Pending')}}">{{__('Pending')}}</option>
                                                <option value="{{__('Approved')}}">{{__('Approved')}}</option>
                                                <option value="{{__('Rejected')}}">{{__('Rejected')}}</option>
                                                <option value="{{__('Cancelled')}}">{{__('Cancelled')}}</option>
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
        </div>

        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid kt-padding-0">

            <!--Begin::Section-->
            <div class="row" id="container_1">
                @foreach($salary_reports as $salary_report)
                <div class="col-xl-3 container_2 droid_font">

                    <!--Begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid container_3">
                        <div class="kt-portlet__head kt-portlet__head--noborder">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body container_4">

                            <!--begin::Widget -->
                            <div class="kt-widget kt-widget--user-profile-2">
                                <div class="kt-widget__head">
                                    <div class="kt-widget__info">
                                        <a href="#" class="kt-widget__username search_item">{{ Date::parse($salary_report->date)->format('F Y') }}</a>

                                        <div class="text-center">
                                            <span class="kt-widget__desc search_item">{{__('Salary Reports')}}</span>
                                            @switch($salary_report->status)
                                                @case('1')
                                                    <span class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill kt-badge--rounded mt-3">
                                                        {{__('Pending')}}
                                                    </span>
                                                    @break
                                                @case('2')
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded mt-3">
                                                        {{__('Approved')}}
                                                    </span>
                                                    @break
                                                @case('3')
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded mt-3">
                                                        {{__('Rejected')}}
                                                    </span>
                                                    @break
                                                @case('4')
                                                    <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill kt-badge--rounded mt-3">
                                                        {{__('Cancelled')}}
                                                    </span>
                                                    @break
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget__body ">

                                    <div class="kt-widget__item mt-15">
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label">{{__('Employees No')}} :</span>
                                            <a href="#" class="kt-widget__data search_item">{{$salary_report->employees_no}}</a>
                                        </div>
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label">{{__('Report total netpay')}} :</span>
                                            <span class="kt-widget__data search_item">{{$salary_report->total_net_salary}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget__footer">
                                    <a href="{{route('dashboard.hr.salary_reports.show', $salary_report)}}" class="btn btn-label-brand btn-lg btn-upper">{{__('Show Details')}}</a>
                                </div>
                            </div>

                            <!--end::Widget -->
                        </div>
                    </div>

                    <!--End::Portlet-->
                </div>
                @endforeach
            </div>

            <!--End::Section-->


            <!--Begin::Pagination-->
            <div class="row">
                <div class="col-xl-12">

                    <!--begin:: Components/Pagination/Default-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">

                            <!--begin: Pagination-->
                            <!--begin: Pagination-->
                            <div class="kt-pagination kt-pagination--brand">
                                <ul class="kt-pagination__links">
                                    <li class="kt-pagination__link--first">
                                        <a href="#"><i class="fa fa-angle-double-right kt-font-brand"></i></a>
                                    </li>

                                    <li class="kt-pagination__link--next">
                                        <a href="#"><i class="fa fa-angle-right kt-font-brand"></i></a>
                                    </li>

                                    @for( $i = 0 ,$k = 1  ; $i < $no_sal_report ; $i += 8 , $k++)
                                        <li>
                                            <a href="{{$salary_reports->url($k)}}">{{$k}}</a>
                                        </li>
                                    @endfor

                                    <li class="kt-pagination__link--prev">
                                        <a href="#"><i class="fa fa-angle-left kt-font-brand"></i></a>
                                    </li>
                                    <li class="kt-pagination__link--last">
                                        <a href="#"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
                                    </li>
                                </ul>
                            </div>

                            <!--end: Pagination-->
                        </div>
                    </div>

                    <!--end:: Components/Pagination/Default-->
                </div>
            </div>

            <!--End::Pagination-->
        </div>

        <!-- end:: Content -->


@endsection

@push('scripts')


<script type="text/javascript">

        $(document).ready(function(){

            $('#kt_form_date , #kt_form_status ').selectpicker();

            $("#generalSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".col-xl-3").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $("#kt_form_date").on("change", function() {
                var value = $(this).val().toLowerCase();
                $(".col-xl-3").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $("#kt_form_status").on("change", function() {
                var value = $(this).val().toLowerCase();
                $(".col-xl-3").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

</script>


@endpush
