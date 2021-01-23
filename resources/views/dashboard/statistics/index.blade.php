@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Statistics')}}
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
    <div class="kt-portlet" style="margin-top: 20px;">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('All Statistics')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-lg border-bottom">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="{{route('dashboard.exports.create')}}">
                            <span class="kt-widget24__stats kt-label-font-color-5">
                                <i class="fa fa-user-injured" style="font-size: 4rem"></i>
                            </span>
                                    <h4 class="kt-widget24__title">
                                        {{__('Patients')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$patients_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info" style="text-align:center">
                           <span class="kt-widget24__stats" style="color:#f6f243">
                                <i class="fa fa-male" style="font-size: 4rem"></i>
                            </span>
                                    <h4 class="kt-widget24__title">
                                        {{__('Male')}}
                                    </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$male_patients_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info" style="text-align:center">
                                <a href="/dashboard/doctors">
                           <span class="kt-widget24__stats" style="color:#ff6efb">
                                <i class="fa fa-female" style="font-size: 4rem"></i>
                            </span>
                                    <h4 class="kt-widget24__title">
                                        {{__('Female')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$female_patients_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info" style="display:inline">
                                <a href="/dashboard/hospitals">
                              <span class="kt-widget24__stats kt-label-font-color-3" >
                                <i class="fa fa-child" style="font-size: 4rem"></i>
                              </span>
                                </a>
                                <h4 class="kt-widget24__title" >
                                    {{__('Child')}}
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$child_patients_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

            </div>


            <div class="row row-no-padding row-col-separator-lg border-bottom">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="/dashboard/home_visits">
                           <span class="kt-widget24__stats kt-label-font-color-5">
                                <i class="fa fa-home" style="font-size: 4rem"></i>
                            </span>
                                    <h4 class="kt-widget24__title">
                                        {{__('Home Visits')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$home_visits_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info" style="text-align:center">
                           <span class="kt-widget24__stats" style="color:#f6f243">
                                <i class="fa fa-male" style="font-size: 4rem"></i>
                            </span>
                                <h4 class="kt-widget24__title">
                                    {{__('Male')}}
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$male_home_visits_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info" style="text-align:center">
                                <a href="/dashboard/doctors">
                           <span class="kt-widget24__stats" style="color:#ff6efb">
                                <i class="fa fa-female" style="font-size: 4rem"></i>
                            </span>
                                    <h4 class="kt-widget24__title">
                                        {{__('Female')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$female_home_visits_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info" >
                                <a href="/dashboard/hospitals">
                           <span class="kt-widget24__stats kt-label-font-color-3">
                                <i class="fa fa-child" style="font-size: 4rem"></i>
                            </span>
                                    <h4 class="kt-widget24__title">
                                        {{__('Child')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$child_home_visits_no}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

            </div>

        <div class="row row-no-padding row-col-separator-lg border-bottom">
            <div class="col-md-12 col-lg-6 col-xl-4">

                <!--begin::New Feedbacks-->

                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info" style="text-align:center">
                            <a href="/dashboard/hospitals">
                           <span class="kt-widget24__stats" style="color:#0ccb07">
                                <i class="fa fa-building" style="font-size: 4rem"></i>
                            </span>
                                <h4 class="kt-widget24__title">
                                    {{__('Companies')}}
                                </h4>
                            </a>
                        </div>
                        <span class="kt-widget24__stats kt-font-warning">
                                {{$companies}}
                            </span>
                    </div>
                </div>

                <!--end::New Feedbacks-->
            </div>

            <div class="col-md-12 col-lg-6 col-xl-4">

                <!--begin::New Feedbacks-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <a href="/dashboard/doctors">
                           <span class="kt-widget24__stats" style="color:#db0000">
                                <i class="fa fa-hospital" style="font-size: 4rem"></i>
                            </span>
                                <h4 class="kt-widget24__title">
                                    {{__('Doctors')}}
                                </h4>
                            </a>
                        </div>
                        <span class="kt-widget24__stats kt-font-warning">
                                {{$doctors}}
                            </span>
                    </div>
                </div>

                <!--end::New Feedbacks-->
            </div>

            <div class="col-md-12 col-lg-6 col-xl-4">

                <!--begin::New Feedbacks-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <a href="/dashboard/hospitals">
                           <span class="kt-widget24__stats" style="color:#0f3bc1">
                                <i class="fa fa-hospital" style="font-size: 4rem"></i>
                            </span>
                                <h4 class="kt-widget24__title">
                                    {{__('Hospitals')}}
                                </h4>
                            </a>
                        </div>
                        <span class="kt-widget24__stats kt-font-warning">
                                {{$hospitals}}
                            </span>
                    </div>
                </div>

                <!--end::New Feedbacks-->
            </div>

        </div>

            <div class="row row-no-padding row-col-separator-lg border-bottom">
                <div class="col-md-12 col-lg-6 col-xl-4">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__stats" style="color:#0ccb07">
                                    <i class="fa fa-file-import" style="font-size: 4rem"></i>
                                </span>
                                <h4 class="kt-widget24__title">
                                    {{__('Revenue')}}
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$sumRevenue}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                               <span class="kt-widget24__stats" style="color:#db0000">
                                    <i class="fa fa-file-export" style="font-size: 4rem"></i>
                                </span>
                                <h4 class="kt-widget24__title">
                                    {{__('Exports')}}
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$sumExports}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="/dashboard/hospitals">
                           <span class="kt-widget24__stats" style="color:#0f3bc1">
                                <i class="fa fa-dollar-sign" style="font-size: 4rem"></i>
                            </span>
                                    <h4 class="kt-widget24__title">
                                        {{__('Profit')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                {{$profit}}
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>

            </div>

    </div>
@endsection
