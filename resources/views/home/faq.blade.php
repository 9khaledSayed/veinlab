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
                            <h2 class="w-text title wow fadeInUp" data-wow-delay="0.2s">FAQ Questions</h2>
                            <ol class="breadcrumb justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### FAQ & Timeline Area Start ##### -->
    <div class="faq-timeline-area section-padding-100-85" id="faq">
        <div class="container">
            <div class="section-heading text-center">
                <span>Important questions</span>
                <h2 class="d-blue bold fadeInUp" data-wow-delay="0.3s"> Frequently Questions</h2>
                <p class="fadeInUp" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis accumsan nisi Ut ut felis congue nisl hendrerit commodo.</p>
            </div>
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 offset-lg-0 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                    <div class="welcome-meter about-sec-wrapper wow fadeInUp" data-wow-delay="0.4s">
                        <img src="{{asset('home_assets/img/core-img/about-sec2.jpg')}}" class="about-i" alt="">
                        <div class="article special width-50 box-shadow">
                            <div class="form-head">
                                <div class="form-head-icon"><img src="{{asset('home_assets/img/icons/info1.png')}}" alt=""></div>
                                <div class="form-head-info">
                                    <h6 class="w-text">8:00 a.m to 6:00 p.m.(CST)</h6>
                                    <p class="g-text">Monday through Friday</p>
                                </div>
                            </div>
                            <div class="form-head">
                                <div class="form-head-icon"><img src="{{asset('home_assets/img/icons/info2.png')}}" alt=""></div>
                                <div class="form-head-info">
                                    <h6 class="w-text">support@domain.com</h6>
                                    <p class="g-text">Monday through Friday</p>
                                </div>
                            </div>
                            <div class="form-head mb-0">
                                <div class="form-head-icon"><img src="{{asset('home_assets/img/icons/info3.png')}}" alt=""></div>
                                <div class="form-head-info">
                                    <h6 class="w-text">(080) 5388-273-284</h6>
                                    <p class="g-text">8:00 a.m to 6:00 p.m</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="dream-faq-area mt-s ">
                        <dl style="margin-bottom:0">
                            <!-- Single FAQ Area -->
                            <dt class="wave fadeInUp" data-wow-delay="0.2s">What are the objectives of this Laboratory?</dt>
                            <dd class="fadeInUp" data-wow-delay="0.3s">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore omnis quaerat nostrum, pariatur ipsam sunt accusamus enim necessitatibus est fugiat, assumenda dolorem, deleniti corrupti cupiditate ipsum, dolorum voluptatum esse error?</p>
                            </dd>
                            <!-- Single FAQ Area -->
                            <dt class="wave fadeInUp" data-wow-delay="0.3s">What is the best features and services we deiver?</dt>
                            <dd>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore omnis quaerat nostrum, pariatur ipsam sunt accusamus enim necessitatibus est fugiat, assumenda dolorem, deleniti corrupti cupiditate ipsum, dolorum voluptatum esse error?</p>
                            </dd>
                            <!-- Single FAQ Area -->
                            <dt class="wave fadeInUp" data-wow-delay="0.4s">Why this app important to me?</dt>
                            <dd>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore omnis quaerat nostrum, pariatur ipsam sunt accusamus enim necessitatibus est fugiat, assumenda dolorem, deleniti corrupti cupiditate ipsum, dolorum voluptatum esse error?</p>
                            </dd>
                            <!-- Single FAQ Area -->
                            <dt class="wave fadeInUp" data-wow-delay="0.5s">how may I take part in and purchase this Software?</dt>
                            <dd>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore omnis quaerat nostrum, pariatur ipsam sunt accusamus enim necessitatibus est fugiat, assumenda dolorem, deleniti corrupti cupiditate ipsum, dolorum voluptatum esse error?</p>
                            </dd>
                            <!-- Single FAQ Area -->
                            <dt class="wave fadeInUp" data-wow-delay="0.3s">What is the best features and services we deiver?</dt>
                            <dd>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore omnis quaerat nostrum, pariatur ipsam sunt accusamus enim necessitatibus est fugiat, assumenda dolorem, deleniti corrupti cupiditate ipsum, dolorum voluptatum esse error?</p>
                            </dd>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ##### FAQ & Timeline Area End ##### -->

@endsection
