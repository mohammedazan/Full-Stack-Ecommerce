      <!-- start .container-banner -->
      <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        @php
                        $desiredKey = 2; // Change this value to the desired key (0 for the first feature, 1 for the second, etc.)
                        @endphp
                        @foreach($featuredImage as $key => $feature)
                        @if($key == $desiredKey)
                        <div class="banner banner-overlay">
                            <a href="#">
                                <img src="{{ asset($feature->image) }}" alt="Banner">
                            </a>
                            <div class="banner-content">
                                <h3 class="banner-title text-white"><a href="#">{{ $feature->title }}</a></h3><!-- End .banner-title -->
                                <h4 class="banner-subtitle text-white"><a href="#">{{ $feature->link }}</a></h4><!-- End .banner-subtitle -->
                                <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                        @break
                        @endif
                        @endforeach
                    </div><!-- End .col-lg-3 -->

                    <div class="col-sm-6 col-lg-3 order-lg-last">
                        @php
                        $desiredKey = 1; // Change this value to the desired key (0 for the first feature, 1 for the second, etc.)
                        @endphp
                        @foreach($featuredImage as $key => $feature)
                        @if($key == $desiredKey)
                        <div class="banner banner-overlay">
                            <a href="#">
                                <img src="{{ asset($feature->image) }}" alt="Banner" >
                            </a>
                            <div class="banner-content">
                                <h3 class="banner-title text-white"><a href="#">{{ $feature->title }}</a></h3><!-- End .banner-title -->
                                <h4 class="banner-subtitle text-white">{{ $feature->link }}</h4><!-- End .banner-subtitle -->
                                <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                        @break
                        @endif
                    @endforeach
                    </div><!-- End .col-lg-3 -->
                    
                    <div class="col-lg-6 ">
                        @php
                            $desiredKey = 0; // Change this value to the desired key (0 for the first feature, 1 for the second, etc.)
                        @endphp
                        @foreach($featuredImage as $key => $feature)
                            @if($key == $desiredKey)
                                <div class="banner banner-overlay">
                                    <a href="#">
                                        <img src="{{ asset($feature->image) }}" alt="Banner">
                                    </a>
                                    <div class="banner-content">
                                        <h3 class="banner-title text-white"><a href="#">{{ $feature->title }}</a></h3><!-- End .banner-title -->
                                        <h4 class="banner-subtitle text-white d-none d-sm-block">{{ $feature->link }}</h4><!-- End .banner-subtitle -->
                                        <a href="#" class="banner-link">Discover Now <i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .banner-content -->
                                </div><!-- End .banner -->
                                @break
                            @endif
                        @endforeach
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->
            </div>
            <!-- End .container -->