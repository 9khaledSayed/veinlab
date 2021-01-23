@extends('layouts.hr')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Additions / Deductions')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.employees.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <div class="kt-portlet">
        <div class="modal-header">
            <h3 class="modal-title">
                {{__('Details')}}
            </h3>
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>
        </div>
        <div class="modal-body">
            <div id="payslip-details-div">
                <div class="kt-widget kt-widget--user-profile-1 employee-card employee-card-medium" style="padding-bottom:unset;">
                    <div class="kt-widget__head">
                        <div class="kt-widget__media">
                            <div class="kt-badge kt-badge--xl kt-badge--success">{{ mb_substr( $employee->fullname() ,0,2,'utf-8')}}</div>
                            <div class="text-center kt-font-bold kt-margin-t-5">
                                {{$employee->emp_num}}
                            </div>
                        </div>
                        <div class="kt-widget__content">
                            <div class="kt-widget__section">
                                <a href="#" class="kt-widget__username">
                                    {{$employee->fullname()}}
                                </a>
                                <span class="kt-widget__subtitle">
                               {{$employee->roles->first()->name()}}
                            </span>
                                <span class="kt-widget__subtitle">
                                {{$employee->joined_date->format('Y-m-d')}}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="kt-widget4 kt-padding-15">
                    <div class="kt-widget4__item">
                    <span class="kt-widget4__icon">
                        <i class="fa fa-plus-circle kt-font-success"></i>
                    </span>
                        <a href="#" class="kt-widget4__title kt-widget4__title--light">
                            {{__('Basic Salary')}}
                        </a>
                        <span class="kt-widget4__number kt-font-success">
                        {{$employee->basic_salary}}
                    </span>
                    </div>
                </div>
                <div class="kt-widget kt-widget--user-profile-3">
                    <div class="kt-widget__bottom">
                        <div class="kt-widget__item">
                            <div class="kt-widget__icon">
                                <i class="flaticon-coins"></i>
                            </div>
                            <div class="kt-widget__details">
                            <span class="kt-widget__title">
                                {{__('Net Salary')}}
                            </span>
                                <span class="kt-widget__value ">
                                {{$employee->salary()}}
                            </span>
                            </div>
                        </div>
                        <div class="kt-widget__item">
                            <div class="kt-widget__icon">
                                <i class="flaticon-coins kt-font-success"></i>
                            </div>
                            <div class="kt-widget__details">
                            <span class="kt-widget__title">
                                {{__('Total Additions')}}
                            </span>
                                <span class="kt-widget__value kt-font-success">
                                {{$employee->additions->pluck('amount')->sum()}}
                            </span>
                            </div>
                        </div>
                        <div class="kt-widget__item">
                            <div class="kt-widget__icon">
                                <i class="flaticon-coins kt-font-danger"></i>
                            </div>
                            <div class="kt-widget__details">
                            <span class="kt-widget__title">
                                {{__('Total Deductions')}}
                            </span>
                                <span class="kt-widget__value kt-font-danger">
                                {{$employee->deductions->pluck('amount')->sum()}}
                            </span>
                            </div>
                        </div>
                        <div class="kt-widget__item">
                            <div class="kt-widget__icon">
                                <i class="flaticon-coins kt-font-brand"></i>
                            </div>
                            <div class="kt-widget__details">
                            <span class="kt-widget__title">
                                {{__('Loans')}}
                            </span>
                                <span class="kt-widget__value kt-font-brand">
                                {{$employee->loans->pluck('amount')->sum()}}
                            </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Begin::Row-->
    <div class="row">
        <div class="col-xl-6">
            <!--begin:: Widgets/New Users-->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Deductions')}}
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
                                        <td style="width:15%">{{__('Reason')}}</td>
                                        <td style="width:15%">{{__('Amount')}}</td>
                                        <td style="width:15%">{{__('Status')}}</td>
                                        <td style="width:15%">{{__('Effective Date')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employee->deductions as $deduction)
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__sub">{{__($deduction->reason)}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub kt-font-danger">{{$deduction->amount}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">
                                                    @if($deduction->status == 1)
                                                        <span class="kt-badge kt-badge--inline kt-badge--success">
                                                       {{__('Approved')}}
                                                    </span>
                                                    @endif
                                                    @if($deduction->status == 2)
                                                        <span class="kt-badge kt-badge--inline kt-badge--danger">
                                                       {{__('Cancelled')}}
                                                    </span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{$deduction->effective_date->format('Y-m')}}</td>
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
        <div class="col-xl-6">
            <!--begin:: Widgets/New Users-->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('Additions')}}
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
                                        <td style="width:15%">{{__('Reason')}}</td>
                                        <td style="width:15%">{{__('Amount')}}</td>
                                        <td style="width:15%">{{__('Status')}}</td>
                                        <td style="width:15%">{{__('Effective Date')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employee->additions as $addition)
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__sub">{{$addition->reason}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub kt-font-success">{{$addition->amount}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">
                                                    @if($addition->status == 1)
                                                        <span class="kt-badge kt-badge--inline kt-badge--success">
                                                       {{__('Approved')}}
                                                    </span>
                                                    @endif
                                                    @if($addition->status == 2)
                                                        <span class="kt-badge kt-badge--inline kt-badge--danger">
                                                       {{__('Cancelled')}}
                                                    </span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{$addition->effective_date->format('Y-m')}}</td>
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
