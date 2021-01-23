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
                    {{__('General Settings')}}
                </h3>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.hr.settings.hr_store')}}">
            @csrf
            <div class="kt-portlet__body">
                @if(session('message'))
                    <div class="kt-portlet__body">
                        <div class="alert alert-success" style="margin: 0" role="alert">
                            <div class="alert-text">{{__('Saved Successfully !')}}</div>
                        </div>
                    </div>
                @endif
                <div class="form-group col-12 mt-2" >
                    <h4 style="text-align:center">{{__('Language')}}</h4>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12"></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select name="language"
                                required
                                class="form-control kt-selectpicker"
                                value="{{old('language')}}"
                                title="{{__('Choose')}}">
                            <option value="ar" @if($setting['language'] == "ar") selected @endif>{{__('Arabic')}}</option>
                            <option value="en" @if($setting['language'] == "en") selected @endif>{{__('English')}}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-12 mt-3" >
                    <h4 style="text-align:center">{{__('Working Hours')}}</h4>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12"></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="working_hours"
                            value="{{old('working_hours') ?? $setting['working_hours']}}"
                            id="example-text-input">
                    </div>
                </div>

                <div class="form-group col-12 mt-3" >
                    <h4 style="text-align:center">{{__('Late Period')}}</h4>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12"></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="late_period"
                            value="{{old('late_period') ?? $setting['late_period']}}"
                            id="example-text-input">
                    </div>
                </div>

                <div class="form-group col-12 mt-3" >
                    <h4 style="text-align:center">{{__('Number of Days Off')}}</h4>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12"></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="days_off"
                            value="{{old('days_off') ?? $setting['days_off']}}"
                            id="example-text-input">
                    </div>
                </div>

                <div class="form-group col-12 mt-3" >
                    <h4 style="text-align:center">{{__('Salary Release Day')}}</h4>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12"></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            min="1"
                            max="31"
                            name="release_day"
                            value="{{old('release_day') ?? $setting['release_day']}}"
                            id="example-text-input">
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
    </script>
@endpush
