@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Promo Codes')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.promo_codes.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{__('New Promo Code')}}
                        </h3>
                    </div>
                </div>
            @if(session('message'))
                <div class="kt-portlet__body">
                    <div class="alert alert-success" style="margin: 0" role="alert">
                        <div class="alert-text">{{__('The Notifications Has Been Sent !')}}</div>
                    </div>
                </div>
            @endif
                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" action="{{route('dashboard.promo_codes.store')}}" method="post">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-9 col-sm-12 text-center mx-auto">
                                <div class="form-group">
                                    <label>{{__('Promo Code On')}}</label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio">
                                            <input type="radio" name="type" value="{{config('enums.promoCodeOn.invoice')}}" checked @if(old('type')==config('enums.promoCodeOn.invoice')) checked @endif  > {{__('Invoice')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" name="type" value="{{config('enums.promoCodeOn.analysis')}}"  @if(old('type')==config('enums.promoCodeOn.analysis')) checked @endif> {{__('Custom Analysis')}}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Code')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input
                                    class="form-control @error('code') is-invalid @enderror"
                                    type="text"
                                    name="code"
                                    placeholder="{{__('Code')}}"
                                    value="{{old('code')}}"
                                    id="example-text-input">
                                @error('code')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="analysis">
                            <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Analysis')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control @error('main_analysis_id')is-invalid @enderror kt-select2"
                                        id="kt_select2_6"
                                        name="main_analysis_id">
                                    <option selected></option>
                                    @forelse($main_analysis as $analysis)
                                        <option
                                            value="{{$analysis->id}}"
                                            @if($analysis->id == old('main_analysis_id')) selected @endif
                                        >{{$analysis->price . ' ' . 'SAR'}} - {{$analysis->general_name}}</option>
                                    @empty
                                        <option disabled>{{__('There is no Analysis')}}</option>
                                    @endforelse
                                </select>
                                @error('main_analysis_id')
                                <span class="invalid-feedback">
                                        {{$message}}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Percentage')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input
                                    class="form-control @error('percentage') is-invalid @enderror"
                                    type="number"
                                    max="100"
                                    name="percentage"
                                    placeholder="{{__('Percentage')}} %"
                                    value="{{old('percentage')}}"
                                    id="example-text-input">
                                @error('percentage')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">{{__('Range')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class='input-group' id='kt_daterangepicker_2'>
                                    <input type="text"
                                           name="ranges"
                                           class="form-control @error('ranges') is-invalid @enderror"
                                           readonly
                                           value="{{old('ranges')}}"
                                           placeholder="{{__('Select date ranges')}}" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                    </div>
                                    @error('ranges')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" id="analysis">
                            <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Include')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control @error('include')is-invalid @enderror kt-select2"
                                        id="kt_select2_7"
                                        name="include">
                                    <option selected></option>
                                    <option value="{{config('enums.transfer.all')}}">{{__('All')}}</option>
                                    <option value="{{config('enums.transfer.individual')}}" selected>{{__('Individual Accounts')}}</option>
                                    <option value="{{config('enums.transfer.contract')}}">{{__('Contract Accounts')}}</option>
                                </select>
                                @error('include')
                                <span class="invalid-feedback">
                                        {{$message}}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="analysis">
                            <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Notification Type')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control @error('notify')is-invalid @enderror kt-select2"
                                        id="kt_select2_8"
                                        name="notify[]"
                                        multiple="multiple">
                                    @foreach ($channels as $key => $value)
                                        <option value="{{$value}}" {{ (collect(old('notify'))->contains($key)) ? 'selected':'' }}>{{ __($key) }}</option>
                                    @endforeach
{{--                                    <option value="database">{{__('Notifications')}}</option>--}}
{{--                                    <option value="mail">{{__('Emails')}}</option>--}}
{{--                                    <option value="3">{{__('SMS')}}</option>--}}
{{--                                    <option value="4">{{__('Whatsapp')}}</option>--}}
                                </select>
                                @error('notify')
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
                                    <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                    <a href="{{route('dashboard.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>

            <!--end::Portlet-->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Initialization
        $(function() {
            var select_analysis= $("#kt_select2_6");
            var radio= $("input[name='type']");
            /*main_analysis*/
            $('#kt_select2_6, #kt_select2_6_validate').select2({
                placeholder: "{{__('Choose Analysis')}}",
            });
            /*main_analysis*/
            $('#kt_select2_7, #kt_select2_7_validate').select2({
                placeholder: "{{__('Choose Receiver')}}",
            });
            /*main_analysis*/
            $('#kt_select2_8, #kt_select2_8_validate').select2({
                placeholder: "{{__('Choose')}}",
            });

            // input group and left alignment setup
            $('#kt_daterangepicker_2').daterangepicker({
                buttonClasses: ' btn',
                applyClass: 'btn-primary',
                cancelClass: 'btn-secondary'
            }, function(start, end, label) {
                $('#kt_daterangepicker_2 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
            });
            if (select_analysis.val() === ''){   // for validation
                $('#analysis').fadeOut(0)
            }
            radio.eq(0).on('click', function () {
                $('#analysis').fadeOut()
                select_analysis.val('0');
                select_analysis.trigger('change');
            });
            radio.eq(1).on('click', function () {
                $('#analysis').fadeIn()
            });

        });
    </script>

@endpush
