<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div  class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid"   id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav" >
                <li  class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a href="{{route('dashboard.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon  flaticon-squares"></i><span class="kt-menu__link-text">{{__('Dashboard')}}</span></a></li>
                @canany(['view_roles', 'show_roles'])
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  flaticon-eye"></i><span class="kt-menu__link-text">{{__('Roles')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('view_roles')
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.roles.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Roles')}}</span></a></li>
                                @endcan
                                @can('create_roles')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.roles.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Role')}}</span></a></li>

                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.roles.assigned_employees')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Assigned Employees')}}</span></a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                @canany(['view_patients', 'show_patients'])
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-user-injured"></i><span class="kt-menu__link-text">{{__('Patients')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('view_patients')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.patients.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Patients')}}</span></a></li>
                                @endcan
                                @can('create_patients')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.patients.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Register New Account')}}</span></a></li>
{{--                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.patients.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Account With Invoice')}}</span></a></li>--}}
                                @endcan
                                @can('create_patients')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.waiting_labs.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Existing Account')}}</span></a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                @canany(['view_home_visits', 'show_home_visits'])
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  flaticon2-protection"></i><span class="kt-menu__link-text">{{__('Home Visits')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('view_home_visits')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.home_visits.index')}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Home Visits')}}</span></a></li>
                                @endcan
                                @can('create_home_visits')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.home_visits.create')}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Add Home Visit')}}</span></a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                @canany(['view_doctors', 'show_doctors','view_hospitals', 'show_hospitals','view_companies', 'show_companies'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-user-nurse"></i><span class="kt-menu__link-text">{{__('Transfer Destination')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @canany(['view_doctors', 'show_doctors'])
                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-user-nurse"></i><span class="kt-menu__link-text">{{__('Doctors')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            @can('view_doctors')
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.doctors.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Doctors')}}</span></a></li>
                                            @endcan
                                            @can('create_doctors')
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.doctors.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Doctor')}}</span></a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>
                            @endcan
                            @canany(['view_hospitals', 'show_hospitals'])
                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-hospital"></i><span class="kt-menu__link-text">{{__('Hospitals')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            @can('view_hospitals')
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hospitals.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Hospitals')}}</span></a></li>
                                            @endcan
                                            @can('create_hospitals')
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hospitals.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Hospitals')}}</span></a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>
                            @endcan
                            @canany(['view_companies', 'show_companies'])
                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fas fa-building"></i><span class="kt-menu__link-text">{{__('Insurance Companies')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            @can('view_companies')
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.companies.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Companies')}}</span></a></li>
                                            @endcan
                                            @can('create_companies')
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.companies.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Companies')}}</span></a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                @can('view_waiting_labs')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  flaticon2-list-1"></i><span class="kt-menu__link-text">{{__('Waiting Labs')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.waiting_labs.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Waiting Labs')}}</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.waiting_labs.archives')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Archives')}}</span></a></li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @canany(['view_main_analysis', 'show_main_analysis'])
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  flaticon2-layers"></i><span class="kt-menu__link-text">{{__('Main Analysis')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('view_main_analysis')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.main_analysis.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Analysis')}}</span></a></li>
                                @endcan
                                @can('create_main_analysis')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.main_analysis.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Analysis')}}</span></a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @canany(['view_sub_analysis', 'show_sub_analysis'])
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-archive"></i><span class="kt-menu__link-text">{{__('Sub Analysis')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('view_sub_analysis')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.sub_analysis.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Analysis')}}</span></a></li>
                                @endcan
                                @can('create_sub_analysis')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.sub_analysis.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Analysis')}}</span></a></li>
                                    {{--                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.normal_ranges.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Normal Range')}}</span></a></li>--}}
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @canany(['view_packages', 'show_packages'])
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-boxes"></i><span class="kt-menu__link-text">{{__('Packages')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('view_packages')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.packages.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Packages')}}</span></a></li>
                                @endcan
                                @can('create_packages')
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.packages.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Package')}}</span></a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan


                @can('view_results')
                <li class="kt-menu__item  kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="{{Route('dashboard.results.index')}}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-clipboard-check"></i><span class="kt-menu__link-text">{{__('All Results')}}</span></a></li>
                @endcan

                @can('view_invoices')
                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.invoices.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon  fas fa-file-invoice"></i><span class="kt-menu__link-text">{{__('Invoices')}}</span></a></li>
                @endcan
                @can(['create_exports','create_revenue','view_reports', 'view_statistics'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-file-invoice-dollar"></i><span class="kt-menu__link-text">{{__('Vouchers')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('create_exports')
                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-file-invoice-dollar"></i><span class="kt-menu__link-text">{{__('Payment voucher')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hospitals.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Hospitals')}}</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.doctors.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Doctors')}}</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.exports.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Others')}}</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endcan
                            @can('create_revenue')
                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon   fas fa-receipt"></i><span class="kt-menu__link-text">{{__('Receipt voucher')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.companies.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Insurance Company')}}</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endcan
                            @can('view_reports')
                                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon  fa fa-file-alt"></i><span class="kt-menu__link-text">{{__('Reports')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hospitals.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Hospitals')}}</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.doctors.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Doctors')}}</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.main_analysis.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Analysis')}}</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.companies.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Companies')}}</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.reports.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Overall Report')}}</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endcan
                            @can('view_statistics')
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.statistics.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon  flaticon-statistics"></i><span class="kt-menu__link-text">{{__('Statistics')}}</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                @can('view_exports')
                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.exports.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon far  fa-money-bill-alt"></i><span class="kt-menu__link-text">{{__('Exports')}}</span></a></li>
                @endcan
                @can('view_revenue')
                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.revenue.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon  fas fa-money-bill-alt"></i><span class="kt-menu__link-text">{{__('Imports')}}</span></a></li>
                @endcan

                @can('view_profits')
                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.profits.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon  flaticon-coins"></i><span class="kt-menu__link-text">{{__('Profits')}}</span></a></li>
                @endcan


{{--                @can('view_sittings')--}}
{{--                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.settings.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon  flaticon2-settings"></i><span class="kt-menu__link-text">{{__('Settings')}}</span></a></li>--}}
{{--                @endcan--}}

                <li class="kt-menu__item " aria-haspopup="true"><a onclick="document.getElementById('logout-form').submit();" href="javascript:" class="kt-menu__link "><i class="kt-menu__link-icon  fas fa-sign-out-alt"></i><span class="kt-menu__link-text">{{__('Log Out')}}</span></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->
