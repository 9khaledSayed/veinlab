@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Doctors')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.doctors.index')}}" class="btn btn-secondary">
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
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.doctors.update',$doctor)}}">
            @csrf
            @method('PUT')
            <div class="kt-portlet__body">
                <div class="form-group row mt-2">
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>{{__('Name')}}</label>
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            type="text"
                            name="name"
                            placeholder="{{__('Enter name')}}"
                            value="{{ old('name') ?? $doctor->name }}"
                            id="example-text-input">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>{{__('Phone')}}</label>
                        <input
                            class="form-control @error('phone') is-invalid @enderror"
                            type="text"
                            name="phone"
                            placeholder="{{__('Enter Phone')}}"
                            value="{{old('phone') ?? $doctor->phone}}"
                            id="example-text-input">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mt-5">
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>{{__('Email')}}</label>
                        <input
                            class="form-control @error('email') is-invalid @enderror"
                            type="email"
                            name="email"
                            placeholder="{{__('Enter email')}}"
                            value="{{old('email') ?? $doctor->email}}"
                            id="example-email-input">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>{{__('Percentage')}}</label>
                        <input
                            class="form-control @error('percentage') is-invalid @enderror"
                            type="number"
                            name="percentage"
                            placeholder="{{__('Enter Percentage')}}"
                            value="{{old('percentage') ?? $doctor->percentage}}"
                            id="example-email-input">
                        @error('percentage')
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
                            <a href="{{route('dashboard.doctors.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
        $('#kt_select2_3, #kt_select2_3_validate').select2({
            placeholder: "{{__('Choose Analysis')}}",
        });
    </script>
@endpush
