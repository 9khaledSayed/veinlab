@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Main Analysis')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.main_analysis.index')}}" class="btn btn-secondary">
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
                    {{__('Main Analysis Info')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('General Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            disabled="disabled"
                            type="text"
                            name="general_name"
                            value="{{$main_analysis->general_name}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Abbreviated Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            disabled="disabled"
                            type="text"
                            name="abbreviated_name"
                            value="{{$main_analysis->abbreviated_name}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            disabled="disabled"
                            name="price"
                            value="{{$main_analysis->price}}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Insurance Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control"
                            disabled="disabled"
                            name="price"
                            value="{{$main_analysis->price_insurance}}"
                            id="example-text-input">
                    </div>
                </div>

                <div class="form-group row">
                    <h2 class="col-lg-12 col-sm-12 col-md-12 mt-3 mb-3" style="text-align:center">{{__('Sub Analysis')}}</h2>
                </div>

                @foreach($main_analysis->sub_analysis as $sub_analysis)

                    <div class="form-group row d-flex justify-content-center">
{{--                        <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12"></label>--}}
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <input
                                class="form-control"
                                disabled="disabled"
                                name="price"
                                placeholder="{{__('Name')}}"
                                value="{{$sub_analysis->name}}"
                                id="example-text-input">
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <input
                                class="form-control"
                                disabled="disabled"
                                name="price"
                                value="{{$sub_analysis->unit}}"
                                placeholder="{{__('Unit')}}"
                                id="example-text-input">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <input
                                class="form-control"
                                disabled="disabled"
                                name="classification"
                                placeholder="{{__('Classification (optional)')}}"
                                value="{{$sub_analysis->classification}}"
                                id="example-text-input">
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-12" style="text-align:center">
                            <a href="{{ route('dashboard.main_analysis.index') }}" class="btn btn-success">{{__('Back')}}</a>
                            <a href="{{route('dashboard.main_analysis.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>

    <!--end::Portlet-->
@endsection
