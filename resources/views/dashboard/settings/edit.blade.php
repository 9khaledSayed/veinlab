@extends('layouts.dashboard')

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
                <a href="{{route('dashboard.index')}}" class="btn btn-secondary">
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
                    {{__('General Settings')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.settings.store')}}">
            @csrf
            <div class="kt-portlet__body">
                @if(session('message'))
                    <div class="kt-portlet__body">
                        <div class="alert alert-success" style="margin: 0" role="alert">
                            <div class="alert-text">{{__('Saved Successfully !')}}</div>
                        </div>
                    </div>
                @endif
                <div class="form-group col-12" >
                    <h3 style="text-align:center">{{__('Language')}}</h3>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Language')}}</label>
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
                <div class="form-group col-12 mt-2" >
                    <h3 style="text-align:center">{{__('Tax')}}</h3>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Tax') . ' ( % )'}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="tax"
                            placeholder="{{__('Enter Tax Price')}}"
                            value="{{old('tax') ?? $setting['tax']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Tax Number')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="tax_no"
                            placeholder="{{__('Enter Tax Number')}}"
                            value="{{old('tax_no') ?? $setting['tax_no']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Include')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control @error('tax_include')is-invalid @enderror kt-selectpicker"
                                name="tax_include">
                            <option value="-1" @if($setting['tax_include'] === -1) selected @endif>{{__('All')}}</option>
                            <option value="0" @if($setting['tax_include'] === 0) selected @endif>{{__('Saudi')}}</option>
                            <option value="1" @if($setting['tax_include'] === 1) selected @endif>{{__('Non-Saudi')}}</option>
                        </select>
                        @error('tax_include')
                        <span class="invalid-feedback">
                                    {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-12 mt-2" >
                    <h3 style="text-align:center">{{__('Home Visit Fees')}}</h3>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Home Visit Fees') . ' ( ' .__('SAR') . ' )'}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="home_visit_fees"
                            value="{{old('home_visit_fees') ?? $setting['home_visit_fees']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group col-12 mt-2" >
                    <h3 style="text-align:center">{{__('Critical fields')}}</h3>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('digits of Identical Number')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="max_id_no"
                            placeholder="{{__('Enter Max Number')}}"
                            value="{{old('max_id_no') ?? $setting['max_id_no']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('digits of phone number')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="max_phone_no"
                            placeholder="{{__('Enter Max Number')}}"
                            value="{{old('max_phone_no') ?? $setting['max_phone_no']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group col-12 mt-2" >
                    <h3 style="text-align:center">{{__('Loyalty Points')}}</h3>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Number Of Visits')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="no_visits"
                            placeholder="{{__('Enter Number Of Visits To Get Discount')}}"
                            value="{{$setting['no_visits']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Discount Value') . ' ( % )'}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="loyalty_discount_value"
                            placeholder="{{__('Enter Discount Value')}}"
                            value="{{$setting['loyalty_discount_value']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Include')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control @error('loyalty_discount_include')is-invalid @enderror kt-selectpicker"
                                name="loyalty_discount_include">
                            <option value="1" @if($setting['loyalty_discount_include'] == 1) selected @endif>{{__('All')}}</option>
                            <option value="2" @if($setting['loyalty_discount_include'] == 2) selected @endif>{{__('Individual Accounts')}}</option>
                            <option value="3" @if($setting['loyalty_discount_include'] == 3) selected @endif>{{__('Contract Accounts')}}</option>
                        </select>
                        @error('loyalty_discount_include')
                        <span class="invalid-feedback">
                                        {{$message}}
                                </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-12 mt-2" >
                    <h3 style="text-align:center">{{__('Invoice Discount')}}</h3>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Invoice Value')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="invoice_value"
                            placeholder="{{__('Enter Invoice Value To Get Discount')}}"
                            value="{{$setting['invoice_value']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Discount Value') . ' ( ' .__('SAR') . ' )'}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            type="number"
                            name="invoice_discount_value"
                            placeholder="{{__('Enter Discount Value')}}"
                            value="{{$setting['invoice_discount_value']}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Include')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control @error('invoice_discount_include')is-invalid @enderror kt-selectpicker"
                                name="invoice_discount_include">
                            <option value="1" @if($setting['invoice_discount_include'] == 1) selected @endif>{{__('All')}}</option>
                            <option value="2" @if($setting['invoice_discount_include'] == 2) selected @endif>{{__('Individual Accounts')}}</option>
                            <option value="3" @if($setting['invoice_discount_include'] == 3) selected @endif>{{__('Contract Accounts')}}</option>
                        </select>
                        @error('invoice_discount_include')
                        <span class="invalid-feedback">
                                        {{$message}}
                                </span>
                        @enderror
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
