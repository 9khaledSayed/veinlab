
<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

    <button style="display:none" id="playBtn" onclick="soundPLay()" type="button"></button>

    @if(Auth::guard('employee')->check() && auth()->user()->roles->first()->name() == 'Lab')
    <audio id="sound">
        <source src="{{asset('assets/tunes/tune.mp3')}}" type="audio/mpeg">
    </audio>

    @elseif (Auth::guard('employee')->check())

    <audio id="sound">
        <source src="{{asset('assets/tunes/tune.mp3')}}" type="audio/mpeg">
    </audio>
    @endif

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
        {{__('Vein')}}
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
                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a class="kt-menu__link " onclick="document.getElementById('logout-form').submit();" href="javascript:" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Log Out')}}</span></a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            </ul>
        </div>
    </div>

    <!-- end: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">


    @php
      if (Auth::guard('employee')->check() &&  (auth()->user()->is_master != 1))
          {

             $type = 0;

             if ( auth()->user()->abilities()->contains("doctor_notifications") ){
                 $notifictaions =  App\Employee::find(1)->unreadNotifications()->where('type','App\Notifications\ResultToDoctor')->get();
             }elseif (auth()->user()->abilities()->contains("waiting_lab_notifications")){
                 $notifictaions =  App\Employee::find(1)->unreadNotifications()->where('type','App\Notifications\WaitingLabNotification')->get();
             }elseif (auth()->user()->abilities()->contains("create_patients") ){
                     $notifictaions =  App\Employee::find(1)->unreadNotifications()->where('type','App\Notifications\HomeVisitNotification')->get();
             }

          }elseif (Auth::guard('patient')->check())
          {
             $type = 1;
             $notifictaions =  auth()->user()->unreadNotifications->where('notifiable_type','App\Patient');
          }else
          {
             $type = 3;
          }
    @endphp


    <!--end: Search -->
        @if ($type != 3)
        <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown">

            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon kt-header__topbar-icon--success"><i class="flaticon2-bell-alarm-symbol"></i> <span style="background:red;color:white;font-weight:bold;padding-right:8px;padding-left:8px;margin-bottom:20px;border-radius:25px" id="notif_count">{{$notifictaions->count()}}</span></span>
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
                                @foreach($notifictaions as $notifictaion)
                                <a href="{{$notifictaion->data['url']}}" onclick="markRead('{{$notifictaion->id}}' , '{{$type}}')" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-bell-4 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            <h4>  {{$notifictaion->data['message']}} </h4>
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{$notifictaion->created_at->diffForHumans()}}
                                        </div>
                                    </div>
                                </a>

{{--                                @empty--}}

