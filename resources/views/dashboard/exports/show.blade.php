@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Exports')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.exports.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-invoice-2">
                <div class="kt-invoice__head">
                    <div class="kt-invoice__container">
                        <div class="kt-invoice__brand">
                            <h3 class="kt-invoice__title mx-auto">{{__('Payment Voucher')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="kt-invoice__footer">
                    <div class="kt-invoice__container">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{__('Employee')}}</th>
                                    <th>{{__('Serial No')}}</th>
                                    <th>{{__('Reason')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Total Amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$export->employee->fullname()}}</td>
                                    <td>{{$export->serial_no}}</td>
                                    <td>{{__($export->reason)}}</td>
                                    <td>{{$export->created_at}}</td>
                                    <td class="kt-font-danger kt-font-xl kt-font-boldest">{{$export->amount}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="kt-invoice__actions">
                    <div class="kt-invoice__container">
                        <button type="button" class="btn btn-brand btn-bold mx-auto" onclick="window.print();">{{__('Print voucher')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
