@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Companies')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.companies.index')}}" class="btn btn-secondary">
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
                    {{__('Company Info')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" >
            @method('POST')
            @csrf
            <div class="kt-portlet__body">

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Company Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="text" readonly value="{{ $company->name}}" style="text-align:center;font-weight:bold" id="example-text-input" name="name">

                    </div>
                </div>

                <div class="form-group row">
                    <h2 class="col-lg-12 col-sm-12 col-md-12 mt-3 mb-3" style="text-align:center">{{__('Classes')}}</h2>
                </div>

                @foreach($company->categories as $category)

                    <div class="form-group row"  >
                        <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12"></label>
                        <div class="col-lg-4 col-md-4 col-sm-4" >
                            <input
                                class="form-control"
                                disabled="disabled"
                                name="price"
                                style="text-align:center;font-weight:bold"
                                value="{{$category->name}}"
                                id="example-text-input">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2" >
                            <input
                                class="form-control"
                                disabled="disabled"
                                name="price"
                                style="text-align:center;font-weight:bold"
                                value="{{$category->percentage}} %"
                                id="example-text-input">
                        </div>
                    </div>
                @endforeach



            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-12" style="text-align:center">
                            <a href="{{ route('dashboard.companies.index') }}" class="btn btn-success">{{__('Back')}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <input type="number" id="number_classes" value="1" style="display:none" name="number_classes" >


        </form>
    </div>

    <!--end::Portlet-->

@endsection
