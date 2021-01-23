@extends('layouts.dashboard')
@section('content')
    <div class="kt-portlet" style="margin-top: 20px;">
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-lg border-bottom">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <!--begin::Total Profit-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="/dashboard/exports/create">
                                    <h4 class="kt-widget24__title">
                                        {{__('Welcome To Vein Lab')}}
                                    </h4>
                                </a>
                            </div>
                            <span class="kt-widget24__stats kt-font-primary">
                                <i class="fas fa-flask" style="font-size: 4rem"></i>
{{--                                <i class="fas fa-vials" style="font-size: 4rem"></i>--}}
                            </span>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
            </div>
        </div>
    </div>

@endsection
