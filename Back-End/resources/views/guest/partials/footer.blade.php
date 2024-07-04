<footer class="footer footer-2">
            <div class="footer-middle border-0">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="widget widget-about">
                                @php
                                $ver = $CompanyInfo->shuffle()->take(1);
                                @endphp
                                @foreach ($ver as $key =>$Company )
                                <img src="{{asset('assets/adminPanel')}}/images/Forbest-Logo-01.png" class="footer-logo" alt="Footer Logo" width="105" height="25">
                                  <p>{{ $Company->about_us }}</p>
                                <div class="widget-about-info" >
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4">
                                            <span class="widget-about-title">Got Question? Call us 24/7</span>
                                            <a href="tel:123456789">
                                                {{ $Company->phone}}
                                            </a>
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-6 col-md-8">
                                            <span class="widget-about-title">Payment Method</span>
                                            <figure class="footer-payments">
                                                <img src="{{asset('assets/images/payments.png')}}" alt="Payment methods" width="272" height="20">
                                            </figure><!-- End .footer-payments -->
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .widget-about-info -->
                                @endforeach
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-12 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget"> 
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title">Information</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="{{ route('about') }}">About ForBest</a></li>
                                    <li><a href="{{ route('product_list') }}">How to shop on ForBest</a></li>
                                    <li><a href="{{ route('faqs') }}">FAQ</a></li>
                                    <li><a href="{{ route('contact') }}">Contact us</a></li>
                                    <li><a href="{{ route('blogall') }}">Blogs</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-64 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->

            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright">Copyright © 2024 ForBest  Store. All Rights Reserved.</p><!-- End .footer-copyright -->
                    <div class="social-icons social-icons-color">
                        <span class="social-label">Social Media</span>
                        @php
                        $ver = $CompanyInfo->shuffle()->take(1);
                        @endphp
                        @foreach ($ver as $key =>$Company )
                        <a href="{{$Company->facebook_link}}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a  href="{{$Company->twitter_link}}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="{{$Company->youtube_link}}"  class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        @endforeach
                    </div><!-- End .soial-icons -->
                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->
        </footer>
        <!-- End .footer -->