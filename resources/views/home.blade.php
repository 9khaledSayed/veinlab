@extends('layouts.home')

@section('content')
    <!-- ##### Welcome Start ##### -->
    <section class="hero-section ai2 relative"  id="home">
        <div class="overlay"></div>
        <!-- Hero Content -->
        <div class="hero-section-content">
            <div class="container ">
                <div class="row ">
                    <!-- Welcome Content -->
                    <div class="col-12 col-lg-6 col-md-12" style="direction:rtl">
                        <div class="welcome-content ">
                            <h1 class="bold wow fadeInUp d-blue" data-wow-delay="0.2s">{{__('Welcome To Vein Medical Laboratories')}}</h1>
                            <p class="wow fadeInUp b-text" data-wow-delay="0.3s">{{__('At the heart of our mission of delivering high-quality services ... The Vein Medical Laboratories in the Riyadh region, specifically the Department of Almajmaah.')}}</p>

                            <div class="dream-btn-group fadeInUp" data-wow-delay="0.4s">
                                <a href="#about" id="about_btn" class="btn dream-btn mr-3">{{__('More...')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome End ##### -->
    <!-- ##### Our Services Area Start ##### -->
    <section class="our_services_area section-padding-100-0 relative hex-pat-1" id="services">
        <div class="container">

            <div class="section-heading text-center">
                <h1 class="d-blue bold fadeInUp" data-wow-delay="0.3s">{{__('Our Services')}}</h1>
                <p class="fadeInUp" data-wow-delay="0.4s">{{__('Vein Medical Laboratories provide the following services')}}</p>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.2s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/health_1.png')}}" style=" height: 243px" alt="">
                        </div>
                        <a href="/login/patient" >
                            <div class="serv_icon">
                                <i class="fa fa-user-circle icons" aria-hidden="true"></i>
                            </div>
                            <div class="service-content">
                                <h6 class="d-blue bold" style="color: #ffff" >{{__('Customers')}}</h6>
                                {{--                        <p>Sign in as a patient to see your results</p>--}}
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.4s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/home_v.jpg')}}" style=" height: 243px" alt="" alt="">
                        </div>
                        <a href="/home_visit">
                            <div class="serv_icon">
                                <i class="fa fa-home icons" aria-hidden="true"></i>
                            </div>

                            <div class="service-content">
                                <h6 class="d-blue bold">{{__('Home Visit')}}</h6>
                                {{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam, maxi ut accumsan ut, posuere sit Lorem ipsum</p>--}}
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">

                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.2s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/doctors.jpg')}}" style=" height: 243px" alt="">
                        </div>
                        <a href="/login/hospital">
                            <div class="serv_icon">
                                <i class="fa fa-hospital-o icons" aria-hidden="true"></i>
                            </div>
                            <div class="service-content">
                                <h6 class="d-blue bold">{{__('Medical centers')}}</h6>
                                {{--                        <p>Sign in as a hospital to see your patient's results</p>                    --}}
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Us Area Start ##### -->
    <section class="about-us-area section-padding-0-100 relative mt-5" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 offset-lg-0 col-md-10 offset-md-1">
                    <div class="who-we-contant" style="text-align: center">
                        <div class="promo-section">
                            <h1 class="special-head ">{{__('About Us')}}</h1>
                        </div>
                        <p class="fadeInUp definition" data-wow-delay="0.4s">{{__('At the heart of our mission of delivering high-quality services ... The Vein Medical Laboratories in the Riyadh region, specifically the Department of mojamaa, established the nature of the organization\'s work not only when it presented its medical data through a visit to its headquarters, but also the establishment of a wide network of governmental and private cooperatives ,The Vein Medical Laboratories are designed to become the leading medical laboratory for excellence in medical analysis in the Middle East by providing all medical services according to the highest international standards.')}}</p>
                        <div class="promo-section">
                            <h1 class="special-head ">{{__('Our Mission')}}</h1>
                        </div>
                        <p class="fadeInUp definition" data-wow-delay="0.4s">{{__('Provide all medical analysis to all members of the community with accuracy and speed, providing the latest technology in medical analysis and employing the highest quality medical and administrative working skills to maintain and provide quality services in every honesty.')}}</p>

                    </div>
                </div>
                <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                    <div class="welcome-meter about-sec-wrapper mt-s wow fadeInUp" data-wow-delay="0.4s">
                        <img style="border-radius:15px;width: 500px; height: 526px" src="{{asset('home_assets/img/core-img/about2.jpeg')}}"  class="about-i" alt="">
                        <div class="article special box-shadow">
                            <img  style="border-radius:15px" src="{{asset('home_assets/img/icons/s55.png')}}" class="mb-10" alt="">
                            <h3 class="article__title">Our Mission</h3>
                            <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit conse ctetur adipi sicing</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ##### About Us Area End ##### -->
    @if($sectors->count() > 0)
    <!-- ##### Testimonial Area Start ##### -->
    <section class="clients_testimonials_area bg-img section-padding-0-0" id="test" dir="ltr">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center  mt-5">
                        <h1 class="d-blue bold fadeInUp" data-wow-delay="0.3s">{{__('Our Clients')}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="cotainer-fluid">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                <div class="col-12 col-md-10 col-xs-10 offset-xs-1">
                    <div class="client_slides owl-carousel">
                        <!-- Single Testimonial -->
                        @foreach($sectors as $sector)
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Image -->
                                <div class="">
                                    @if($sector->logo)<img src="{{asset('storage/sector_logo/' . $sector->logo)}}" alt="">@else <div style="height: 150px;width: 300px;color: #fff;">{{$sector->name}}</div> @endif
                                </div>
                                <!-- Testimonial Feedback Text -->
                                <div class="testimonial-description">
                                    <!-- Admin Text -->
                                    <div class="admin_text">
                                        <h5>{{$sector->name}}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Testimonial Area End ##### -->
    @endif
@endsection

@push('scripts')
    <script>
        $('#about_btn').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        });
    </script>
@endpush
