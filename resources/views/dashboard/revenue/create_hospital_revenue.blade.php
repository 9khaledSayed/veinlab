@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Revenue')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.revenue.index')}}" class="btn btn-secondary">
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
                    {{__('Receipt voucher')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="{{route('dashboard.revenue.storeHospitalRevenue', $hospital->id)}}" method="post">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <h1 class="col-lg-12 col-sm-12 col-md-12 mt-3 mb-3" style="text-align:center">{{$hospital->name}}</h1>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-4 col-sm-12">{{__('Amount')}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <input
                            class="form-control @error('amount') is-invalid @enderror"
                            name="amount"
                            step="0.01"
                            type="number"
                            style="text-align:center;font-weight:bold"
                            value="{{old('amount')}}"
                            id="amount">
                        @error('amount')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 kt-padding-5" >
                        <h2>{{$hospital->dues - (old('amount')??0)}} {{'SAR'}}</h2>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-4 col-sm-12">{{__('Check no')}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <input
                            class="form-control @error('CheckNo') is-invalid @enderror"
                            name="CheckNo"
                            type="text"
                            style="text-align:center;font-weight:bold"
                            value="{{old('CheckNo')}}"
                            id="CheckNo">
                        @error('CheckNo')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-4 col-sm-12">{{__('Bank')}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <input
                            class="form-control @error('bank') is-invalid @enderror"
                            name="bank"
                            type="text"
                            style="text-align:center;font-weight:bold"
                            value="{{old('bank')}}"
                            id="bank">
                        @error('bank')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-4 col-sm-12">{{__('This About')}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-4" >
                        <input
                            class="form-control @error('thisAbout') is-invalid @enderror"
                            name="thisAbout"
                            type="text"
                            style="text-align:center;font-weight:bold"
                            value="{{old('thisAbout')}}"
                            id="thisAbout">
                        @error('thisAbout')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-datetime-local-input" class="col-form-label col-lg-4 col-sm-12">{{__('Check Date')}}</label>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <input class="form-control  @error('checkDate') is-invalid @enderror" type="datetime-local" value="{{ old('checkDate') }}" id="example-datetime-local-input" name="checkDate">
                        @error('checkDate')
                        <div class="invalid-feedback">{{ $errors->first('checkDate') }}</div>
                        @enderror
                    </div>
                </div>


            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.revenue.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <input type="number" id="number_classes" value="1" style="display:none" name="number_classes" >


        </form>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')
    <script>
        $(function(){
            var walletelement = $("h2:contains('SAR')");
            var wallet = parseFloat(walletelement.text());
            $('#amount').keyup(function () {
                var amount = $(this).val();
                walletelement.text(wallet - amount + ' SAR');
            });
        });
    </script>
@endpush
