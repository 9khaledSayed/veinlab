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
                <a href="{{route('dashboard.main_analysis.index')}}" class="btn btn-secondary">
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
                    {{__('New Analysis')}}
                </h3>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.main_analysis.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('General Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('general_name') form-control is-invalid @enderror"
                            type="text"
                            name="general_name"
                            value="{{old('general_name')}}"
                            id="example-text-input">
                        @error('general_name')
                            <div class="invalid-feedback">{{$errors->first('general_name')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Abbreviated Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('abbreviated_name') form-control is-invalid @enderror"
                            type="text"
                            name="abbreviated_name"
                            value="{{old('abbreviated_name')}}"
                            id="example-text-input">
                        @error('abbreviated_name')
                            <div class="invalid-feedback">{{$errors->first('abbreviated_name')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Code')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('code') form-control is-invalid @enderror"
                            type="text"
                            name="code"
                            value="{{old('code')}}"
                            id="example-text-input">
                        @error('code')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Discount')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('discount') form-control is-invalid @enderror"
                            type="number"
                            name="discount"
                            placeholder="0.00"
                            value="{{old('discount')}}"
                            id="example-text-input">
                        @error('discount')
                        <div class="invalid-feedback">{{$errors->first('discount')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Cost')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('cost') form-control is-invalid @enderror"
                            type="number"
                            name="cost"
                            placeholder="0.00"
                            value="{{old('cost')}}"
                            id="example-text-input">
                            @error('cost')
                                <div class="invalid-feedback">{{$errors->first('cost')}}</div>
                            @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('price') form-control is-invalid @enderror"
                            type="number"
                            name="price"
                            placeholder="0.00"
                            value="{{old('price')}}"
                            id="example-text-input">
                            @error('price')
                                <div class="invalid-feedback">{{$errors->first('price')}}</div>
                            @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Insurance Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('price_insurance') form-control is-invalid @enderror"
                            type="text"
                            name="price_insurance"
                            placeholder="0.00"
                            value="{{old('price_insurance')}}"
                            id="example-text-input">
                        @error('price_insurance')
                        <div class="invalid-feedback">{{$errors->first('price_insurance')}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Hospitals Price')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-9">
                        <input
                            class="form-control @error('price_hospital') form-control is-invalid @enderror"
                            type="text"
                            name="price_hospital"
                            placeholder="0.00"
                            value="{{old('price_hospital')}}"
                            id="example-text-input">
                        @error('price_hospital')
                        <div class="invalid-feedback">{{$errors->first('price_hospital')}}</div>
                        @enderror
                    </div>
                </div>

                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                <div class="kt-heading kt-heading--md">{{__('Sub Analysis ( Tests )')}}</div>
                <div id="kt_repeater_1">
                    <div class="form-group form-group-last row" id="kt_repeater_1">
                        <label class="col-lg-2 col-form-label"></label>
                        <div data-repeater-list="sub_analyses" class="col-lg-10">
                            @forelse(old('sub_analyses') ?? [] as $subAnalyses)

                                <div data-repeater-item class="form-group row align-items-center">
                                    <div class="col-md-3">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input type="text" dir="auto" name="name" class="text-center form-control @error('name') is-invalid @enderror" value="{{$subAnalyses['name']}}" placeholder="{{__('Name')}}">
                                                @error('sub_analyses.' . $loop->index . '.name')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input type="text" dir="auto" name="unit" class="text-center form-control @error('unit') is-invalid @enderror" value="{{$subAnalyses['unit']}}" placeholder="{{__('Unit (optional)')}}">
                                                @error('sub_analyses.' . $loop->index . '.unit')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input type="text" dir="auto" name="classification" class="text-center form-control @error('classification') is-invalid @enderror" value="{{$subAnalyses['classification']}}" placeholder="{{__('Classification (optional)')}}">
                                                @error('sub_analyses.' . $loop->index . '.classification')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="mx-3">
                                        <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                                            <i class="la la-trash-o"></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>

                            @empty
                                <div data-repeater-item class="form-group row align-items-center">
                                    <div class="col-md-3">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input type="text" dir="auto" name="name" class="text-center form-control @error('name') is-invalid @enderror" placeholder="{{__('Name')}}">
                                                @error('name')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input type="text" dir="auto" name="unit" dir="auto" class="text-center form-control @error('unit') is-invalid @enderror" placeholder="{{__('Unit (optional)')}}">
                                                @error('unit')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input type="text" dir="auto" name="classification" class="text-center form-control @error('classification') is-invalid @enderror" placeholder="{{__('Classification (optional)')}}">
                                                @error('classification')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="mx-3">
                                        <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                                            <i class="la la-trash-o"></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                    <div class="form-group form-group-last row">
                        <div class="mx-auto">
                            <a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand">
                                <i class="la la-plus"></i> Add
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.main_analysis.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
        $(function () {
            $('#kt_repeater_1').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
    </script>
@endpush
