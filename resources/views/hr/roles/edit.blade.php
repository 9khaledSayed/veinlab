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
                <a href="{{route('dashboard.hr.roles.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label" style="margin: auto">
                <h3 class="kt-portlet__head-title">
                    {{__('Update Info')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form action="{{route('dashboard.hr.roles.update', $role)}}" method="post">
                @method('put')
                @csrf
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>{{__('Arabic Name')}}</label>
                        <input type="text"
                               name="name_arabic"
                               value="{{old('name_arabic') ?? $role->name_arabic}}"
                               class="form-control @error('name_arabic') is-invalid @enderror"
                               placeholder="{{__('Enter name')}}">
                        @error('name_arabic')
                        <span class="invalid-feedback" style="display: block">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label>{{__('English Name')}}</label>
                        <input type="text"
                               name="name_english"
                               value="{{old('name_english') ?? $role->name_english}}"
                               class="form-control @error('name_english') is-invalid @enderror"
                               placeholder="{{__('Enter name')}}">
                        @error('name_english')
                        <span class="invalid-feedback" style="display: block">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="kt-section">

                    <div class="kt-section__content">

                        <table class="table">
                            @foreach($categories as $category)
                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="2" style="text-align: center">{{__(ucwords(str_replace('_', ' ', $category)))}}</th>
                                    </tr>
                                    <tr style="text-align: center">
                                        <td>{{__('Permissions')}}</td>
                                        <td>{{__('Status')}}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($abilities->where('category', $category) as $ability)
                                    <tr style="text-align: center">
                                        <td>{{__(explode(" ",$ability->label)[0]) . ' ' . __(preg_replace("/^(\w+\s)/", "", $ability->label))}}</td>
                                        <td>
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    <input type="checkbox"
                                                           {{ (old($ability->name) ?? $role_abilities->contains($ability))? 'checked' : '' }}
                                                           name="{{$ability->name}}">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @endforeach

                        </table>
                    </div>
                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                                <a href="{{route('dashboard.hr.roles.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Section-->
        </div>
    </div>

    <!--end::Portlet-->
@endsection

