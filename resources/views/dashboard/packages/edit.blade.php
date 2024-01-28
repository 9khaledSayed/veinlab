@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Packages')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.packages.index')}}" class="btn btn-secondary">
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
                            {{__('Update Info')}}
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" action="{{route('dashboard.packages.update',$package)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Name')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input
                                    class="form-control @error('name') form-control is-invalid @enderror"
                                    type="text"
                                    name="name"
                                    value="{{old('name') ?? $package->name}}"
                                    id="example-text-input">
                                @error('name')
                                <span class="invalid-feedback">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Analysis')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control @error('main_analysis_id')is-invalid @enderror kt-select2"
                                        id="kt_select2_3"
                                        name="main_analysis_id[]"
                                        multiple="multiple">
                                    @foreach(\App\MainAnalysis::all() as $analysis)
                                        <option
                                            value="{{$analysis->id}}"
                                            @foreach(unserialize($package->main_analysis) as $id)
                                                @if($analysis->id == $id)
                                                    selected
                                                @endif
                                            @endforeach
                                        >{{$analysis->general_name . ' - ' . $analysis->price . ' SAR'}}</option>
                                    @endforeach
                                </select>
                                @error('main_analysis_id')
                                <span class="invalid-feedback">
                                        {{$message}}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Price')}}</label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input
                                    class="form-control @error('price') form-control is-invalid @enderror"
                                    type="text"
                                    name="price"
                                    value="{{old('price') ?? $package->price}}"
                                    id="example-text-input">
                                @error('price')
                                <div class="invalid-feedback">{{$errors->first('price')}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot" style="text-align: center">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                    <a href="{{route('dashboard.packages.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
            /*Analysis select box*/
            $('#kt_select2_3, #kt_select2_3_validate').select2({
                placeholder: "{{__('Choose Analysis')}}",
            });
        });
    </script>

@endpush
