<base href="">
<meta charset="utf-8" />
<title>{{app()->isLocale('ar')? setting('NameArabic'): setting('NameEnglish')}}</title>
<meta name="description" content="Latest updates and statistic charts">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!--begin::Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
<link href="{{asset('assets/css/pages/error/error-1.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/pages/pricing/pricing-1' .( App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/pages/pricing/pricing-4' .( App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/global/plugins.bundle' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/style.bundle' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />

<link rel="icon" href="{{asset('logo/fav-logo.png')}}">
<link href="{{asset('assets/css/pages/invoices/invoice-2' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/pages/wizard/wizard-3' . (App::isLocale('ar')?'.rtl':'') . '.css')}}" rel="stylesheet" type="text/css" />
@stack('styles')
<link href="{{asset('assets/style.css')}}" rel="stylesheet" type="text/css" />
