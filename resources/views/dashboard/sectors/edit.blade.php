@extends('layouts.dashboard')

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Sectors')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.sectors.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->
    @foreach ($errors->all() as $error)
        <div>{{$error}}</div>
    @endforeach
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
        <form class="kt-form kt-form--label-right" method="POST" action="{{route('dashboard.sectors.update', $sector)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="kt-portlet__body">
                <div class="form-group row mt-2">
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>{{__('Name')}}</label>
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            type="text"
                            name="name"
                            value="{{old('name') ?? $sector->name}}"
                            id="example-text-input">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>{{__('Percentage')}}</label>
                        <input
                            class="form-control @error('percentage') is-invalid @enderror"
                            type="text"
                            name="percentage"
                            value="{{old('percentage')  ?? $sector->percentage}}"
                            id="example-text-input">
                        @error('percentage')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="kt-section">
                    <div class="kt-section__title">

                    </div>
                    <div class="row">
                        <div class="col-lg-3 mx-auto">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{__('Logo')}}</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
                                        <div class="kt-avatar__holder" style="background-image: url({{asset('storage/sector_logo/' . $sector->logo)}})"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="sector_avatar_remove" value="0"/>
                                        </label>
                                        <span class="kt-avatar__cancel text-center" style="display: initial" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                                @error('logo')
                                <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot" style="text-align: center">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('confirm')}}</button>
                            <a href="{{route('dashboard.sectors.index')}}" class="btn btn-secondary">{{__('back')}}</a>
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
            placeholder: "Choose Analysis",
        });
        $(".kt-avatar__cancel").click(function (){
            $(".kt-avatar__holder").css('background-image','');
            $("input[name='sector_avatar_remove']").val('1');
        });
    </script>
@endpush
