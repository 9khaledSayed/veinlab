@extends('layouts.hr')
@push('styles')
    <link href="{{asset('assets/css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Memos')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.hr.index')}}" class="btn btn-secondary">
                    {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->

    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white droid_font" id="kt_contacts_add"
                 data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                    <!--begin: Form Wizard Form-->
                    <form action="{{route('dashboard.hr.branches.update',$branch->id)}}" method="post" class="kt-form"
                          id="kt_contacts_add_form">
                    @method('PUT')
                    @csrf
                    <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"
                             data-ktwizard-state="current">
                            <div class="kt-section kt-section--first">
                                <div class="kt-wizard-v1__form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="kt-section__body">
                                                <div class="kt-section">
                                                    <div class="kt-section__body">
                                                        <div class="kt-portlet__body">
                                                            <div class="form-group form-group-marginless">


                                                                <div class="form-group row kt-margin-50">
                                                                    <div class="col-4">
                                                                        <label>{{__('Name')}} *</label>
                                                                        <input name="name" value="{{ $branch->name ?? old('name') }}" class="form-control" type="text">
                                                                        @error('name')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label>{{__('Address')}}</label>
                                                                        <input name="address" class="form-control" value="{{ $branch->address ?? old('address') }}" type="text" >
                                                                        @error('address')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label>{{__('License No')}}</label>
                                                                        <input name="license_no" class="form-control" value="{{ $branch->license_no ?? old('license_no') }}" type="text" >
                                                                        @error('license_no')
                                                                        <div class="invalid-feedback">
                                                                            {{$message}}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('Report signature')}}</label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_1">
                                                                                    <div class="kt-avatar__holder" style="background-image: url('{{asset($branch->report_signature)}}')"></div>
                                                                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                                                    <i class="fa fa-pen"></i>
                                                                                    <input type="file" name="report_signature" >
                                                                                </label>
                                                                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                                                    <i class="fa fa-times"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                                                        </div>
                                                                        @error('report_signature')
                                                                        <span class="invalid-feedback">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div
                                class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u mx-auto"
                                style="display: block" data-ktwizard-type="action-submit">
                                {{__('Submit')}}
                            </div>
                        </div>

                        <!--end: Form Actions -->
                    </form>

                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script type="text/javascript">
        var editPage = true;
    </script>

    <script src="{{asset('js/pages/branches.js')}}" type="text/javascript"></script>
        <script>
        $(function (){

            initKTAvatars();
        });

        var initKTAvatars = function () {
            new KTAvatar('kt_user_avatar_1');
        }

    </script>
@endpush
