@extends('layouts.dashboard')
@section('content')
    <div class="kt-portlet" style="margin-top: 20px;">
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-lg border-bottom">
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::Total Profit-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="/dashboard/exports/create">
                                    <h4 class="kt-widget24__title">
                                        {{__('Payment Voucher')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-primary">
                                <i class="fa fa-file-invoice-dollar" style="font-size: 4rem"></i>
                            </span>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.companies.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Receipt Voucher')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">
                                <i class="fas fa-receipt" style="font-size: 4rem"></i>
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.exports.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Exports')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-danger">
                                <i class="fa fa-file-export" style="font-size: 4rem"></i>
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Orders-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.revenue.index')}}">
                                    <h4 class="kt-widget24__title">
                                        {{__('Revenue')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-dark">
                                <i class="fa fa-file-export" style="font-size: 4rem"></i>
                            </span>
                        </div>
                    </div>
                    <!--end::New Orders-->
                </div>

            </div>
        </div>
    </div>
    <!--Begin::Row-->
    <div class="row">
        <div class="col-xl-12 col-lg-12 order-lg-1 order-xl-1">
            <!--begin:: Widgets/New Users-->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Latest Invoices')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="kt-widget11">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td style="width:10%">#</td>
                                        <td style="width:15%">{{__('Patient Name')}}</td>
                                        <td style="width:15%">{{__('Amount')}}</td>
                                        <td style="width:15%">{{__('Receptionist')}}</td>
                                        <td style="width:15%">{{__('Created')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latest_invoices as $invoice)
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__sub">{{$invoice->id}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{$invoice->patient->name??''}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{$invoice->total_price}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{$invoice->employee->name}}</span>
                                            </td>
                                            <td>{{$invoice->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/New Users-->
        </div>
    </div>
    <!--End::Row-->
@endsection
