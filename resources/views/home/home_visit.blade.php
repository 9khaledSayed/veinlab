@extends('layouts.home')
@section('content')
    @if (\Session::has('success'))
        <button onclick="success()" id="successBtn" style="display:none"></button>
    @endif
    <!-- ##### Welcome Area Start ##### -->
    <div class="breadcumb-area clearfix dzsparallaxer auto-init" data-options='{direction: "normal"}'>
        <!-- breadcumb content -->
        <div class="breadcumb-content">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcumb--con text-center">
                            <h2 class="w-text title wow fadeInUp" data-wow-delay="0.2s">{{__('Home Visit')}}</h2>
                            <ol class="breadcrumb justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                                <li class="breadcrumb-item"><a href="/">{{__('Home')}}    /</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('Home Visit')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Welcome Area End ##### -->
    <section class="section-padding-100 contact_us_area" id="contact">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <!-- Dream Dots -->
                    <h2 class="wow fadeInUp " data-wow-delay="0.3s">{{__('Book Appointment Now')}}!{{__('')}}</h2>
                </div>
            </div>
        </div>
            <!-- Contact Form -->
            <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="contact_form">
                    <form action="/home_visit" method="POST" data-id="home_visit">
                        @csrf
                        <div class="row" style="direction: ltr">
                            <div class="col-12" >
                                <div id="success_fail_info"></div>
                            </div>
                            <div class="col-12 col-md-6" >
                                <div class="group wow fadeInUp" data-wow-delay="0.2s" >
                                    <input type="text" name="name" id="name" required >
                                    @error('name')
                                    <div class="invalid">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>{{__('Name')}}</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group wow fadeInUp" data-wow-delay="0.3s">
                                    <input type="text" name="phone" id="phone" required>
                                    @error('phone')
                                        <div class="invalid">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>{{__('Phone')}}</label>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="group wow fadeInUp" data-wow-delay="0.3s">
                                    <input type="text" name="email" id="email" required>
                                    @error('email')
                                    <div class="invalid">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>{{__('Email')}}</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group wow fadeInUp" data-wow-delay="0.3s">
                                    <input type="text" name="address" id="address" required>
                                    @error('address')
                                    <div class="invalid">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>{{__('Address')}}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group wow fadeInUp" data-wow-delay="0.3s">
                                    <select class="form-control" name="sex"  id="sex" required>
                                        <option value="" selected disabled>{{__('Gender')}}</option>
                                        <option value="0">{{__('Male')}}</option>
                                        <option value="1">{{__('Female')}}</option>
                                    </select>
                                    @error('sex')
                                    <div class="invalid">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="group wow fadeInUp" data-wow-delay="0.3s">
                                    <input type="text" placeholder="{{__('Choose Date')}}"  name="date" class="hijri-date-input" />
                                    @error('date')
                                    <div class="invalid">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="group wow fadeInUp" data-wow-delay="0.3s">
                                    <input type="time" name="time" />
                                    @error('time')
                                    <div class="invalid">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                </div>
                            </div>

                            <div class="col-12 text-center wow fadeInUp mt-2" data-wow-delay="0.6s">
                                <button type="submit"  class="btn dream-btn">{{__('Send')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
        if (document.getElementById("successBtn") != null ){
            document.getElementById("successBtn").click();
        }


        function success() {
            setTimeout(function() {
                swal("تــم الأرســال"
                    , "سـوف يـتم الـرد علـيك فـي أقرب وقـت"
                    , "success"
                ).then(function() {
                    window.location.href = '/';
                });
            }, 1000);
        }

    </script>



    <script src="{{asset('calendar/js/momentjs.js')}}"></script>
    <script src="{{asset('calendar/js/moment-with-locales.js')}}"></script>
    <script src="{{asset('calendar/js/moment-hijri.js')}}"></script>
    <script src="{{asset('calendar/js/bootstrap-hijri-datetimepicker.js')}}"></script>

    <script type="text/javascript">


        $(function () {

            initHijrDatePicker();

            //initHijrDatePickerDefault();

            $('.disable-date').hijriDatePicker({

                minDate:"2020-01-01",
                maxDate:"2021-01-01",
                viewMode:"years",
                hijri:true,
                debug:true
            });

        });

        function initHijrDatePicker() {

            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "DD-MM-YYYY",
                hijriFormat:"iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                showSwitcher: true,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode:'months',
                keepOpen: false,
                hijri: false,
                debug: true,
                showClear: true,
                showTodayButton: true,
                showClose: true
            });
        }

        function initHijrDatePickerDefault() {

            $(".hijri-date-input").hijriDatePicker();
        }


    </script>


@endpush
@push('scripts')
    <script>
        $(function (){
            var $window = $(window);
            let nav_link = $('.dark.classy-nav-container a, .phone');
            if ($window.scrollTop() < 0) {
                nav_link.css('color', 'white');
            }

            $window.on('scroll', function () {
                if ($window.scrollTop() > 0) {
                    nav_link.css('color', 'black');
                } else {
                    nav_link.css('color', 'white');
                }
            });
        });
    </script>
@endpush
