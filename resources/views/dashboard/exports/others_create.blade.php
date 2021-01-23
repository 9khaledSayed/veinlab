@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Exports')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.exports.index')}}" class="btn btn-secondary">
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
                    {{__('Payment Voucher')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="/dashboard/exports?type=others" method="post">
            @method('POST')
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Amount')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control  @error('amount') is-invalid @enderror"
                            type="text"
                            value="{{ old('amount') }}"
                            id="example-text-input"
                            name="amount">
                        @error('amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Check no')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control  @error('CheckNo') is-invalid @enderror"
                            type="text"
                            value="{{ old('CheckNo') }}"
                            id="example-text-input"
                            name="CheckNo">
                        @error('CheckNo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('This About')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control  @error('thisAbout') is-invalid @enderror"
                            type="text"
                            value="{{ old('thisAbout') }}"
                            id="example-text-input"
                            name="thisAbout">
                        @error('thisAbout')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-datetime-local-input" class="col-form-label col-lg-3 col-sm-12">{{__('Check Date')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <div class="input-group date">
                            <input name="checkDate" type="text" class="form-control @error('checkDate') is-invalid @enderror datepicker" readonly/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>
                        </div>
                        @error('checkDate')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Bank')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control  @error('bank') is-invalid @enderror"
                            type="text"
                            value="{{ old('bank') }}"
                            id="example-text-input"
                            name="bank">
                        @error('bank')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Reason')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <textarea
                            class="form-control  @error('reason') is-invalid @enderror"
                            name="reason"
                            rows="3">{{ old('reason') }}</textarea>
                        @error('reason')
                        <div class="invalid-feedback">
                            {{ $errors->message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                <a href="{{route('dashboard.exports.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')
    <script>
        $(function() {
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
            $('.datepicker').datepicker({
                rtl: KTUtil.isRTL(),
                todayBtn: "linked",
                format:'yyyy-mm-dd',
                clearBtn: true,

                todayHighlight: true,
                templates: arrows
            });
        });
    </script>

@endpush
