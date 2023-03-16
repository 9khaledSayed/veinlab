
<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

    <button style="display:none" id="playBtn" onclick="soundPLay()" type="button"></button>

    <audio controls id="sound" style="display: none">
        <source src="{{asset('assets/tunes/tune.mp3')}}" type="audio/ogg">
        <source src="{{asset('assets/tunes/tune.mp3')}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>


    <!-- begin:: Aside -->
    <div class="kt-header__brand kt-grid__item" style="background: white" id="kt_header_brand">
        <div class="kt-header__brand-logo" >
            <a href="/dashboard">
                <img alt="Logo" style="padding: 5px" src="{{asset(Setting::get('logo_path'))}}" height="80px"/>
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Title -->
    <h3 class="kt-header__title kt-grid__item">
        {{app()->isLocale('ar')? setting('NameArabic'): setting('NameEnglish')}}
    </h3>

    <!-- end:: Title -->

    <!-- begin: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav ">
                @if(Auth::guard('employee')->check())
{{--                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{route('dashboard.index')}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Dashboard')}}</span></a></li>--}}
                    <li class="kt-menu__item kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">{{__('Hi! ') . explode(' ',auth()->user()->fullname())[0]}}</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="{{route('dashboard.myProfile.account_info')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-user"></i><span class="kt-menu__link-text">{{__('My Profile')}}</span></a></li>
                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a onclick="document.getElementById('logout-form').submit();" href="javascript:" class="kt-menu__link "><i class="kt-menu__link-icon fas fa-sign-out-alt"></i><span class="kt-menu__link-text">{{__('Log Out')}}</span></a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </li>
                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{route('dashboard.hr.index')}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('HR Management')}}</span></a></li>
                @else
                    <li class="kt-menu__item kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">{{__('Hi! ') . explode(' ',auth()->user()->name)[0]}}</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a onclick="document.getElementById('logout-form').submit();" href="javascript:" class="kt-menu__link "><i class="kt-menu__link-icon fas fa-sign-out-alt"></i><span class="kt-menu__link-text">{{__('Log Out')}}</span></a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- end: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">


    <!--end: Search -->
        @if (auth()->guard('employee')->check() || auth()->guard('patient')->check())
        <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown">

            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon kt-header__topbar-icon--success" id="notification-bell"><i class="flaticon2-bell-alarm-symbol"></i>
                   @if(\App\Notification::authNotifications()->count() > 0)
                        <span style="background:red;color:white;font-weight:bold;padding-right:8px;padding-left:8px;margin-bottom:20px;border-radius:25px" id="notification-counter">{{\App\Notification::authNotifications()->count()}}</span>
                    @endif
                </span>
                <span class="kt-hidden kt-badge kt-badge--danger"></span>
            </div>

            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                <div class="kt-head kt-head--skin-dark" style="background-image: url({{asset('assets/media/misc/bg-1.jpg')}}">
                    <h3 class="kt-head__title font-weight-bold">
                        {{__('Notifications')}}

                    </h3>
                </div>
                    <!--end: Head -->
                    <div class="tab-content">
                        <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                            <div id="notification_body" class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                @foreach(\App\Notification::authNotifications() as $notification)
                                <a href="{{route('dashboard.notifications.mark_as_read', $notification->id)}}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="{{$notification->data['icon']}} kt-font-{{$notification->data['class']}}"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            <h6>  {{$notification->data['title']}} </h6>
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{$notification->created_at->diffForHumans()}}
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                            <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                    <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                        All caught up!
                                        <br>No new notifications.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!--end: Notifications -->
        @endif

    <!--begin: Quick actions -->
        @can('view_sittings')
            @include('layouts.parts.settings')
        @endcan
    <!--end: Quick actions -->


        <!--begin: Language bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon kt-header__topbar-icon--brand">
                    @if(App::isLocale('en'))
                        <img class="" src="{{asset('assets/flags/united-states.svg')}}" alt="english" />
                    @else
                        <img class="" src="{{asset('assets/flags/saudi-arabia.svg')}}" alt="arabic" />
                    @endif
                </span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    @if(App::isLocale('en'))
                        <li class="kt-nav__item kt-nav__item--active">
                            <a href="{{route('change_language', 'ar')}}" class="kt-nav__link">
                                <span class="kt-nav__link-icon"><img src="{{asset('assets/flags/saudi-arabia.svg')}}" alt="" /></span>
                                <span class="kt-nav__link-text">Arabic</span>
                            </a>
                        </li>
                    @else
                        <li class="kt-nav__item">
                            <a href="{{route('change_language', 'en')}}" class="kt-nav__link">
                                <span class="kt-nav__link-icon"><img src="{{asset('assets/flags/united-states.svg')}}" alt="" /></span>
                                <span class="kt-nav__link-text">English</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!--end: Language bar -->

        <!--end: Quick panel toggler -->
    </div>

    <!-- end:: Header Topbar -->
</div>

<!-- end:: Header -->