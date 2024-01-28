@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Decisions')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.decisions.terminated_employees')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>


    <div class="kt-portlet kt-portlet--responsive-mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fa fa-ban kt-font-brand"></i>
                    </span>
                <h3 class="kt-portlet__head-title kt-font-brand">
                    {{__('End of service for employee')}}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">

            </div>
        </div>
        <form method="post"  action="{{route('dashboard.hr.decisions.end_service_reward')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="row text-center m-3">
                    <div class="col-lg-4">
                        <label for="kt_select2">{{__('Employee Name / ID')}} *</label>
                        <select class="form-control kt-select2"
                                id="kt_select2"
                                name="employee_id">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="kt_select2_1">{{__('Termination reason')}} *</label>
                        <select class="form-control kt-select2"
                                id="kt_select2_1"
                                name="termination_reason">
                            <option></option>
                            @foreach($reasons as $key => $reason)
                                <option value="{{$key}}">{{__($reason)}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="termination_date">{{__('Termination Date')}} *</label>
                        <div class="input-group date">
                            <input name="termination_date" type="text" class="form-control datepic" readonly/>
                            <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div id="info-div" class="col-lg-12  mt-5" style="display: none">
                        <div class="kt-section kt-section--first">
                            <h3 class="kt-section__title">1. {{__('Employee Information')}}</h3>
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Employee.EmployeeNumber">
                                            <strong>{{__('Employee Number')}}</strong>
                                        </label>
                                        <p class="emp_num"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Employee.FullName">
                                            <strong>{{__('Employee Name')}}</strong>
                                        </label>
                                        <p class="emp_name"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Employee.JoinedDate">
                                            <strong>{{__('Joined Date')}}</strong>
                                        </label>
                                        <p class="emp_joined_date"></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="kt-separator kt-separator--space-lg kt-separator--portlet-fit"></div>

                        <div class="kt-section">
                            <h3 class="kt-section__title">2. {{__('Years Of Service')}}</h3>
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="YearsOfExperience">
                                            <strong>{{__('Years')}}</strong>
                                        </label>
                                        <p class="years"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Months">
                                            <strong>{{__('Months')}}</strong>
                                        </label>
                                        <p class="months"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Days">
                                            <strong>{{__('Days')}}</strong>
                                        </label>
                                        <p class="days"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-separator  kt-separator--space-lg kt-separator--portlet-fit"></div>
                        <div class="kt-section">
                            <h3 class="kt-section__title">3. {{__('Entitlements')}}</h3>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="form-group m-form__group row bg-light kt-margin-0">
                                        <label class="col-lg-5 col-form-label">
                                            {{__('End of service reward')}}
                                        </label>
                                        <div class="col-lg-6">
                                            <p class="form-control-plaintext service_reward">

                                            </p>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row kt-margin-0">
                                        <label class="col-lg-5 col-form-label">
                                            {{__('Leave days')}}
                                        </label>
                                        <div class="col-lg-6">
                                            <p class="form-control-plaintext leave_days">

                                            </p>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row bg-light kt-margin-0">
                                        <label class="col-lg-5 col-form-label">
                                            {{__('Entitlements')}}
                                        </label>
                                        <div class="col-lg-6">
                                            <p class="form-control-plaintext entitlements">

                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row kt-margin-0">
                                        <label class="col-lg-5 col-form-label">
                                            {{__('Obligations')}}
                                        </label>
                                        <div class="col-lg-6">
                                            <p class="form-control-plaintext obligations">

                                            </p>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row bg-light kt-margin-0">
                                        <label class="col-lg-5 col-form-label kt-font-bold">
                                            {{__('Total')}}
                                        </label>
                                        <div class="col-lg-6">
                                            <p class="form-control-plaintext kt-font-bold total" >

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <label>
                            {{__('Notes')}}
                        </label>
                        <textarea rows="5" class="form-control" id="Note" name="notes"></textarea>
                        <span class="field-validation-valid" data-valmsg-for="Note" data-valmsg-replace="true"></span>
                    </div>
                </div>


            </div>
            <div class="kt-portlet__foot">
                <button type="submit" class="btn btn-brand m-btn m-btn--custom btn-sm">
                        <span>
                            <i class="fa fa-plus"></i>
                            <span>
                                {{__('Submit')}}
                            </span>
                        </span>

                </button>
                <button type="submit" class="btn btn-secondary btn-sm">
                        <span>
                            <i class="fa fa-ban"></i>
                            <span>
                                {{__('Cancel')}}
                            </span>
                        </span>
                </button>

            </div>
            <input name="__RequestVerificationToken" type="hidden" value="CfDJ8Lkant4RhGNDlI1PRl3B8F84kgJsz2GUgb6S964VeInr9XI4ptLkv09xCaRxO8hRjwAeXnZnqyzhq38B61Txxo7ShM_tC5kErmpwJxkdjwtYsIQncfbOZ7Q_mQY02FWFVrK-Sf_2jz6QuysuJCJ12R2nT0ZxG1hZ2rSF78kB5NYG8eTu5j9sd4oaUFKSnJlsnw"></form>
    </div>
@endsection

@push('scripts')
    <script>
        $(function (){
            let employee_id = $("select[name='employee_id']");
            let termination_date = $("input[name='termination_date']");
            let termination_reason = $("select[name='termination_reason']");
            var arrows;
            if (KTUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            } else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }

            $('.datepic').datepicker({
                rtl: KTUtil.isRTL(),
                language: 'ar',
                todayBtn: "linked",
                format: 'yyyy-mm-dd',
                clearBtn: true,
                todayHighlight: true,
                templates: arrows
            });

            // CSRF Token
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            function locationResultTemplater(location) {
                return location.fname_arabic + " " + location.lname_arabic;
            }

            $( "#kt_select2" ).select2({
                placeholder: "{{__('Choose')}}",
                allowClear: true,
                ajax: {
                    url: "/dashboard/hr/employees",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                },
                templateResult: locationResultTemplater,
                templateSelection: function(item) { return item.fname_arabic || item.text; }
            });
            $("#kt_select2_1").select2({
                placeholder: "{{__('Choose')}}",
                placeholder: "{{__('Choose')}}",
                allowClear: true,
            });

            $("select[name='termination_reason'], select[name='employee_id']").on('change', function(){
                end_service_reward();
            });
            $("input[name='termination_date']").change(function (){

                end_service_reward();
            })
            function end_service_reward(){
                if(termination_date.val() !== '' && employee_id.val() !== '' && termination_reason.val() !== ''){
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        method: "post",
                        url: "/dashboard/hr/decisions/end_service_reward?termination_reason=" + termination_reason.val() + "&employee_id=" + employee_id.val() + "&termination_date=" + termination_date.val(),
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success:function(data){

                                $(".emp_num").text(data.emp_num);
                                $(".emp_name").text(data.emp_name);
                                $(".emp_joined_date").text(data.emp_joined_date);
                                $(".years").text(data.years);
                                $(".months").text(data.months);
                                $(".days").text(data.days);
                                $(".service_reward").text(data.service_reward.toFixed(2) + ' {{__('SAR')}}');
                                $(".leave_days").text(data.leave_days);
                                $(".entitlements").text(data.entitlements.toFixed(2) + ' {{__('SAR')}}');
                                $(".obligations").text(data.obligations.toFixed(2) + ' {{__('SAR')}}');
                                $(".total").text(data.total.toFixed(2) + ' {{__('SAR')}}');
                                $("#info-div").fadeIn(2);
                        }
                    });
                }

            }

        });
    </script>
@endpush
