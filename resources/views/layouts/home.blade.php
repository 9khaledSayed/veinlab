<!DOCTYPE html>
<html  lang="{{App::getLocale()}}" @if(App::isLocale('ar'))dir="rtl"@endif>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    @include('layouts.parts.home.head')
</head>
<style>
    /*html {*/
    /*    scroll-behavior: smooth;*/
    /*}*/

    @font-face {
        font-family: Myriad Pro Regular;
        src: url('{{ asset('fonts/MyriadPro-Regular.otf') }}');
    }
    @font-face {
        font-family: DroidKufi Regular;
        src: url('{{ asset('fonts/Droid.Arabic.Kufi_DownloadSoftware.iR_.ttf') }}');
    }
    *:not(i){
        font-family: 'DroidKufi Regular',"Myriad Pro Regular" !important;
    }
    .group label {-
        @if(App::isLocale('ar'))right:0; @else left:0 @endif top: 14px;
    }
    .footer, .footer-logo, .contact, .contact-item{
        text-align: center;
    }
    .footer-social-info{
        @if(App::isLocale('ar')) padding-right: 43px; @else padding-left: 43px @endif
        text-align: center;
    }
    .hero-section.ai2 {
        background: url({{asset("home_assets/img/bg-img/header2" . App::getLocale() . ".jpg")}}) no-repeat top left;
        background-size: cover;
    }
    @if(App::isLocale('ar'))
        #home{
           direction: rtl;
            text-align: right;
        }
    @else
        #home{
            direction: ltr;
            text-align: left;
        }
    @endif
</style>
<body class="light-version">
<!-- Preloader -->
<div id="preloader">
    <div class="preload-content">
        <div id="dream-load"></div>
    </div>
</div>
@include('layouts.parts.home.header')

@yield('content')
<div class="footer">
    @include('layouts.parts.home.footer')
</div>
<div class="container">
    <!-- begin::Sticky Toolbar -->
    <ul class="kt-sticky-toolbar" style="margin-top:130px;">
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--dark" id="kt_demo_panel_toggle" data-toggle="kt-tooltip" title="phone" data-placement="right">
            <a href="tel:{{Setting::get('Telephone')}}"><i class="fa fa-phone"></i></a>
        </li>
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" id="kt_demo_panel_toggle" data-toggle="kt-tooltip" title="whatsapp" data-placement="right">
            <a href="https://api.whatsapp.com/send?phone={{Setting::get('Telephone')}}&text=&source=&data=&app_absent=" class="" target="_blank"><i class="fa fa-whatsapp"></i></a>
        </li>
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--brand" data-toggle="kt-tooltip" title="twitter" data-placement="left">
            <a href="https://twitter.com/veinlab" target="_blank"><i class="fa fa-twitter"></i></a>
        </li>
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--warning" data-toggle="kt-tooltip" title="snapchat" data-placement="left">
            <a href="https://www.snapchat.com/add/veinlab" target="_blank"><i class="fa fa-snapchat"></i></a>
        </li>
        <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--primary" id="kt_sticky_toolbar_chat_toggler" data-toggle="kt-tooltip" title="email" data-placement="left">
            <a href="mailto:support@yourdomain.com" data-toggle="modal" data-target="#kt_chat_modal"><i class="fa fa-envelope"></i></a>
        </li>
    </ul>

    <!-- end::Sticky Toolbar -->

</div>

@include('layouts.parts.home.foot')

</body>



<!-- Mirrored from deltic.netlify.app/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 28 Jun 2020 16:42:48 GMT -->
</html>
