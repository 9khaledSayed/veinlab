@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Sub Analysis')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.sub_analysis.index')}}" class="btn btn-secondary">
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
                    {{__('New Sub Analysis')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="post" action="{{route('dashboard.sub_analysis.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12">{{__('Main Analysis')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control kt-selectpicker @error('main_analysis_id') is-invalid @enderror"  name="main_analysis_id" data-size="7" data-live-search="true" data-show-subtext="true">
                            <option>{{__('Choose')}}</option>
                            @foreach( $MainAnalyzes as $MainAnalysis )
                                <option value="{{$MainAnalysis->id}}" data-subtext="{{$MainAnalysis->abbreviated_name}}" style="font-size:x-large" >{{$MainAnalysis->general_name}}</option>
                            @endforeach
                        </select>
                        @error('main_analysis_id')
                        <div class="invalid-feedback">{{ $errors->first('main_analysis_id') }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Sub Analysis')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{old('name')}}" id="example-text-input" name="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Unit')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('unit') is-invalid @enderror" type="text" value="{{old('unit')}}" id="example-text-input"  name="unit">
                        @error('unit')
                        <div class="invalid-feedback">{{ $errors->first('unit') }}</div>
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
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')
    <script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
@endpush
