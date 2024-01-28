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
                    {{__('Language')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.settings.language')}}">
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
