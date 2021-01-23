<!-- ##### Footer Area Start ##### -->

<footer class="footer-area bg-img">
    <div class="footer-content-area " style="background-image: url({{asset('home_assets/img/core-img/footer-bg1.html')}});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12 col-md-4">
                    <div class="footer-copywrite-info">
                        <!-- Copywrite -->
                        <div class="copywrite_text wow fadeInUp" data-wow-delay="0.2s">
                            <div class="footer-logo">
                                <a href="/"><img src="{{asset('logo/logo1.png')}}" alt="logo" style="width: 150px; height: 130px"></a>
                            </div>
                            <div class="footer-social-info  wow fadeInUp"  data-wow-delay="0.4s">
                                <a href="https://www.snapchat.com/add/veinlab"><i class="fa fa-snapchat" aria-hidden="true"></i></a>
                                <a href="https://twitter.com/veinlab"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <!-- Social Icon -->
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <!-- Content Info -->
                    <div class="contact_info_area d-sm-flex justify-content-between">
                        <!-- Content Info -->
                        <div class="contact_info footer-social-info  wow fadeInUp" data-wow-delay="0.3s">
                            <h5 class="contact"> {{__('Contact US')}}</h5>
                            <p class="contact-item" style="margin-bottom: 5px"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                {{Setting::get('Telephone') ??'920015100'}}</p>
                            <p class="contact-item"><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>0568855233</p>
                        </div>
                        <!-- Content Info -->
                        <div class="contact_info text-center wow fadeInUp" data-wow-delay="0.4s">
                            <h5 class="contact">{{__('Address Info')}}</h5>
                            <p class="contact-item">{{Setting::get('Email') ??'support@yourdomain.com'}}</p>
                            <p class="contact-item">{{Setting::get('AddressArabic') ??'المجمعة : طريق الأمير نايف بن عبدالعزيز'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright text-center wow fadeInUp py-3" style="font-size: 10px;">
        Developed and Designed by <span style="font-weight: 900;"></span><br>
        جميع الحقوق محفوظة © مختبر فين
    </div>
    <!-- Copyright -->
</footer>
<!-- ##### Footer Area End ##### -->
