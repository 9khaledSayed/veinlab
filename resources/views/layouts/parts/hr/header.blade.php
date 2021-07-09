
<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

    <button style="display:none" id="play" onclick="soundPLay()" type="button"></button>

    <audio id="sound">
        <source src="{{asset('assets/tunes/tune.mp3')}}" type="audio/mpeg">
    </audio>

    <!-- begin:: Aside -->
    <div class="kt-header__brand kt-grid__item" style="background: white" id="kt_header_brand">
        <div class="kt-header__brand-logo" >
            <a href="/dashboard/hr">
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
                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{route('dashboard.hr.index')}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Dashboard')}}</span></a></li>
                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{route('dashboard.index')}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Lab')}}</span></a></li>
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
      if (Auth::guard('employee')->check())
          {

             $notifictaions =  Auth::guard('employee')->user()->unreadNotifications()->where([
                 ['type' , '!=' , 'App\Notifications\WaitingLabNotification'],
                 ['type' , '!=' , 'App\Notifications\ResultToDoctor']
                 ])->get();

          }
    @endphp
    <!--end: Search -->
    <!--begin: Notifications -->
    <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">

            <span class="kt-header__topbar-icon kt-header__topbar-icon--success"><i class="flaticon2-bell-alarm-symbol"></i>
                @if ($notifictaions->count() != 0)
                <span style="background:red;color:white;font-weight:bold;padding-right:8px;padding-left:8px;margin-bottom:20px;border-radius:25px" id="notif_count_hr">{{$notifictaions->count()}}</span>
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
                            @forelse($notifictaions as $notifictaion)
                            <a href="{{$notifictaion->data['url']}}" onclick="markRead('{{$notifictaion->id}}')" class="kt-notification__item" id="{{$notifictaion->id}}">
                                <div class="kt-notification__item-icon">
                                    <i class="flaticon2-bell-4 kt-font-success"></i>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                       <h4> {{$notifictaion->data['message']}} </h4>
                                    </div>
                                    <div class="kt-notification__item-time">
                                        {{$notifictaion->created_at->diffForHumans()}}
                                    </div>
                                </div>
                            </a>
                            @empty
                            <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                    <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                        <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                           <h3>{{__('no new notifications !')}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!--end: Notifications -->


    @canany(['view_leave_types','view_branches','view_work_shifts','view_holidays','view_users','view_system_settings','view_templates','view_Roles','view_ded_add_types','view_days_off','view_salary_release_day','view_leave_types','view_working_hours','view_allowances_types'])
    <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
            <span class="kt-header__topbar-icon"><i class="flaticon2-gear"></i></span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
            <div class="kt-head kt-head--skin-dark" style="background-image: url({{asset('assets/media/misc/bg-1.jpg')}}">
                <h3 class="kt-head__title">
                    {{__('System Settings')}}

                </h3>
            </div>
            <div class="kt-notification kt-margin-20" data-scroll="true" >
                <div class="row cog-row">
                    @canany(['view_leave_types','view_branches','view_work_shifts','view_holidays'])
                    <div class="col-6">
                        <div class="kt-section">
                            <div class="kt-section__title" style="font-size: 1.1rem;">
                                {{__('Organization Settings')}}
                            </div>
                            <div class="kt-section__content">
                                <ul class="cog-list" style="padding-inline-start: 15px;">
                                    @can('view_company_info')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.settings.company_info')}}">
                                            <i class="fa fa-file"></i>
                                            {{__('Company Info')}}
                                        </a>
                                    </li>
                                    @endcan
                                    @can('view_branches')
                                    <li style="margin-bottom:15px;">
                                    <a href="{{route('dashboard.hr.branches.index')}}" >
                                    <i class="fa fa-location-arrow"></i>
                                    {{__('Branches')}}
                                    </a>
                                    </li>
                                    @endcan
                                    @can('view_work_shifts')
                                    <li style="margin-bottom:15px;">
                                    <a href="{{route('dashboard.hr.settings.shifts')}}" >
                                    <i class="fa fa-clock"></i>
                                    {{__('Shift Times')}}
                                    </a>
                                    </li>
                                    @endcan
                                    @can('view_holidays')
                                    <li style="margin-bottom:15px;">
                                    <a href="{{route('dashboard.hr.holidays.index')}}" >
                                    <i class="fa fa-clock"></i>
                                    {{__('Holidays')}}
                                    </a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>

                        </div>
                    </div>
                    @endcan
                    @canany(['view_users','view_system_settings','view_templates','view_Roles'])
                    <div class="col-6">
                        <div class="kt-section">
                            <div class="kt-section__title" style="font-size: 1.1rem;">
                                {{__('General Settings')}}
                            </div>
                            <div class="kt-section__content">
                                <ul class="cog-list" style="padding-inline-start: 15px;">
                                    @can('view_users')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.employees.index')}}" >
                                            <i class="fa fa-users"></i>
                                            {{__('Users')}}
                                        </a>
                                    </li>
                                    @endcan
                                    @can('view_system_settings')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.settings.index')}}">
                                            <i class="fa fa-cogs"></i>
                                            {{__('System Settings')}}
                                        </a>
                                    </li>
                                    @endcan
                                    @can('view_templates')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.templates.index')}}" >
                                            <i class="fa fa-cogs"></i>
                                            {{__('Templates')}}
                                        </a>
                                    </li>
                                    @endcan
                                    @can('view_Roles')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.roles.index')}}" >
                                            <i class="fa fa-cogs"></i>
                                            {{__('Roles')}}
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endcan
                    @canany(['view_ded_add_types','view_days_off','view_salary_release_day'])
                    <div class="col-6">
                        <!--PAYROLL SETTINGS-->
                        <div class="kt-section">
                            <div class="kt-section__title" style="font-size: 1.1rem;">
                                {{__('Salary Components')}}
                            </div>
                            <div class="kt-section__content">
                                <ul class="cog-list" style="padding-inline-start: 15px;">
                                    @can('view_ded_add_types')
                                    <li class="kt-menu__item " aria-haspopup="true" style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.adds_deds_types.index')}}">
                                            <i class="fa fa-money-bill"></i>
                                            {{__('Deductions \ Additions Types')}}
                                        </a>
                                    </li>
                                    @endcan
                                    @can('view_days_off')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.settings.index')}}" >
                                            <i class="fa fa-clock"></i>
                                            {{__('Number of Days Off')}}
                                        </a>
                                    </li>
                                    @endcan
                                    @can('view_salary_release_day')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.settings.index')}}" >
                                            <i class="fa fa-clock"></i>
                                            {{__('Salary Release Day')}}
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                        <!--END PAYROLL SETTINGS-->
                    </div>
                    @endcan
                    @canany(['view_leave_types','view_working_hours','view_allowances_types'])
                    <div class="col-6">
                        <div class="kt-section">
                            <div class="kt-section__title" style="font-size: 1.1rem;">
                                {{__('Job Settings')}}
                            </div>
                            <div class="kt-section__content">
                                <ul class="cog-list" style="padding-inline-start: 15px;">
                                    @can('view_leave_types')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.vacation_types.index')}}">
                                            <i class="fa fa-sign"></i>
                                            {{__('Leave Types')}}
                                        </a>
                                    </li>
                                    @endcan
                                    @can('view_working_hours')
                                    <li style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.settings.index')}}" >
                                            <i class="fa fa-clock"></i>
                                            {{__('Working Hours')}}
                                        </a>
                                    </li>
                                    @endcan
                                    @can('view_allowances_types')
                                    <li class="kt-menu__item " aria-haspopup="true" style="margin-bottom:15px;">
                                        <a href="{{route('dashboard.hr.allowance_types.index')}}">
                                            <i class="fa fa-money-bill"></i>
                                            {{__('Allowances Types')}}
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; left: -4px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">

                    </div>
                </div>
            </div>

        </div>
    </div>
    @endcan
    <!--begin: Quick actions -->


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


    <script type="text/javascript">

            function markRead(id)
            {

                $.ajax({
                    type:"PUT",
                    url: "/dashboard/hr/notifications/" + id,
                    data:{
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response)
                    {

                        document.getElementById(id).style.display = 'none';

                    },
                    error: function(error)
                    {
                    }

                });
            }






    </script>

@endpush
