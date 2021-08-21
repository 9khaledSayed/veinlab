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
                    {{__('Update Info')}}
                </h3>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.hospitals.update', $hospital)}}">
            @csrf
            @method('PUT')
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Name')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            type="text"
                            name="name"
                            placeholder="{{__('Enter name')}}"
                            value="{{old('name') ?? $hospital->name}}"
                            id="example-text-input">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Phone')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('phone') is-invalid @enderror"
                            type="number"
                            name="phone"
                            placeholder="{{__('Enter Phone')}}"
                            value="{{old('phone') ?? $hospital->phone}}"
                            id="example-email-input">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Email')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                                class="form-control @error('email') is-invalid @enderror"
                                type="email"
                                name="email"
                                placeholder="{{__('Enter email')}}"
                                value="{{old('email') ?? $hospital->email}}"
                                id="example-email-input">
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('سعر التحاليل')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                                class="form-control @error('amount') is-invalid @enderror"
                                type="number"
                                name="amount"
                                placeholder="{{__('Enter amount')}}"
                                value="{{old('amount') ?? $hospital->amount}}"
                                id="example-amount-input">
                        @error('amount')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('نوع المعاملة')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select name="amount_type"
                                class="form-control @error('amount_type')is-invalid @enderror selectpicker"
                                title="{{__('Choose')}}">
                            <option value="addition" @if((old('amount_type') ?? $hospital->amount_type) == "addition") selected @endif>{{__('إضافة علي سعر التحليل الاصلي')}}</option>
                            <option value="deduction" @if((old('amount_type') ?? $hospital->amount_type) == "deduction") selected @endif>{{__('خصم من سعر التحليل الاصلي')}}</option>
                        </select>
                        @error('amount_type')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Password')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('password') is-invalid @enderror"
                            type="password"
                            name="password"
                            autocomplete="new-password"
                            id="example-password-input">
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-form-label col-lg-3 col-sm-12">{{__('Confirm Password')}}</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password"
                            value="{{old('password_confirmation')}}"
                            id="example-email-input">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
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
