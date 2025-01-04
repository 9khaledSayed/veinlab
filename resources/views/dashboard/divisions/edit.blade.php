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
            <a href="{{route('dashboard.divisions.index')}}" class="btn btn-secondary">
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
                {{__('Update Info')}}
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" method="POST"
        action="{{route('dashboard.divisions.update', $division->id)}}">
        @method('PUT')
        @csrf
        <div class="kt-portlet__body" id="form">
            <div class="form-group row">
                <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Name')}}</label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <input class="form-control @error('name') form-control is-invalid @enderror" type="text"
                        name="name" value="{{old('name') ?? $division->name}}"
                        id="example-text-input">
                    @error('name')
                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Analyses')}}</label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <select class="form-control @error('analyses_ids')is-invalid @enderror selectpicker"
                        id="kt_select2_3" name="analyses_ids[]" multiple data-live-search="true">
                        <option value=""></option>
                        @foreach(\App\MainAnalysis::all() as $mainAnalysis)
                        <option value="{{$mainAnalysis->id}}" @if($mainAnalysis->division_id == $division->id)
                            selected
                            @endif
                            >{{$mainAnalysis->general_name}}</option>
                        @endforeach
                    </select>
                    @error('analyses_ids')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                </div>
            </div>

        </div>


        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-12" style="text-align:center">
                        <button type="submit" class="btn btn-success">{{__('confirm')}}</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->
@endsection