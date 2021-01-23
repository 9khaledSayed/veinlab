@extends('layouts.dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Patients')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.patients.index')}}" class="btn btn-secondary">
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
                            {{__('Patient Info')}}
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->

                    @csrf
                    @method('put')
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label>{{__('File No')}}:</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       disabled="disabled"
                                       value="{{$patient->id}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                            <div class="col-lg-3">
                                <label>{{__('Patient Name')}}:</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       disabled="disabled"
                                       value="{{$patient->name}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                            <div class="col-lg-3">
                                <label>{{__('ID Number')}}:</label>
                                <input type="text"
                                       class="form-control"
                                       name="id_no"
                                       disabled="disabled"
                                       value="{{$patient->id_no}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                            <div class="col-lg-3">
                                <label>{{__('Phone Number')}}:</label>
                                <input type="number"
                                       class="form-control"
                                       name="phone"
                                       disabled="disabled"
                                       value="{{$patient->phone}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label>{{__('Email')}}:</label>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       disabled="disabled"
                                       value="{{$patient->email}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                            <div class="col-lg-3">
                                <label>{{__('Gender')}}:</label>
                                <select name="gender"
                                        disabled="disabled"
                                        class="form-control @error('gender')is-invalid @enderror kt-selectpicker"
                                        title="{{__('not found')}}">
                                    <option value="0" @if((old('gender') ??$patient->gender) == "0") selected @endif>{{__('Male')}}</option>
                                    <option value="1" @if((old('gender') ?? $patient->gender) == "1") selected @endif>{{__('Female')}}</option>
                                    <option value="1" @if((old('gender') ?? $patient->gender) == "2") selected @endif>{{__('Child')}}</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>{{__('Nationality')}}:</label>
                                <select name="nationality_id"
                                        disabled
                                        class="form-control @error('nationality_id')is-invalid @enderror kt-selectpicker"
                                        title="{{__('Choose')}}">
                                    <option value="0" @if((old('nationality_id') ?? $patient->nationality_id) == "0") selected @endif>{{__('Saudi')}}</option>
                                    @foreach($nationalities as $nationality)
                                        <option value="{{$nationality->id}}" @if((old('nationality_id') ?? $patient->nationality_id) == $nationality->id) selected @endif>{{$nationality->nationality}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>{{__('Age')}}:</label>
                                <input type="number"
                                       class="form-control"
                                       name="age"
                                       disabled="disabled"
                                       value="{{$patient->age}}"
                                       placeholder="{{__('not found')}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="">{{__('City')}}:</label>
                                <input type="text"
                                       class="form-control"
                                       name="city"
                                       disabled="disabled"
                                       value="{{$patient->city}}"
                                       placeholder="{{__('not found')}}"/>
                            </div>
                            <div class="col-lg-4">
                                <label>{{__('Address')}}:</label>
                                <input type="text"
                                       class="form-control"
                                       name="address"
                                       disabled="disabled"
                                       value="{{$patient->address}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                            <div class="col-lg-4">
                                <label class="">{{__('Any Diseases')}}:</label>
                                <input type="text"
                                       class="form-control"
                                       name="diseases"
                                       disabled="disabled"
                                       value="{{$patient->diseases}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label > {{__('Blood Type')}}:</label>
                                <select class="form-control kt-selectpicker"
                                        name="blood_type"
                                        disabled="disabled"
                                        title="{{__('not found')}}">
                                    <option value="A+" @if($patient->blood_type === "A+") selected @endif>A+</option>
                                    <option value="B+" @if($patient->blood_type === "B+") selected @endif>B+</option>
                                    <option value="AB+" @if($patient->blood_type === "AB+") selected @endif>AB+</option>
                                    <option value="O+" @if($patient->blood_type ==="O+") selected @endif>O+</option>
                                    <option value="A-" @if($patient->blood_type === "A-") selected @endif>A-</option>
                                    <option value="B-" @if($patient->blood_type === "B-") selected @endif>B-</option>
                                    <option value="AB-" @if($patient->blood_type === "AB-") selected @endif>AB-</option>
                                    <option value="O-" @if($patient->blood_type === "O-") selected @endif>O-</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label>{{__('Weight')}}:</label>
                                <input type="text"
                                       disabled="disabled"
                                       class="form-control"
                                       name="weight"
                                       value="{{$patient->weight}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                            <div class="col-lg-4">
                                <label>{{__('Height')}}:</label>
                                <input type="text"
                                       disabled="disabled"
                                       class="form-control"
                                       name="height"
                                       value="{{$patient->height}}"
                                       placeholder="{{__('not found')}}">
                            </div>
                            {{--                            <div class="col-lg-3">--}}
                            {{--                                <label>{{__('Risk Factors')}}:</label>--}}
                            {{--                                    <input type="text"--}}
                            {{--                                           class="form-control @error('risk_factors')is-invalid @enderror"--}}
                            {{--                                           name="risk_factors"--}}
                            {{--                                           value="{{old('risk_factors')}}"--}}
                            {{--                                           placeholder="{{__('Enter risk factor')}}">--}}
                            {{--                                @error('risk_factors')--}}
                            {{--                                    <span class="invalid-feedback">--}}
                            {{--                                        {{$message}}--}}
                            {{--                                    </span>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                    <div class="kt-portlet__foot" style="text-align: center">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{route('dashboard.patients.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

                <!--end::Form-->
            </div>

            <!--end::Portlet-->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('.kt-selectpicker').selectpicker();
        });
    </script>
@endpush
