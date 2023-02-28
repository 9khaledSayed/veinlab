@extends('layouts.hr')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Settings')}}
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
    <!--begin::Portlet-->
    <div class="kt-portlet mt-5">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Shifts')}}
                </h3>
            </div>
        </div>


        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.hr.settings.shifts')}}">
            @csrf
            <div class="kt-portlet__body">
                @if(session('message'))
                    <div class="kt-portlet__body">
                        <div class="alert alert-success" style="margin: 0" role="alert">
                            <div class="alert-text">{{__('Saved Successfully !')}}</div>
                        </div>
                    </div>
                @endif
                <div class="form-group col-12 mt-3" >
                    <h4 style="text-align:center">{{__('Morning Shift')}}</h4>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-4 col-sm-12">{{__("from")}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <input class="form-control timepicker"
                               readonly=""
                               name="morning_shift_start"
                               placeholder="Select time"
                               type="text"
                               value="{{old('morning_shift_start') ?? $setting['morning_shift_start']}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-4 col-sm-12">{{__("to")}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <input class="form-control timepicker"
                               readonly=""
                               name="morning_shift_end"
                               placeholder="Select time"
                               type="text"
                               value="{{old('morning_shift_end') ?? $setting['morning_shift_end']}}">
                    </div>
                </div>

                <div class="form-group col-12 mt-3" >
                    <h4 style="text-align:center">{{__('Evening Shift')}}</h4>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-4 col-sm-12">{{__("from")}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <input class="form-control timepicker"
                               readonly=""
                               name="evening_shift_start"
                               placeholder="Select time"
                               type="text"
                               value="{{old('evening_shift_start') ?? $setting['evening_shift_start']}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-4 col-sm-12">{{__("to")}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <input class="form-control timepicker"
                               readonly=""
                               name="evening_shift_end"
                               placeholder="Select time"
                               type="text"
                               value="{{old('evening_shift_end') ?? $setting['evening_shift_end']}}">
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                            <a href="{{route('dashboard.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--end::Form-->


    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')
    <script>
        $('.kt-selectpicker').selectpicker();

        $('.timepicker').timepicker();
    </script>
@endpush
