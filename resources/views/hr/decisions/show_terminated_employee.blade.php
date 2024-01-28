@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        {{__('Details')}}
                    </h3>
                </div>
                <div class="kt-subheader__toolbar">
                    <a href="{{route('dashboard.hr.decisions.terminated_employees')}}" class="btn btn-secondary">
                        {{__('Back')}}
                    </a>
                </div>
            </div>
        </div>

        <!-- end:: Content Head -->
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--responsive-mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fa fa-ban kt-font-brand"></i>
                    </span>
                    <h3 class="kt-portlet__head-title kt-font-brand">
                        {{__('Terminated Employee')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">

                    <div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{__('Print')}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <a class="dropdown-item" target="_blank" href="{{route('dashboard.hr.decisions.service_settlement', $decision->id)}}">
                                {{__('End of Service Settlement')}}
                            </a>
                            <a class="dropdown-item" target="_blank" href="{{route('dashboard.hr.decisions.service_certificate', $decision->id)}}">
                                {{__('Service Certificate')}}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="kt-portlet__body text-center">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">{{__('Employee Information')}}</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__pic">
                                        <div class="kt-badge kt-badge--xl kt-badge--brand">{{substr($decision->employee->fname_arabic, 0, 2)}}</div>
                                    </div>
                                    <div class="kt-user-card-v2__details">
                                        <a href="#" class="kt-user-card-v2__name">{{$decision->employee->fname_arabic . ' ' . $decision->employee->lname_arabic}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="EmployeeNumber"><strong>{{__('Employee Number')}}</strong></label>
                                <p>
                                {{$decision->employee->emp_num}}
                                </p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="JoinedDate"><strong>{{__('Joined Date')}}</strong></label>
                                <p>{{$decision->employee->joined_date->format('Y-m-d')}}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="kt-separator  kt-separator--space-lg kt-separator--portlet-fit"></div>
                <div class="kt-section">
                    <h3 class="kt-section__title">{{__('Termination Info')}}</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label for="Termination.Date"><strong>{{__('Termination Date')}}</strong></label><p>{{$decision->termination_date}}</p></div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="Termination.TerminationReason.Name"><strong>{{__('Termination Reason')}}</strong></label><p>{{__($decision->termination_reason)}}</p></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label for="Termination.LeaveDays"><strong>{{__('Leave Days')}}</strong></label><p>???</p></div>

                        </div>
                    </div>
                </div>


                <div class="kt-separator  kt-separator--space-lg kt-separator--portlet-fit"></div>
                <div class="kt-section ">
                    <h3 class="kt-section__title">{{__('Entitlements')}}</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-form__group row bg-light kt-margin-0">
                                <label class="col-lg-5 col-form-label">
                                    {{__('End of service reward')}}
                                </label>
                                <div class="col-lg-6">
                                    <p class="form-control-plaintext">
                                        {{$decision->end_of_service . ' ' .  __('SAR')}}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group m-form__group row kt-margin-0">
                                <label class="col-lg-5 col-form-label">
                                    {{__('Leave days')}}
                                </label>
                                <div class="col-lg-6">
                                    <p class="form-control-plaintext">
                                        {{$decision->employee->leave_balances->pluck('no_days_carried')->sum()}}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group m-form__group row bg-light kt-margin-0">
                                <label class="col-lg-5 col-form-label">
                                    {{__('Entitlements')}}
                                </label>
                                <div class="col-lg-6">
                                    <p class="form-control-plaintext">
                                        {{$decision->entitlements . ' ' . __('SAR')}}
                                    </p>
                                </div>
                            </div>
                            <div class="form-group m-form__group row kt-margin-0">
                                <label class="col-lg-5 col-form-label">
                                    {{__('Obligations')}}
                                </label>
                                <div class="col-lg-6">
                                    <p class="form-control-plaintext">
                                        {{$decision->obligations . ' ' . __('SAR')}}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group m-form__group row bg-light kt-margin-0">
                                <label class="col-lg-5 col-form-label kt-font-bold">
                                    {{__('Total')}}
                                </label>
                                <div class="col-lg-6">
                                    <p class="form-control-plaintext kt-font-bold">
                                        {{($decision->entitlements + $decision->end_of_service - $decision->obligations) .' ' .  __('SAR')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="form-group">
                    <bootstrap-display-form-group for="Termination.Note">
                        {{$decision->termination_notes}}
                    </bootstrap-display-form-group>
                </div>
            </div>

        </div>
        <!--end::Portlet-->
    <!-- end:: Content -->


@endsection

@push('scripts')
    <script src="{{asset('js/datatables/hr/terminated_employees.js')}}" type="text/javascript"></script>
@endpush
