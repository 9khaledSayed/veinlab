<!-- ##### Header Area Start ##### -->
<header class="header-area fadeInDown" data-wow-delay="0.2s">
    <div class="classy-nav-container  breakpoint-off">
        <div class="container">
            <!-- Classy Menu -->
            <nav class="classy-navbar light justify-content-between" id="dreamNav">
                <h1 class="nav-brand light phone" href="#" style="max-height: 50px; overflow: hidden;">{{ Setting::get('Telephone') ??'0146461010'}} <i class="fa fa-phone"></i></h1>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler demo">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">

                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul id="nav">
                            <li>
                                <a href="/">{{__('Home')}}</a>
                            </li>
                            <li>
                                <a href="/home_visit">{{__('Home Visit')}}</a>
                            </li>
                            <li>
                                <a href="/login/patient">{{__('Patient Results')}}</a>
                            </li>
                            <li>
                                <a href="/login/hospital">{{__('hospital Results')}}</a>
                            </li>
                            <li>
                                <a  href="@if(App::getLocale() == 'en') {{ route('change_language', 'ar')}}@else {{ route('change_language', 'en') }}@endif">
                                    @if(App::getLocale() == 'en')العربية@else English @endif <i class="fa fa-globe" aria-hidden="true"></i>
                                </a>
                            </li>

                        </ul>
                        <ul id="nav">
                        <li>
                            <a href="#home" class="btn login-btn ml-50">{{__('Log in')}}</a>
                            <ul class="dropdown drop">
                                <li><a style="color: #fff;font-size: 14px;" href="login/patient">{{__('Login As Patient')}}</a></li>
                                <li><a style="color: #fff;font-size: 14px;" href="login/hospital">{{__('Login As Hospital')}}</a></li>
                            </ul>
                        </li>
                        </ul>
                        <!-- Button -->

                    </div>
                    <!-- Nav End -->
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->
