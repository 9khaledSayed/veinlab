<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>{{app()->isLocale('ar')? setting('NameArabic'): setting('NameEnglish')}}</title>

<!-- Fav Icon -->
<link rel="icon" href="{{asset('logo/fav-logo.png')}}">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,300i,400,400i,600,600i,700,700i,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{asset('calendar/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" />
<link href="{{ asset('web') }}/assets/css/font-awesome-all.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/flaticon.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/owl.css" rel="stylesheet">

@if(app()->getLocale() == 'ar')
<link href="{{ asset('web') }}/assets/css/bootstrap.rtl.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/switcher-style.rtl.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/style.rtl.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/responsive.rtl.css" rel="stylesheet">
@else
<link href="{{ asset('web') }}/assets/css/bootstrap.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/switcher-style.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/style.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/responsive.css" rel="stylesheet">
@endif

<link href="{{ asset('web') }}/assets/css/jquery.fancybox.min.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/animate.css" rel="stylesheet">
<link href="{{ asset('web') }}/assets/css/color/theme-color.css" id="jssDefault" rel="stylesheet">

</head>


<!-- page wrapper -->
<body class="boxed_wrapper">

    <!-- preloader -->
    <div class="preloader">
        <div class="boxes">
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- preloader end -->


    <!-- main header -->
    <header class="main-header style-one">
        <div class="header-top">
            <div class="auto-container">
                <div class="top-inner clearfix">
                    <ul class="info top-left pull-left">
                        <li><i class="fas fa-phone-volume"></i><a href="tel:{{ Setting::get('Telephone') ??'0146461010'}}">{{ Setting::get('Telephone') ??'0146461010'}}</a></li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:{{Setting::get('Email') ??'Preventionpluse@gmail.com'}}">{{Setting::get('Email') ??'Preventionpluse@gmail.com'}}</a></li>
                    </ul>
                    <ul class="top-right pull-right">
                        <li class="work-time"><i class="fas fa-clock"></i>{{ __('Working Hours - Mon - Fri: 9:30 - 18:30') }}</li>
                        <li class="social-links">
                            <ul class="clearfix">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-upper">
            <div class="auto-container">
                <div class="outer-box clearfix">
                    <div class="logo-box pull-left">
                        <figure class="logo">
                            <a href="/">
                                <img src="{{asset('logo/logo1.png')}}" width="230px" height="100%" alt="BETA BLUS Lab Logo">
                            </a>
                        </figure>
                    </div>
                    <div class="menu-area pull-right">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li><a href="/">{{__('Home')}}</a></li>
                                    <li><a href="#homeVisit">{{__('Home Visit')}}</a></li>
                                    <li><a href="/login/patient">{{__('Patient Results')}}</a></li>
                                    <li><a href="/login/hospital">{{__('hospital Results')}}</a></li>
                                    <li>
                                        <a  href="@if(App::getLocale() == 'en') {{ route('change_language', 'ar')}}@else {{ route('change_language', 'en') }}@endif">
                                            @if(App::getLocale() == 'en')العربية@else English @endif <i class="fa fa-globe" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    {{-- <li class="dropdown"><a href="#" class="">Team</a>
                                        <ul>
                                            <li><a href="team.html">Expert Team</a></li>
                                            <li><a href="team-details.html">Team Details</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>
                        </nav>
                        <div class="btn-box"><a href="/login/employee" class="theme-btn style-one">{{ __('Login') }}</a></div>
                    </div>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="outer-box clearfix">
                    <div class="logo-box pull-left">
                        <figure class="logo">
                            <a href="/">
                                <img src="{{asset('logo/logo1.png')}}" width="160px" alt="BETA BLUS Lab Logo">
                            </a>
                        </figure>
                    </div>
                    <div class="menu-area pull-right">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                        <div class="btn-box"><a href="/login/employee" class="theme-btn style-one">{{ __('Login') }}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>
        
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="/">
                    <img src="{{asset('logo/logo1.png')}}" alt="" title="">
                </a>
            </div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>{{ __('Contact Info') }}</h4>
                <ul>
                    <li>{{Setting::get('AddressArabic') ??'المجمعة : طريق الأمير نايف بن عبدالعزيز'}}</li>
                    <li><a href="tel:{{Setting::get('Telephone') ??'0146461010'}}">{{Setting::get('Telephone') ??'0146461010'}}</a></li>
                    <li><a href="mailto:{{Setting::get('Email') ??'Preventionpluse@gmail.com'}}">{{Setting::get('Email') ??'Preventionpluse@gmail.com'}}</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->




    @yield('content')



    <!-- main-footer -->
    <section class="main-footer">
        <div class="footer-top">
            <div class="pattern-layer" style="background-image: url({{ asset('web') }}/assets/images/shape/shape-5.png);"></div>
            <div class="auto-container">
                <div class="widget-section">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget logo-widget">
                                <figure class="footer-logo">
                                    <a href="/">
                                        <img width="100" src="{{asset('logo/logo1.png')}}" alt="">
                                    </a>
                                </figure>
                                <div class="text">
                                    <p>
                                        {{__('Setting the standard in laboratory medicine for a healthier community.')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h3>{{ __('Usefull Links') }}</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="clearfix">
                                        <li><a href="/">{{__('Home')}}</a></li>
                                        <li><a href="#homeVisit">{{__('Home Visit')}}</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget post-widget">
                                <div class="widget-title">
                                    <h3>Recent Post</h3>
                                </div>
                                <div class="post-inner">
                                    <div class="post">
                                        <figure class="image-box"><a href="blog-details.html"><img src="{{ asset('web') }}/assets/images/resource/post-1.jpg" alt=""></a></figure>
                                        <p><i class="fas fa-calendar-alt"></i>Feb 05, 2020</p>
                                        <h5><a href="blog-details.html">Tests with Nursing Implicat Laboratory Technician</a></h5>
                                    </div>
                                    <div class="post">
                                        <figure class="image-box"><a href="blog-details.html"><img src="{{ asset('web') }}/assets/images/resource/post-2.jpg" alt=""></a></figure>
                                        <p><i class="fas fa-calendar-alt"></i>Feb 06, 2020</p>
                                        <h5><a href="blog-details.html">Equipping Researchers Lab in the Developing.</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h3>{{ __('Login') }}</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="clearfix">
                                        <li><a href="/login/patient">{{__('Login As Patient')}}</a></li>
                                        <li><a href="/login/hospital">{{__('Login As Hospital')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="logo-widget footer-widget">
                                <div class="social-inner">
                                    <h3>{{ __('Follow Us:') }}</h3>
                                    <ul class="social-links clearfix">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom centred">
            <div class="auto-container">
                <div class="copyright">
                    <p>{!! __("Copyright &copy; ") . date("Y") . " <a href='/'>" . (app()->isLocale('ar')? setting('NameArabic'): setting('NameEnglish')) . "</a>." . __(' All rights reserved.') !!} </p>
                </div>
            </div>
        </div>
    </section>
    <!-- main-footer end -->



<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
</button>


<!-- jequery plugins -->
<script src="{{ asset('web') }}/assets/js/jquery.js"></script>
<script src="{{ asset('web') }}/assets/js/popper.min.js"></script>
<script src="{{ asset('web') }}/assets/js/bootstrap.min.js"></script>
@if(app()->getLocale() == 'ar')
<script src="{{ asset('web') }}/assets/js/owl.rtl.js"></script>
@else
<script src="{{ asset('web') }}/assets/js/owl.js"></script>
@endif

<script src="{{ asset('web') }}/assets/js/wow.js"></script>
<script src="{{ asset('web') }}/assets/js/validation.js"></script>
<script src="{{ asset('web') }}/assets/js/jquery.fancybox.js"></script>
<script src="{{ asset('web') }}/assets/js/appear.js"></script>
<script src="{{ asset('web') }}/assets/js/jquery.countTo.js"></script>
<script src="{{ asset('web') }}/assets/js/scrollbar.js"></script>
<script src="{{ asset('web') }}/assets/js/tilt.jquery.js"></script>
<script src="{{ asset('web') }}/assets/js/jQuery.style.switcher.min.js"></script>

<!-- main-js -->
<script src="{{ asset('web') }}/assets/js/script.js"></script>

@stack('scripts')

</body><!-- End of .page_wrapper -->
</html>
