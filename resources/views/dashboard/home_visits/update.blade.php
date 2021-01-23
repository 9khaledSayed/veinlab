@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Home Visits')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.home_visits.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{__('Update Request Info')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="post" action="{{route('dashboard.home_visits.update',$homeVisit)}}">
            @method('PUT')
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control  @error('name') is-invalid @enderror"
                               type="text"
                               value="{{ old('name') ?? $homeVisit->name }}"
                               id="example-text-input"
                               name="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Address')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control  @error('address') is-invalid @enderror"
                               type="text"
                               value="{{ old('address') ?? $homeVisit->address }}"
                               id="example-text-input"
                               name="address">
                        @error('address')
                        <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Phone')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control  @error('phone') is-invalid @enderror"
                               type="text"
                               value="{{ old('phone') ?? $homeVisit->phone }}"
                               id="example-text-input"
                               name="phone">
                        @error('phone')
                        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Email')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control  @error('email') is-invalid @enderror"
                               type="text"
                               value="{{ old('email') ?? $homeVisit->email }}"
                               id="example-text-input"
                               name="email">
                        @error('email')
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Gender')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select name="sex"
                                required
                                class="form-control @error('sex')is-invalid @enderror kt-selectpicker"
                                value="{{old('sex')}}"
                                title="{{__('Choose')}}">
                            <option value="0" @if((old('sex') ?? $homeVisit->sex) == "0") selected @endif>{{__('Male')}}</option>
                            <option value="1" @if((old('sex') ?? $homeVisit->sex) == "1") selected @endif>{{__('Female')}}</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-datetime-local-input" class="col-form-label col-lg-3 col-sm-12">{{__('Date and time')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <div class="input-group date">
                            <input name="dateTime" type="text" class="form-control @error('dateTime') is-invalid @enderror datepicker" value="{{ old('dateTime') ?? $homeVisit->dateTime}}" readonly/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                        </div>
                        @error('dateTime')
                        <div class="invalid-feedback">{{ $errors->first('dateTime') }}</div>
                        @enderror

                    </div>

                </div>

            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.home_visits.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')
    <script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script>
        $(function() {
            $('.datepicker').datetimepicker({
                todayHighlight: true,
                autoclose: true,
                pickerPosition: 'top-right',
                format: 'yyyy/mm/dd hh:ii'
            });
        });
    </script>
@endpush