{{--                                        <div class="kt-notification__item-details" style="text-align:center;margin-top:35%">--}}
{{--                                        <h3>no new notifications</h3>--}}
{{--                                        </div>--}}

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
            <div class="kt-header__topbar-item dropdown">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
                    <span class="kt-header__topbar-icon"><i class="flaticon2-gear"></i></span>
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                    <div class="kt-head kt-head--skin-dark" style="background-image: url({{asset('assets/media/misc/bg-1.jpg')}}">
                        <h3 class="kt-head__title">
                            {{__('Settings')}}
                        </h3>
                    </div>
                    <div class="kt-notification kt-margin-20" data-scroll="true" >
                        <div class="row cog-row">
                            <div class="col-6">
                                <div class="kt-section">
                                    <div class="kt-section__title" style="font-size: 1.1rem;">
                                        {{__('General Settings')}}
                                    </div>
                                    <div class="kt-section__content">
                                        <ul class="cog-list" style="padding-inline-start: 15px;">
                                            @canany(['view_promo_codes', 'show_promo_codes', 'create_promo_codes', 'update_promo_codes', 'delete_promo_codes'])
                                                <li style="margin-bottom:15px;">
                                                    <a href="{{route('dashboard.promo_codes.index')}}" >
                                                        <i class="kt-menu__link-icon  fa fa-barcode"></i>
                                                        {{__('Promo Codes')}}
                                                    </a>
                                                </li>
                                            @endcan
                                            <li style="margin-bottom:15px;">
                                                <a href="{{route('dashboard.nationalities.index')}}" >
                                                    <i class="kt-menu__link-icon  fa fa-flag"></i>
                                                    {{__('Nationalities')}}
                                                </a>
                                            </li>
                                            <li style="margin-bottom:15px;">
                                                <a href="{{route('dashboard.templates.index')}}" >
                                                    <i class="kt-menu__link-icon  fa fa-flag"></i>
                                                    {{__('Templates')}}
                                                </a>
                                            </li>
                                            <li style="margin-bottom:15px;">
                                                <a href="{{route('dashboard.settings.offers')}}" >
                                                    <i class="fa fa-cogs"></i>
                                                    {{__('Offers')}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="kt-section">
                                    <div class="kt-section__title" style="font-size: 1.1rem;">
                                        {{__('System Settings')}}
                                    </div>
                                    <div class="kt-section__content">
                                        <ul class="cog-list" style="padding-inline-start: 15px;">
{{--                                            @can('view_sittings')--}}
{{--                                                <li style="margin-bottom:15px;">--}}
{{--                                                    <a href="{{route('dashboard.settings.index')}}" >--}}
{{--                                                        <i class="kt-menu__link-icon  flaticon2-settings"></i>--}}
{{--                                                        {{__('General Settings')}}--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            @endcan--}}
                                            <li style="margin-bottom:15px;">
                                                <a href="{{route('dashboard.settings.language')}}">
                                                    <i class="fa fa-cogs"></i>
                                                    {{__('Language')}}
                                                </a>
                                            </li>
                                            <li style="margin-bottom:15px;">
                                                <a href="{{route('dashboard.settings.tax')}}" >
                                                    <i class="fa fa-cogs"></i>
                                                    {{__('Tax')}}
                                                </a>
                                            </li>
                                            <li style="margin-bottom:15px;">
                                                <a href="{{route('dashboard.settings.index')}}" >
                                                    <i class="fa fa-cogs"></i>
                                                    {{__('Home Visit Fees')}}
                                                </a>
                                            </li>

                                            <li style="margin-bottom:15px;">
                                                <a href="{{route('dashboard.settings.critical')}}" >
                                                    <i class="fa fa-cogs"></i>
                                                    {{__('Critical fields')}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; left: -4px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                </div>
            </div>


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

@push('scripts')
{{--    <script type="text/javascript">--}}
{{--        function markRead(id,type)--}}
{{--        {--}}
{{--            $.ajax({--}}
{{--                type:"PUT",--}}
{{--                url: "/Notifications/WaitingLab/" + id,--}}
{{--                data:{--}}
{{--                    "_token": "{{ csrf_token() }}",--}}
{{--                    "type":type--}}
{{--                },--}}
{{--                success: function(response)--}}
{{--                {--}}
{{--                },--}}
{{--                error: function(error)--}}
{{--                {--}}
{{--                }--}}

{{--            });--}}
{{--        }--}}

{{--            @auth('employee')--}}

{{--            var notification_body  = document.getElementById('notification_body');--}}
{{--            var notification_count = document.getElementById('notif_count');--}}
{{--            var hasAbility = {{auth()->user()->abilities()->contains("doctor_notifications") || auth()->user()->abilities()->contains("waiting_lab_notifications") || auth()->user()->abilities()->contains("create_patients")}}--}}
{{--            if(hasAbility){--}}
{{--                setInterval(function() {--}}
{{--                    $.ajax({--}}
{{--                        type:"GET",--}}
{{--                        url: "/Notifications/WaitingLab/",--}}

{{--                        success: function(response)--}}
{{--                        {--}}


{{--                                if (notification_count.style.visibility = 'hidden' && notification_count.innerHTML != 0)--}}
{{--                                {--}}
{{--                                    notification_count.style.visibility = 'visible';--}}
{{--                                }--}}


{{--                            for(var i = 0; i < response.length; i++) {--}}

{{--                                var notificationRow =--}}
{{--                                    '   <a href="' + response[i].data['url'] + '" onclick="markRead(' + response[i].id + ',' + ' 0)" class="kt-notification__item">\n' +--}}
{{--                                    '      <div class="kt-notification__item-icon">\n' +--}}
{{--                                    '      <i class="flaticon2-bell-alarm-symbol"></i>\n' +--}}
{{--                                    '      </div>\n' +--}}
{{--                                    '           <div class="kt-notification__item-details">\n' +--}}
{{--                                    '               <div class="kt-notification__item-title">\n' +--}}
{{--                                    '<h4>' +--}}
{{--                                    response[i].data['message'] +--}}
{{--                                    '</h4>' +--}}
{{--                                    '               </div>\n' +--}}
{{--                                    '           <div class="kt-notification__item-time">\n' +--}}
{{--                                    '                        منذ قليل' +--}}
{{--                                    '      </div>\n' +--}}
{{--                                    '      </div>\n' +--}}
{{--                                    '   </a>';--}}


{{--                                if (notification_body)--}}
{{--                                {--}}
{{--                                    if (notification_body.childElementCount < response.length + 2)--}}
{{--                                    {--}}
{{--                                        notification_count.innerHTML = parseInt(notification_count.innerHTML) + 1;--}}
{{--                                        notification_body.insertAdjacentHTML("afterbegin", notificationRow);--}}
{{--                                        $('#playBtn').click();--}}
{{--                                    }--}}
{{--                                }--}}

{{--                            }--}}

{{--                        },--}}

{{--                        error: function(error)--}}
{{--                        {--}}
{{--                            console.log(error);--}}
{{--                        }--}}


{{--                    });--}}


{{--                }, 1000 * 60 * 0.1);--}}
{{--            }--}}
{{--        function soundPLay()--}}
{{--        {--}}

{{--            $('#sound')[0].play();--}}

{{--        }--}}
{{--        if( notification_count.innerText == 0)--}}
{{--        {--}}
{{--            notification_count.style.visibility = 'hidden';--}}
{{--        }--}}
{{--        @endauth--}}

{{--    </script>--}}

@endpush
