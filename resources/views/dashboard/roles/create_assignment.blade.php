@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Roles')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.roles.assigned_employees')}}" class="btn btn-secondary">
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
                    {{__('Create Assignment')}}
                </h3>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.roles.create_assignment')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row mt-2">
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label><span class="required" >*</span>{{__('Employees')}}</label>
                        <select class="form-control @error('employee_id')is-invalid @enderror kt-select2 select_box"
                                name="employee_id">
                            <option selected></option>
                            @forelse($employees as $employee)
                                <option
                                    value="{{$employee->id}}"
                                    @if($employee->id == old('employee_id')) selected @endif
                                >{{$employee->fname_arabic . ' ' . $employee->lname_arabic}}
                                </option>
                            @empty
                                <option disabled>{{__('There is no employees')}}</option>
                            @endforelse
                        </select>
                        @error('employee_id')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label><span class="required" >*</span>{{__('Roles')}}</label>
                        <select class="form-control @error('role_ids')is-invalid @enderror kt-select2 select_box"
                                name="role_ids[]"
                                multiple>
                            @forelse($roles as $role)
                                <option
                                    value="{{$role->id}}"
                                    @if($role->id == old('role_ids')) selected @endif
                                >{{$role->Name()}}</option>
                            @empty
                                <option disabled>{{__('There is no roles')}}</option>
                            @endforelse
                        </select>
                        @error('role_ids')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.roles.assigned_employees')}}" class="btn btn-secondary">{{__('back')}}</a>
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
        $('.select_box').select2({
            placeholder: "Choose",
        });
    </script>
@endpush
