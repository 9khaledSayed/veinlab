@extends('layouts.home')
@section('content')
    <!-- ##### Welcome Area Start ##### -->
    <div class="breadcumb-area clearfix dzsparallaxer auto-init" data-options='{direction: "normal"}'>
        <div class="divimage dzsparallaxer--target" style="width: 101%; height: 130%; background-image:{{asset('home_assets/img/bg-img/bg-2.jpg')}}"></div>
        <!-- breadcumb content -->
        <div class="breadcumb-content">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcumb--con text-center">
                            <h2 class="w-text title wow fadeInUp" data-wow-delay="0.2s">Services</h2>
                            <ol class="breadcrumb justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Services</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Our Services Area Start ##### -->
    <section class="our_services_area section-padding-100-0 relative hex-pat-1" id="services">
        <div class="container">

            <div class="section-heading text-center">
                <span>Our Services</span>
                <h2 class="d-blue bold fadeInUp" data-wow-delay="0.3s">Our Core Services</h2>
                <p class="fadeInUp" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis accumsan nisi Ut ut felis congue nisl hendrerit commodo.</p>
            </div>


            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.2s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/services/serv1.jpg')}}" alt="">
                        </div>
                        <div class="serv_icon">
                            <img src="{{asset('home_assets/img/icons/s1.png')}}" alt="">
                        </div>
                        <div class="service-content">
                            <h6 class="d-blue bold">Chemical Research</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam, maxi ut accumsan ut, posuere sit Lorem ipsum</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.2s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/services/serv2.jpg')}}" alt="">
                        </div>
                        <div class="serv_icon">
                            <img src="{{asset('home_assets/img/icons/s2.png')}}" alt="">
                        </div>
                        <div class="service-content">
                            <h6 class="d-blue bold">Advanced Microscopy</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam, maxi ut accumsan ut, posuere sit Lorem ipsum</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.2s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/services/serv3.jpg')}}" alt="">
                        </div>
                        <div class="serv_icon">
                            <img src="{{asset('home_assets/img/icons/s3.png')}}" alt="">
                        </div>
                        <div class="service-content">
                            <h6 class="d-blue bold">Anatomical Pathology</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam, maxi ut accumsan ut, posuere sit Lorem ipsum</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.4s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/services/serv4.jpg')}}" alt="">
                        </div>
                        <div class="serv_icon">
                            <img src="{{asset('home_assets/img/icons/s4.png')}}" alt="">
                        </div>
                        <div class="service-content">
                            <h6 class="d-blue bold">Molecular Biology</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam, maxi ut accumsan ut, posuere sit Lorem ipsum</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.4s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/services/serv5.jpg')}}" alt="">
                        </div>
                        <div class="serv_icon">
                            <img src="{{asset('home_assets/img/icons/s5.png')}}" alt="">
                        </div>
                        <div class="service-content">
                            <h6 class="d-blue bold">Diabetes Testing</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam, maxi ut accumsan ut, posuere sit Lorem ipsum</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Content -->
                    <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.4s">

                        <div class="service_img">
                            <img src="{{asset('home_assets/img/services/serv6.jpg')}}" alt="">
                        </div>
                        <div class="serv_icon">
                            <img src="{{asset('home_assets/img/icons/s6.png')}}" alt="">
                        </div>
                        <div class="service-content">
                            <h6 class="d-blue bold">Heart Disease</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam, maxi ut accumsan ut, posuere sit Lorem ipsum</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <section class="creative-facts section-before section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="c-facts-box">
                        <div class="who-we-contant">
                            <div class="promo-section">
                                <h3 class="special-head">Our Numbers Are Talking</h3>
                            </div>
                            <h4 class="wow fadeInUp bold" data-wow-delay="0.3s">We Care Too Much About Our Customers Satisfication</h4>
                            <p class="wow fadeInUp" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at dictum risus, non suscipit arcu. Quisque aliquam posuere tortor, sit amet convallis nunc scelerisque in.</p>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <!-- Single Cool Fact -->
                                    <div class="single_cool_fact text-center wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="cool_fact_icon">
                                            <i class="ti-user"></i>
                                        </div>
                                        <!-- Single Cool Detail -->
                                        <div class="cool_fact_detail">
                                            <h3><span class="counter">3215</span>+</h3>
                                            <h2>Happy Clients</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <!-- Single Cool Fact -->
                                    <div class="single_cool_fact text-center wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="cool_fact_icon">
                                            <i class="ti-cup"></i>
                                        </div>
                                        <!-- Single Cool Detail -->
                                        <div class="cool_fact_detail">
                                            <h3><span class="counter">230</span>+</h3>
                                            <h2>Awards Won</h2>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </section>


    <section class="about-us-area section-padding-70-70">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-3 col-md-12 ">

                    <div class="col-xs-12">
                        <div class="article special box-shadow">
                            <img src="{{asset('home_assets/img/icons/s1.png')}}" class="mb-10" alt="">
                            <h3 class="article__title">Chemical Research</h3>
                            <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit</p>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="article special box-shadow">
                            <img src="{{asset('home_assets/img/icons/s2.png')}}" class="mb-10" alt="">
                            <h3 class="article__title">Advanced Microscopy</h3>
                            <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit</p>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-lg-3 col-md-12">

                    <div class="col-xs-12">
                        <div class="article special box-shadow mts-50">
                            <img src="{{asset('home_assets/img/icons/s3.png')}}" class="mb-10" alt="">
                            <h3 class="article__title">Molecular Biology</h3>
                            <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit</p>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="article special box-shadow">
                            <img src="{{asset('home_assets/img/icons/s4.png')}}" class="mb-10" alt="">
                            <h3 class="article__title">Pathology Testing</h3>
                            <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit</p>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-lg-6 offset-lg-0 col-md-10 offset-md-1">
                    <div class="who-we-contant mt-s">
                        <div class="promo-section">
                            <h3 class="special-head ">Learn More About Us!</h3>
                        </div>
                        <h4 class="bl-text fadeInUp" data-wow-delay="0.3s">We Are The Trusted Experts We Keep Things Simple</h4>
                        <p class="fadeInUp" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at dictum risus, non suscipit arcu. Quisque aliquam posuere tortor, sit amet convallis nunc scelerisque in.</p>
                        <p class="fadeInUp" data-wow-delay="0.5s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo quo laboriosam, dolorum ducimus aliquam consequuntur!</p>
                        <a class="btn dream-btn green-btn mt-30 fadeInUp" data-wow-delay="0.6s" href="#">Read More</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
