@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Nationalities')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.nationalities.index')}}" class="btn btn-secondary">
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
                    {{__('New Nationality')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.nationalities.store')}}">
            @method('POST')
            @csrf
            <div class="kt-portlet__body">

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Arabic Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('nationality') is-invalid @enderror" type="text" value="{{ old('nationality') }}" id="example-text-input" name="nationality">
                        @error('nationality')
                        <div class="invalid-feedback">{!! $message !!}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('English Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control @error('name_english') is-invalid @enderror" type="text" value="{{ old('name_english') }}" id="example-text-input" name="name_english">
                        @error('name_english')
                        <div class="invalid-feedback">{!! $message !!}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.nationalities.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--end::Portlet-->

@endsection

@push('scripts')

@endpush
