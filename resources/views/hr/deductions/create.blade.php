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
                    {{__('Check-in Online')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->

    <div class="kt-portlet" >
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add" data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.hr.attendance.store')}}" method="post" class="kt-form" style="width: 80%" id="kt_contacts_add_form">
                        @csrf
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <div class="form-group row">
                                                            <div class="col-lg-4" id="doctors">
                                                                <label>{{__('Employee')}} *</label>
                                                                <select class="form-control kt-select2"
                                                                        id="kt_select2_1"
                                                                        name="employee_id">
                                                                    <option></option>
                                                                    @forelse($employees as $employee)
                                                                        <option
                                                                            value="{{$employee->id}}"
                                                                        >{{$employee->fname_arabic . ' ' . $employee->lname_arabic . ' (' . $employee->emp_num . ' )'}}</option>
                                                                    @empty
                                                                        <option disabled>{{__('There is no employees')}}</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Operation')}} *</label>
                                                                <input name="operation_show" style="background-color: #aaaa;" class="form-control" readonly type="text">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label>{{__('Date And Time')}}</label>
                                                                <input name="date_time" class="form-control border-0" style="font-size: 1.2rem;font-weight: 600; " readonly type="text" id="time">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-4" style="visibility: hidden">
                                                                <label>{{__('Operation')}} *</label>
                                                                <input name="operation" style="" class="form-control" readonly type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto" style="display: block" data-ktwizard-type="action-submit">
                                {{__('Submit')}}
                            </div>
                        </div>

                        <!--end: Form Actions -->
                    </form>

                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/pages/attendance.js')}}" type="text/javascript"></script>
    <script>
        $(function (){
            var messages = {
                'ar': {
                    'Check in': "تسجيل حضور",
                    'Check out': "تسجيل انصراف",
                    'Attendance and leave have been recorded': "لقد تمت عملية تسجيل حضورك وانصرافك",
                }
            };
            var locator = new KTLocator(messages);
            let select_employee = $("select[name='employee_id']");
            let operation_show = $("input[name='operation_show']");
            let operation = $("input[name='operation']");
            select_employee.change(function() {
                let id = select_employee.val();
                attendanceStatus(id);
            });
            /*employees*/
            $('#kt_select2_1, #kt_select2_1_validate').select2({
                placeholder: "{{__('Choose')}}",
                allowClear: true
            });

            function attendanceStatus (id){
                if(id != null){
                    $.ajax({
                        method: "get",
                        url: "/dashboard/hr/attendance/check/" + id,
                        success:function(data){
                            operation.val('');
                            operation.val(data.value);
                            operation_show.val(locator.__(data.value));
                        }
                    })
                }
            }
        });
    </script>
@endpush
