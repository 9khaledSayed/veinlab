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
                    {{__("sub Analysis 's Info")}}
                </h3>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="post" action="{{route('dashboard.normal_ranges.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div id="repeater_div">
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 style="text-align:center" class="mt-5">{{$subAnalysis->name}}</h2>
                    </div>
                </div>
                </div>
            </div>
            <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" >
                <thead>
                <tr>
                    <th>{{__('Gender')}}</th>
                    <th>{{__('From')}}</th>
                    <th>{{__('To')}}</th>
                    <th>{{__('Normal')}}</th>
                </tr>
                </thead>
                <tbody id="table_body" >
                @foreach( $subAnalysis->normal_ranges as $normal_range)
                    <tr>
                        <td>{{$normal_range->gender}}</td>
                        <td>{{$normal_range->from}}</td>
                        <td>{{$normal_range->to}}</td>
                        <td>{!! $normal_range->value !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            <!--end: Datatable -->
        <input type="number" id="number_ranges" value="0" style="display:none" name="number_ranges" >
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-12" style="text-align:center">
                        <a href="{{ route('dashboard.sub_analysis.index') }}" class="btn btn-success">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <!--end::Portlet-->

@endsection
