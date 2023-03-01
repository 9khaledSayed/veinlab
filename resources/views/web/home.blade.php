@extends('web.layouts.app')
@section('content')
    @if (\Session::has('success'))
        <button onclick="success()" id="successBtn" style="display:none"></button>
    @endif

    <!-- banner-section -->
    <section class="banner-section">
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none owl-nav-none">
            <div class="slide-item">
                <div class="image-layer" style="background-image:url({{ asset('home_assets/img/bg-img/header2en.jpg') }})"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h5>{{__('Welcome To Beta Blus Lab Laboratories')}}</h5>
                        <h3>
                            {{__('Setting the standard in laboratory medicine for a healthier community.')}}
                        </h3>
                        <div class="btn-box mt-4">
                            <a href="#about" class="theme-btn style-two">{{__('More...')}}</a>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <!-- banner-section end -->

    <!-- about-section -->
    <section class="about-section" id="about">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div id="image_block_01">
                        <div class="image-box">
                            <div class="pattern-layer" style="background-image: url({{ asset('web/assets/images/shape/shape-1.png') }});"></div>
                            <figure class="image"><img src="{{ asset('home_assets/img/core-img/about2.jpeg') }}" alt=""></figure>
                            <div class="icon-holder">
                                <div class="icon-box"><i class="flaticon-lab"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div id="content_block_01">
                        <div class="content-box">
                            <div class="sec-title left">
                                <p>{{__('About Us')}}</p>
                                <h2>{{ __('At BETA BLUS Laboratories') }}</h2>
                                <span class="separator"></span>
                            </div>
                            <div class="text">
                                <p>
                                    {{__('At the heart of our mission of delivering high-quality services ... BETA BLUS Laboratories in the Al Jowf region, specifically the Department of mojamaa, established the nature of the organization\'s work not only when it presented its medical data through a visit to its headquarters, but also the establishment of a wide network of governmental and private cooperatives ,BETA BLUS Laboratories are designed to become the leading medical laboratory for excellence in medical analysis in the Middle East by providing all medical services according to the highest international standards.')}}
                                </p>
                            </div>
                            <div class="inner-box">
                                <div class="single-item">
                                    <div class="count-box"><span><i class="flaticon-laboratory"></i></span></div>
                                    <div class="inner">
                                        <h3><a href="#">{{__('Our Mission')}}</a></h3>
                                        <p>
                                            {{__('Provide all medical analysis to all members of the community with accuracy and speed, providing the latest technology in medical analysis and employing the highest quality medical and administrative working skills to maintain and provide quality services in every honesty.')}}
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="single-item">
                                    <div class="count-box"><span>02</span></div>
                                    <div class="inner">
                                        <h3><a href="index.html">Clinical & Medical Laboratory</a></h3>
                                        <p>Conducts lab tests ordered by doctors. Working with laboratory machines as we examine human tissue samples & diagnose</p>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="count-box"><span>03</span></div>
                                    <div class="inner">
                                        <h3><a href="index.html">Analytical & Quality Laboratory</a></h3>
                                        <p>The Various techniques that we are used to identifying the chemical makeup and characteristics of a particular samples</p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->

    <!-- service-section -->
    <section class="service-section bg-color-1 centred">
        <div class="pattern-layer" style="background-image: url({{ asset('web/assets/images/shape/shape-2.png') }});"></div>
        <div class="auto-container">
            <div class="sec-title">
                <p class="">{{__('BETA BLUS Lab Laboratories provide the following services')}}</p>
                <h2 class="mb-2">{{__('Our Services')}}</h2>
                <span class="separator"></span>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="/login/patient">
                                    <img src="{{asset('home_assets/img/health_1.png')}}" alt=""style="height:250px;">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <h3><a href="/login/patient">{{__('Customers')}}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="/home_visit">
                                    <img src="{{asset('home_assets/img/home_v.jpg')}}" alt=""style="height:250px;">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <h3>
                                    <a href="/home_visit">{{__('Home Visit')}}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <a href="/login/hospital">
                                    <img src="{{asset('home_assets/img/doctors.jpg')}}" alt=""style="height:250px;">
                                </a>
                            </figure>
                            <div class="lower-content">
                                <h3><a href="/login/hospital">{{__('Medical centers')}}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-section end -->

    <!-- technology-section -->
    <section class="technology-section py-3">
        <div class="pattern-layer" style="background-image: url({{ asset('web/assets/images/shape/shape-4.png') }});width:100%;height:100%;background-repeat: repeat;"></div>
        <div class="auto-container">
            <div class="sec-title">
                <h2 class="mb-2">{{__('Our Offers')}}</h2>
                <span class="separator"></span>
            </div>
            <div class="row clearfix">
                @forelse ($packages as $package)
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="card card-stretch py-4 m-3">
                        <div id="content_block_02">
                            <div class="content-box">
                                <div class="sec-title left">
                                    <h2>{{ $package->name }}</h2>
                                    <span class="separator"></span>
                                </div>
                                <ul class="list-item clearfix">
                                    @foreach (unserialize($package->main_analysis) as $item)
                                        <li><i class="flaticon-laboratory"></i><h5>{{ \App\MainAnalysis::find($item)->general_name }}</h5></li>
                                    @endforeach
                                </ul>
                                <div class="bold-text d-inline-flex">
                                    <p class="mb-0" style="line-height: 2.5;">{{ __('Price:') }}</p>
                                    <h3 class="mx-2 mb-0">{{ $package->price }}</h3>
                                    <p class="mb-0" style="line-height: 2.5;">{{ __('SAR') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    
                @endforelse
                
            </div>
        </div>
    </section>
    <!-- technology-section end -->

    <!-- contact-section -->
    <section class="contact-section" id="homeVisit">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 mx-auto col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <div class="sec-title center">
                            <p>{{ __('Book Appointment Now') }}</p>
                            <h2>{{ __('Home Visit') }}</h2>
                            <span class="separator"></span>
                        </div>
                        <form method="post" action="/home_visit" data-id="home_visit" class="contact-form"> 
                            @csrf
                            <div class="row clearfix">
                                <div class="col-12" >
                                    <div id="success_fail_info"></div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="name" placeholder="{{__('Name')}}" required="">
                                    @error('name')
                                        <div class="invalid">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <select class="" name="sex"  id="sex" required>
                                        <option value="" selected disabled>{{__('Gender')}}</option>
                                        <option value="0">{{__('Male')}}</option>
                                        <option value="1">{{__('Female')}}</option>
                                    </select>
                                    @error('sex')
                                        <div class="invalid">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="phone" placeholder="{{__('Phone')}}" required>
                                    @error('phone')
                                        <div class="invalid">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                
                                
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="{{__('Email')}}" required="">
                                    @error('email')
                                        <div class="invalid">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="address" placeholder="{{__('Address')}}" required>
                                    @error('address')
                                        <div class="invalid">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" placeholder="{{__('Choose Date')}}"  name="date" class="hijri-date-input" />
                                    @error('date')
                                        <div class="invalid">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="time" name="time" />
                                    @error('time')
                                        <div class="invalid">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn text-center">
                                    <button type="submit" class="theme-btn style-one" name="submit-form">{{ __('Send') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->


    @if($sectors->count() > 0)
        <!-- clients-section -->
        <section class="clients-section">
            <h2 class="sec-title center mb-4">
                {{__('Our Clients')}}
            </h2>
            <div class="auto-container">
                <div class="clients-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                    @foreach($sectors as $sector)
                        <figure class="client-logo">
                            <a href="#">
                                @if($sector->logo)
                                    <img src="{{asset('storage/sector_logo/' . $sector->logo)}}" alt="Awesome Image">
                                @else
                                    <h5>{{$sector->name}}</h5>
                                @endif
                            </a>
                            <div class="overlay-box">
                                <a href="#">
                                    @if($sector->logo)
                                        <img src="{{asset('storage/sector_logo/' . $sector->logo)}}" alt="Awesome Image">
                                    @else
                                        <h5>{{$sector->name}}</h5>
                                    @endif
                                </a> 
                            </div>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- clients-section end -->
    @endif
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
                );
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