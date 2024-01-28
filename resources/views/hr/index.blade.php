@extends('layouts.hr')
@section('content')
    @if ( auth()->user()->roles->pluck('name_english')->contains('Super Admin') )
    <div class="kt-portlet">
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-lg border-bottom">
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <a href="/dashboard/hr/requests/pending">
                    <!--begin::Total Profit-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        {{__('Pending requests')}}
                                    </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-brand">
                                <i class="kt-menu__link-icon flaticon2-layers"></i>
                            </span>
                        </div>
                    </div>
                    </a>
                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <a href="/dashboard/hr/vacations/balances">
                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        {{__('vacations Balances')}}
                                    </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">
                                <i class="kt-menu__link-icon fas fa-umbrella"></i>
                            </span>
                        </div>
                    </div>
                    </a>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <a href="{{route('dashboard.hr.salary_reports.index')}}">
                    <!--begin::New Orders-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        {{__('All Salaries')}}
                                    </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">
                                <i class="kt-menu__link-icon fas fa-comment-dollar"></i>
                            </span>
                        </div>
                    </div>
                    <!--end::New Orders-->
                    </a>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <a href="{{route('dashboard.hr.attendance.index')}}">
                    <!--begin::New Users-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        {{__('Attendance Sheet')}}
                                    </h4>

                            </div>
                            <span class="kt-widget24__stats kt-font-dark">
                                <i class="kt-menu__link-icon flaticon-event-calendar-symbol"></i>
                            </span>
                        </div>
                    </div>
                    <!--end::New Users-->
                    </a>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <a href="{{route('dashboard.hr.memos.create')}}">

                    <!--begin::New Users-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        {{__('Create Memos')}}
                                    </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-danger">
                                 <i class="kt-menu__link-icon fas fa-microphone"></i>
                            </span>
                        </div>
                    </div>
                    <!--end::New Users-->
                    </a>

                </div>
                <div class="col-md-12 col-lg-6 col-xl-2">
                    <a href="{{route('dashboard.hr.decisions.all_decisions')}}">
                    <!--begin::New Users-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">

                                    <h4 class="kt-widget24__title">
                                        {{__('All Decisions')}}
                                    </h4>

                            </div>
                            <span class="kt-widget24__stats kt-font-primary">
                                <i class="kt-menu__link-icon flaticon2-poll-symbol"></i>
                            </span>
                        </div>
                    </div>
                    </a>
                    <!--end::New Users-->
                </div>
            </div>



        </div>
    </div>
    <div class="col-xl-12">

        <!--begin:: Widgets/New Users-->
        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        <a href="{{route('dashboard.hr.employees.index')}}">{{__('Employees')}}</a>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_widget4_tab1_content">
                        @php
                            $employees = App\Employee::latest()->get();
                        @endphp
                        @foreach( $employees as $employee )
                            <div class="kt-widget4">
                                <div class="kt-widget4__item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <img src="{{asset('assets/media/users/default.jpg')}}" alt="">
                                    </div>
                                    <div class="kt-widget4__info">
                                        <a href="{{route('dashboard.hr.employees.show', $employee)}}" class="kt-widget4__username">
                                            {{$employee->fname_arabic . ' ' . $employee->mname_arabic . ' ' . $employee->lname_arabic}}
                                        </a>
                                        {{--                                            <p class="kt-widget4__text">--}}
                                        {{--                                                {{$employee->fname_arabic}}--}}
                                        {{--                                            </p>--}}
                                    </div>
                                    <a href="{{route('dashboard.hr.employees.show', $employee)}}" class="btn btn-sm btn-label-brand btn-bold">{{__('Show')}}</a>
                                </div>

                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end:: Widgets/New Users-->
    </div>

    @else


        <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-lg border-bottom">
                    <div class="col-md-12 col-lg-6 col-xl-2">
                        <a href="/dashboard/hr/requests/mine">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            {{__('My requests')}}
                                        </h4>
                                    </div>
                                    <span class="kt-widget24__stats kt-font-brand">
                                <i class="kt-menu__link-icon flaticon2-layers"></i>
                            </span>
                                </div>
                            </div>
                        </a>
                        <!--end::Total Profit-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-2">
                        <a href="/dashboard/hr/vacations/mine">
                            <!--begin::New Feedbacks-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            {{__('My vacations')}}
                                        </h4>
                                    </div>
                                    <span class="kt-widget24__stats kt-font-warning">
                                <i class="kt-menu__link-icon fas fa-umbrella"></i>
                            </span>
                                </div>
                            </div>
                        </a>

                        <!--end::New Feedbacks-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-2">
                        <a href="{{route('dashboard.hr.salaries.index')}}">
                            <!--begin::New Orders-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            {{__('My Salaries')}}
                                        </h4>
                                    </div>
                                    <span class="kt-widget24__stats kt-font-success">
                                <i class="kt-menu__link-icon fas fa-comment-dollar"></i>
                            </span>
                                </div>
                            </div>
                            <!--end::New Orders-->
                        </a>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-2">
                        <a href="{{route('dashboard.hr.attendance.my_attendance')}}">
                            <!--begin::New Users-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            {{__('My Attendance')}}
                                        </h4>

                                    </div>
                                    <span class="kt-widget24__stats kt-font-dark">
                                <i class="kt-menu__link-icon flaticon-event-calendar-symbol"></i>
                            </span>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </a>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-2">
                        <a href="{{route('dashboard.hr.memos.mine')}}">

                            <!--begin::New Users-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            {{__('My Memos')}}
                                        </h4>
                                    </div>
                                    <span class="kt-widget24__stats kt-font-danger">
                                 <i class="kt-menu__link-icon fas fa-microphone"></i>
                            </span>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </a>

                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-2">
                        <a href="{{route('dashboard.index')}}">
                            <!--begin::New Users-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">

                                        <h4 class="kt-widget24__title">
                                            {{__('Laboratory')}}
                                        </h4>

                                    </div>
                                    <span class="kt-widget24__stats kt-font-primary">
                                <i class="kt-menu__link-icon flaticon2-hospital"></i>
                            </span>
                                </div>
                            </div>
                        </a>
                        <!--end::New Users-->
                    </div>
                </div>

            </div>
        </div>

@endif

@endsection
