@extends('layouts.home')
@section('content')



    <!-- ##### Welcome Area Start ##### -->
    <div class="breadcumb-area clearfix dzsparallaxer auto-init" data-options='{direction: "normal"}'>
        <div class="divimage dzsparallaxer--target" style="width: 101%; height: 130%; background-image: {{asset('home_assets/img/bg-img/bg-2.jpg')}}"></div>
        <!-- breadcumb content -->
        <div class="breadcumb-content">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcumb--con text-center">
                            <h2 class="w-text title wow fadeInUp" data-wow-delay="0.2s">About us</h2>
                            <ol class="breadcrumb justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### About Us Area Start ##### -->
    <section class="about-us-area section-padding-100 relative" id="about">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 offset-lg-0 col-md-12 no-padding-left">
                    <div class="welcome-meter about-sec-wrapper wow fadeInUp" data-wow-delay="0.4s">
                        <img src="{{asset('home_assets/img/core-img/about-sec1.png')}}" class="about-i" alt="">
                        <div class="article special box-shadow">
                            <img src="{{asset('home_assets/img/icons/s55.png')}}" class="mb-10" alt="">
                            <h3 class="article__title">Our Mission</h3>
                            <p>Lorem ipsum dolor sit amet, conse ctetur adipi sicing elit conse ctetur adipi sicing</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 offset-lg-0 col-md-10 offset-md-1">
                    <div class="who-we-contant mt-s">
                        <div class="promo-section">
                            <h3 class="special-head ">Welcome to Laboratory!</h3>
                        </div>
                        <h4 class="d-blue fadeInUp" data-wow-delay="0.3s">We will ensure you are getting The Best Service & Accurate Results</h4>
                        <p class="fadeInUp" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at dictum risus, non suscipit arcu. Quisque aliquam posuere tortor, sit amet convallis nunc scelerisque in.</p>
                        <div class="list-wrap align-items-center">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="side-feature-list-item">
                                        <img src="{{asset('home_assets/img/icons/check.png')}}" class="check-mark-icon" alt="">
                                        <div class="foot-c-info">Laboratory Priority Services Delivered</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="side-feature-list-item">
                                        <img src="{{asset('home_assets/img/icons/check.png')}}" class="check-mark-icon" alt="">
                                        <div class="foot-c-info">Best Laboratory Award Winner</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="side-feature-list-item">
                                        <img src="{{asset('home_assets/img/icons/check.png')}}" class="check-mark-icon" alt="">
                                        <div class="foot-c-info">Affordable Health Packages & Acourate Results</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="side-feature-list-item">
                                        <img src="{{asset('home_assets/img/icons/check.png')}}" class="check-mark-icon" alt="">
                                        <div class="foot-c-info">It is a long established fact that a reader will</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ##### About Us Area End ##### -->

    <section class="how section-padding-100-70 relative map-bg map-before" >

        <div class="container">

            <div class="section-heading text-center">
                <span>Awesome Features</span>
                <h2 class="wow fadeInUp d-blue bold" data-wow-delay="0.3s" >Our core Features</h2>
                <p class="wow fadeInUp" data-wow-delay="0.4s" >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis accumsan nisi Ut ut felis congue nisl hendrerit commodo.</p>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <!-- Content -->
                    <div class="service_single_content box-shadow text-left wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Icon -->
                        <div class="how_icon">
                            <img src="{{asset('home_assets/img/icons/f1.png')}}" class="colored-icon" alt="">
                        </div>
                        <h6>Helpful Test Tips</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <!-- Content -->
                    <div class="service_single_content box-shadow text-left wow wow fadeInUp" data-wow-delay="0.3s">
                        <!-- Icon -->
                        <div class="how_icon">
                            <img src="{{asset('home_assets/img/icons/f2.png')}}" class="colored-icon" alt="">
                        </div>
                        <h6>Research Center</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <!-- Content -->
                    <div class="service_single_content box-shadow text-left wow fadeInUp">
                        <!-- Icon -->
                        <div class="how_icon">
                            <img src="{{asset('home_assets/img/icons/f3.png')}}" class="colored-icon" alt="">
                        </div>
                        <h6>Latest Equipment</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <!-- Content -->
                    <div class="service_single_content box-shadow text-left wow fadeInUp">
                        <!-- Icon -->
                        <div class="how_icon">
                            <img src="{{asset('home_assets/img/icons/f4.png')}}" class="colored-icon" alt="">
                        </div>
                        <h6>Qualified Staff</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla neque quam</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
