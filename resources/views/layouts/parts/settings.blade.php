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
                    <div class="col-6">
                        <div class="kt-section">
                            <div class="kt-section__title" style="font-size: 1.1rem;">
                                {{__('General Settings ( LAB )')}}
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
                    @canany(['view_users','view_system_settings','view_templates','view_Roles'])
                        <div class="col-6">
                            <div class="kt-section">
                                <div class="kt-section__title" style="font-size: 1.1rem;">
                                    {{__('General Settings ( HR )')}}
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
                    <div class="col-6">
                        <div class="kt-section">
                            <div class="kt-section__title" style="font-size: 1.1rem;">
                                {{__('System Settings')}}
                            </div>
                            <div class="kt-section__content">
                                <ul class="cog-list" style="padding-inline-start: 15px;">
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