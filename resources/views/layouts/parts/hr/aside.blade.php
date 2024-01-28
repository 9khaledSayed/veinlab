<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div  class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid"   id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav" >
                <li  class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a href="{{route('dashboard.hr.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon  flaticon-squares"></i><span class="kt-menu__link-text">{{__('Dashboard')}}</span></a></li>
                @canany(['view_employees', 'create_employees', 'show_employees', 'Update_employees'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-users-1"></i><span class="kt-menu__link-text">{{__('Employees')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('view_employees')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.employees.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Employees')}}</span></a></li>
                            @endcan
                            @can('create_employees')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.employees.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('New Employees')}}</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
                @canany(['salary_induction','vacation_request','Ask_for_permission','Request_a_trip','Debt_Request','Request_a_complaint'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-website"></i><span class="kt-menu__link-text">{{__('Employees Services')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('salary_induction')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.salary_induction.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Salary Induction')}}</span></a></li>
                            @endcan
                            @can('vacation_request')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.vacation.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('A vacation request')}}</span></a></li>
                            @endcan
                            @can('Ask_for_permission')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.permission.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Ask for permission')}}</span></a></li>
                            @endcan
                            @can('Request_a_trip')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.trip.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Request a trip')}}</span></a></li>
                            @endcan
                            @can('Debt_Request')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.debt.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Debt Request')}}</span></a></li>
                            @endcan
                            @can('Request_a_complaint')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.complaint.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Request a complaint')}}</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
                @canany(['view_my_requests', 'view_pending_requests', 'view_employees_requests'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-layers"></i><span class="kt-menu__link-text">{{__('Requests')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('view_my_requests')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="/dashboard/hr/requests/mine" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('My requests')}}</span></a></li>
                            @endcan
                            @can('view_pending_requests')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="/dashboard/hr/requests/pending" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Pending requests')}}</span></a></li>
                            @endcan
                            @can('view_employees_requests')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="/dashboard/hr/requests/finished" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Employees requests')}}</span></a></li>
                            @endcan
                           </ul>
                    </div>
                </li>
                @endcan
                @canany(['view_my_vacations', 'create_vacations', 'view_employees_vacations', 'view_vacations_Balances'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fas fa-umbrella"></i><span class="kt-menu__link-text">{{__('Vacations')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('view_my_vacations')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="/dashboard/hr/vacations/mine" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('My vacations')}}</span></a></li>
                            @endcan
                            @can('create_vacations')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="/dashboard/hr/vacations/create" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Give A Vacation')}}</span></a></li>
                            @endcan
                            @can('view_employees_vacations')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="/dashboard/hr/vacations" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Employees vacations')}}</span></a></li>
                            @endcan
                            @can('view_vacations_Balances')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="/dashboard/hr/vacations/balances" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('vacations Balances')}}</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
                @canany(['view_all_salaries', 'view_my_salaries', 'view_pending_reports', 'view_deductions','view_additions', 'view_loans'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fas fa-comment-dollar"></i><span class="kt-menu__link-text reportCount">{{__('Salaries')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('view_all_salaries')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.salary_reports.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Salaries')}}</span></a></li>
                            @endcan
                            @can('view_my_salaries')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.salaries.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('My Salaries')}}</span></a></li>
                            @endcan
                            @can('view_pending_reports')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.salary_reports.pending')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text reportCount">{{__('Pending Reports')}} </span></a></li>
                            @endcan
                            @can('view_deductions')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.deductions.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Salary Deductions')}}</span></a></li>
                            @endcan
                            @can('view_additions')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.additions.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Salary Additions')}}</span></a></li>
                            @endcan
                            @can('view_loans')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.loans.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Loan / Debt')}}</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
                @canany(['view_terminated_employees', 'view_suspended_salaries','view_my_decisions', 'view_all_decisions'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-poll-symbol"></i><span class="kt-menu__link-text">{{__('Decisions')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('view_terminated_employees')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.decisions.terminated_employees')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('End Service')}}</span></a></li>
                            @endcan
                            @can('view_suspended_salaries')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.decisions.suspended_employees')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Suspend Salary')}}</span></a></li>
                            @endcan
                            @can('view_my_decisions')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.decisions.my_decisions')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('My Decisions')}}</span></a></li>
                            @endcan
                            @can('view_all_decisions')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.decisions.all_decisions')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Decisions')}}</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
                @canany(['view_check_in_page', 'view_attendance_sheet','view_my_attendance'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-event-calendar-symbol"></i><span class="kt-menu__link-text">{{__('Attendance')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('view_check_in_page')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.attendance.create')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Check-in Online')}}</span></a></li>
                            @endcan
                            @can('view_attendance_sheet')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.attendance.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('Attendance Sheet')}}</span></a></li>
                            @endcan
                            @can('view_my_attendance')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.attendance.my_attendance')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('My Attendance')}}</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
                @canany(['view_all_memos', 'view_my_memos'])
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-file-alt"></i><span class="kt-menu__link-text">{{__('Memos')}}</span><i class="kt-menu__ver-arrow la la-angle-right" ></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            @can('view_all_memos')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.memos.index')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('All Memos')}}</span></a></li>
                            @endcan
                            @can('view_my_memos')
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.hr.memos.mine')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">{{__('My Memos')}}</span></a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
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
@push('scripts')
    <Script>
        $(function (){
            @canany(['view_all_salaries', 'view_pending_reports'])
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "get",
                    url: "/dashboard/hr/salary_reports/pending",
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                        };
                    },
                    success:function(data){
                        if(data.length > 0){
                            $(".reportCount").append('<span class="kt-badge kt-badge--rounded kt-badge--brand mx-auto" style="" >' + data.length + '</span>')
                        }

                    }
                });
            @endcan
        })
    </Script>
@endpush
