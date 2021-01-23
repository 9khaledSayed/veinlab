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
                                <h4 class="kt-widget24__title">
                                    {{__('Today Waiting Lab')}}
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-brand">
                                {{$waiting_no}}
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
                                <a href="/dashboard/results">
                                    <h4 class="kt-widget24__title">
                                        {{__('Results')}}
                                    </h4>
                                </a>
                                <span class="kt-widget24__desc">
                                    {{__('Results Review')}}
                                </span>
                            </div>
                            <span class="kt-widget24__stats kt-font-primary">
                                <i class="fa fa-clipboard-check" style="font-size: 4rem"></i>
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
                                <a href="/dashboard/main_analysis">
                                    <h4 class="kt-widget24__title">
                                        {{__('Main Analysis')}}
                                    </h4>
                                </a>
                                <span class="kt-widget24__desc">
                                    {{__('All main analysis')}}
                                </span>
                            </div>
                            <span class="kt-widget24__stats kt-font-brand">
                                <i class="fas fa-box" style="font-size: 4rem"></i>
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
                                <a href="/dashboard/sub_analysis">
                                    <h4 class="kt-widget24__title">
                                        {{__('Sub Analysis')}}
                                    </h4>
                                </a>
                                <span class="kt-widget24__desc">
                                    {{__('All sub analysis')}}
                                </span>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">
                                <i class="fas fa-archive" style="font-size: 4rem"></i>
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
                            {{__('New Patients')}}
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
                                        <td style="width:15%">{{__('Name')}}</td>
                                        <td style="width:15%">{{__('Phone')}}</td>
                                        <td style="width:15%">{{__('National ID')}}</td>
                                        <td style="width:15%">{{__('Gender')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latest_patients as $patient)
                                        <tr>
                                            <td>
                                                <span class="kt-widget11__sub">{{$patient->id}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{$patient->name}}</span>
                                            </td>
                                            <td>
                                                <span class="kt-widget11__sub">{{$patient->phone}}</span>
                                            </td>
                                            <td>{{$patient->id_no}}</td>
                                            <td>
                                                @if($patient->gender == 0)
                                                    <span class="kt-badge kt-badge--inline kt-badge--brand">
                                                   {{__('Male')}}
                                                </span>
                                                @endif
                                                @if($patient->gender == 1)
                                                    <span class="kt-badge kt-badge--inline kt-badge--primary">
                                                   {{__('Female')}}
                                                </span>
                                                @endif
                                                @if($patient->gender == 2)
                                                    <span class="kt-badge kt-badge--inline kt-badge--success">
                                                   {{__('Child')}}
                                                </span>
                                                @endif
                                            </td>
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
