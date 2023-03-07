<!doctype html>
<html lang="{{App::getLocale()}}" @if(App::isLocale('ar'))dir="rtl"@endif>
<head>
    <title>{{app()->isLocale('ar')? setting('NameArabic'): setting('NameEnglish')}}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <link href="{{asset('assets/css/pages/login/login-3.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
{{--    <link href="{{asset('assets/style.css')}}" rel="stylesheet" type="text/css" />--}}

    <link rel="shortcut icon" href="{{asset(Setting::get('logo_path'))}}" />
</head>
<style>
    @font-face {
        font-family: Myriad Pro Regular;
        src: url('{{ asset('fonts/MyriadPro-Regular.otf') }}');
    }
    @font-face {
        font-family: DroidKufi Regular;
        src: url('{{ asset('fonts/Droid.Arabic.Kufi_DownloadSoftware.iR_.ttf') }}');
    }
    * {
        font-family: 'DroidKufi Regular',"Myriad Pro Regular" !important;
    }
    .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-login__head .kt-login__title {
        font-size: 2rem;
        font-weight: 600;
    }
</style>
<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{asset('assets/media/bg/bg-3.jpg')}});">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="{{asset(Setting::get('logo_path'))}}" alt="logo" width="250">
                        </a>
                    </div>
                    @yield('content')
                    <div class="kt-login__forgot">
                        <div class="kt-login__head">
                                <h3 class="kt-login__title">{{__('Forgotten Password ?')}}</h3>
                            <div class="kt-login__desc">{{__('Enter your email')}}</div>
                        </div>
                        <form class="kt-form" action="">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="{{__('Email')}}" name="email" id="kt_email" autocomplete="off">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_forgot_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">
                                    {{__('Request')}}</button>&nbsp;&nbsp;
                                <button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">
                                    {{__('Cancel')}}</button>
                            </div>
                        </form>
{{--                    </div>--}}
{{--                    <div class="kt-login__account">--}}
{{--                        <span class="kt-login__account-msg">--}}
{{--                            Don't have an account yet ?--}}
{{--                        </span>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#22b9ff",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/main_scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{asset('assets/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->
</body>
</html>
