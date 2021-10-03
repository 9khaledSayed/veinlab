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
                            {{__('Update Patient Info')}}
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" action="{{route('dashboard.patients.update', $patient)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label><span class="required" >*</span>{{__('Patient Name')}}:</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid  @enderror"
                                       name="name"
                                       required
                                       value="{{old('name') ?? $patient->name}}"
                                       placeholder="{{__('Enter full name')}}">
                                @error('name')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label><span class="required" >*</span>{{__('ID Number')}}:</label>
                                <input type="text"
                                       class="form-control @error('id_no') is-invalid  @enderror"
                                       name="id_no"
                                       required
                                       maxlength="{{setting('max_id_no')}}"
                                       value="{{old('id_no') ?? $patient->id_no}}"
                                       placeholder="{{__('Enter ID Number')}}">
                                @error('id_no')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label><span class="required" >*</span>{{__('Phone Number')}}:</label>


                                <div class="input-group">
                                    <input type="tel"
                                           class="form-control @error('phone')is-invalid @enderror"
                                           name="phone"
                                           required
                                           maxlength="{{setting('max_phone_no')}}"
                                           value="{{old('phone') ?? $patient->phone}}"
                                           placeholder="مثال: 05xxxxxxxx">
                                    <div class="input-group-append">
                                        <span class="input-group-text">966+</span>
                                    </div>
                                </div>

                                @error('phone')
                                <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label>{{__('Email')}}:</label>
                                <input type="email"
                                       class="form-control @error('email')is-invalid  @enderror"
                                       name="email"
                                       value="{{old('email') ?? $patient->email}}"
                                       placeholder="{{__('Enter email')}}">
                                @error('email')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label><span class="required" >*</span>{{__('Gender')}}:</label>
                                <select name="gender"
                                        required
                                        class="form-control @error('gender')is-invalid @enderror kt-selectpicker"
                                        value="{{old('gender')}}"
                                        title="{{__('Choose')}}">
                                    <option value="0" @if((old('gender') ??$patient->gender) == "0") selected @endif>{{__('Male')}}</option>
                                    <option value="1" @if((old('gender') ?? $patient->gender) == "1") selected @endif>{{__('Female')}}</option>
                                    <option value="1" @if((old('gender') ?? $patient->gender) == "2") selected @endif>{{__('Child')}}</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label><span class="required" >*</span>{{__('Nationality')}}:</label>
                                <select name="nationality_id"
                                        required
                                        class="form-control @error('nationality_id')is-invalid @enderror kt-selectpicker"
                                        title="{{__('Choose')}}">
                                    @foreach($nationalities as $nationality)
                                        <option value="{{$nationality->id}}" @if((old('nationality_id') ?? $patient->nationality_id) == $nationality->id) selected @endif>{{$nationality->nationality}}</option>
                                    @endforeach
                                </select>
                                @error('nationality')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label><span class="required" >*</span>{{__('Age')}}:</label>
                                <input type="number"
                                       class="form-control @error('age')is-invalid @enderror"
                                       name="age"
                                       required
                                       value="{{old('age') ?? $patient->age}}"
                                       placeholder="{{__('Enter age')}}" />
                                @error('age')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="">{{__('City')}}:</label>
                                <input type="text"
                                       class="form-control @error('city')is-invalid @enderror"
                                       name="city"
                                       value="{{old('city') ?? $patient->city}}"
                                       placeholder="{{__('Enter city')}}">
                                @error('city')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>{{__('Address')}}:</label>
                                <input type="text"
                                       class="form-control @error('address')is-invalid @enderror"
                                       name="address"
                                       value="{{old('address') ?? $patient->address}}"
                                       placeholder="{{__('Enter address')}}">
                                @error('Address')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="">{{__('Any Diseases')}}:</label>
                                <input type="text"
                                       class="form-control @error('diseases')is-invalid @enderror"
                                       name="diseases"
                                       value="{{old('diseases') ?? $patient->diseases}}"
                                       placeholder="{{__('Enter diseases')}}">
                                @error('diseases')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label > {{__('Blood Type')}}:</label>
                                <select class="form-control @error('blood_type')is-invalid @enderror kt-selectpicker"
                                        name="blood_type"
                                        title="{{__('Choose')}}">
                                    <option value="A+" @if((old('blood_type') ?? $patient->blood_type) == "A+") selected @endif>A+</option>
                                    <option value="B+" @if((old('blood_type') ?? $patient->blood_type) == "B+") selected @endif>B+</option>
                                    <option value="AB+" @if((old('blood_type') ?? $patient->blood_type) == "AB+") selected @endif>AB+</option>
                                    <option value="O+" @if((old('blood_type') ?? $patient->blood_type) == "O+") selected @endif>O+</option>
                                    <option value="A-" @if((old('blood_type') ?? $patient->blood_type) == "A-") selected @endif>A-</option>
                                    <option value="B-" @if((old('blood_type') ?? $patient->blood_type) == "B-") selected @endif>B-</option>
                                    <option value="AB-" @if((old('blood_type') ?? $patient->blood_type) == "AB-") selected @endif>AB-</option>
                                    <option value="O-" @if((old('blood_type') ?? $patient->blood_type) == "O-") selected @endif>O-</option>
                                </select>
                                @error('blood_type')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>{{__('Weight')}}:</label>
                                <input type="text"
                                       class="form-control @error('weight')is-invalid @enderror"
                                       name="weight"
                                       value="{{old('weight') ?? $patient->weight}}"
                                       placeholder="{{__('Enter weight')}}">
                                @error('weight')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>{{__('Height')}}:</label>
                                <input type="text"
                                       class="form-control @error('height')is-invalid @enderror"
                                       name="height"
                                       value="{{old('height') ?? $patient->height}}"
                                       placeholder="{{__('Enter height')}}">
                                @error('height')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
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
                                    <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                    <a href="{{route('dashboard.patients.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
        $(function() {
            $('.kt-selectpicker').selectpicker();
        });
    </script>
@endpush
