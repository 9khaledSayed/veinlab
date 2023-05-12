@extends('layouts.dashboard')
@push('styles')
<style>
    li {
        list-style-type: disc;
    }
</style>
    
@endpush
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{__('Qr code')}}
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="">
                </a>
                <a href="{{route('dashboard.index')}}" class="btn btn-secondary">
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
                            {{__('Check in & Check out QRCode')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="form-group d-flex flex-column justify-content-center">
                        <div class="alert alert-warning flex-column" role="alert">
                            <h4 class="alert-heading">يرجى الأخذ بالإعتبار انه:-</h4>
                            <ul>
                                <li>يجب عليك فتح هذه الصفحة من هاتفك الجوال فقط</li>
                                <li>لن يتم قبول الحضور او الإنصراف الا من اول جهاز تم استخدامه</li>
                                <li>عند فتح هذه الصفحة تأكد من وجودك في المختبر </li>
                                <li>قم بتوجيه جهازك نحو قارئ الكيو ار كود بالمختبر حتى يتم تسجيل حضورك او انصرافك</li>
                            </ul>
                        </div>
                        <div class="m-auto p-5">
                            {{QrCode::size(250)->generate($qr)}}
                        </div>

                        <a href="{{route('dashboard.qr_code.generate')}}" id="qr-generate-reload" class="btn btn-brand" style="width: fit-content;margin: auto;align-items: center;display: flex;"><i class="flaticon2-reload"></i> Reload</a>
                    </div>
                </div>
                <div class="kt-portlet__foot" style="text-align: center">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{route('dashboard.index')}}" class="btn btn-secondary">{{__('back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
    
        $(function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    lat = position.coords.latitude;
                    lng = position.coords.longitude;

                    let reloadUrl = $("#qr-generate-reload").attr('href')
                    $("#qr-generate-reload").attr('href', `${reloadUrl}?lat=${lat}&lng=${lng}`);

                });

            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        });
    </script>

@endpush
