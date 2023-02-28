@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Hospitals')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hospitals.index')}}" class="btn btn-secondary">
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
                    {{__('New Hospital')}}
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.hospitals.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row mt-2">
                    <div class="col-lg-4">
                        <label>{{__('Name')}}</label>
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            type="text"
                            name="name"
                            placeholder="{{__('Enter name')}}"
                            value="{{old('name')}}"
                            id="example-text-input">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label>{{__('Phone')}}</label>
                        <input
                            class="form-control @error('phone') is-invalid @enderror"
                            type="number"
                            name="phone"
                            placeholder="{{__('Enter Phone')}}"
                            value="{{old('phone')}}"
                            id="example-email-input">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label>{{__('Email')}}</label>
                        <input
                                class="form-control @error('email') is-invalid @enderror"
                                type="email"
                                name="email"
                                placeholder="{{__('Enter email')}}"
                                value="{{old('email')}}"
                                id="example-email-input">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>{{__('Password')}}</label>
                        <input
                            class="form-control @error('password')is-invalid @enderror"
                            type="password"
                            name="password"
                            placeholder="{{__('Enter password')}}"
                            value="{{old('password')}}"
                            id="example-password-input">
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>{{__('Confirm Password')}}</label>
                        <input
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            type="password"
                            name="password_confirmation"
                            placeholder="{{__('Enter password')}}"
                            value="{{old('password_confirmation')}}"
                            id="example-email-input">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                <div class="kt-heading kt-heading--md">{{__('التحاليل المخصصة')}}</div>
                <div id="kt_repeater_1">
                    <div class="form-group form-group-last row" id="kt_repeater_1">
                        <label class="col-lg-2 col-form-label"></label>
                        <div data-repeater-list="main_analyses" class="col-lg-10">
                            @forelse(old('main_analyses') ?? [] as $mainAnalysisItem)

                                <div data-repeater-item class="form-group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <select name="id"
                                                        class="form-control @error('id')is-invalid @enderror selectpicker"
                                                        data-size="5"
                                                        data-live-search="true"
                                                        title="{{__('Choose')}}">
                                                    @foreach($mainAnalyses as $mainAnalysis)
                                                        <option value="{{$mainAnalysis->id}}" @if($mainAnalysisItem['id'] == $mainAnalysis->id) selected @endif>{{$mainAnalysis->general_name . " - " . $mainAnalysis->price . " SAR" . $mainAnalysis->code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('main_analyses.' . $loop->index . '.id')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input type="number" min="0" name="price" class="text-center form-control @error('price') is-invalid @enderror" placeholder="{{__('Price')}}" value="{{$mainAnalysisItem['price']}}">
                                                @error('main_analyses.' . $loop->index . '.price')
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
                                    <div class="col-md-4">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <select name="id"
                                                        class="form-control @error('id')is-invalid @enderror selectpicker"
                                                        data-size="5"
                                                        data-live-search="true"
                                                        title="{{__('Choose')}}">
                                                    @foreach($mainAnalyses as $mainAnalysis)
                                                        <option value="{{$mainAnalysis->id}}" @if((old('id')) == $mainAnalysis->id) selected @endif>{{$mainAnalysis->general_name . " - " . $mainAnalysis->price . " SAR" . $mainAnalysis->code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('id')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__control">
                                                <input type="number" min="0" name="price" class="text-center form-control @error('price') is-invalid @enderror" placeholder="{{__('Price')}}">
                                                @error('price')
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
                            <a href="{{route('dashboard.hospitals.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
                    $(".selectpicker").selectpicker();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
    </script>
@endpush
