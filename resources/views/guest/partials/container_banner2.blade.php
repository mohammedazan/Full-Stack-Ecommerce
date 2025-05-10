<div class="container">
                <div class="row" >
                    @php
                    $desiredKey = 1;
                     // Change this value to the desired key (0 for the first feature, 1 for the second, etc.)
                    @endphp
                    @foreach($featuredImage as $key => $feature)
                    @if($key == $desiredKey)
                    <div class="col-lg-6">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="#">
                                <img src="{{ asset($feature->image) }}"  alt="Banner" style="height: 260px">
                            </a>

                            <div class="banner-content">
                                <h3 class="banner-title text-white"><a href="#">{{ $feature->title }}</br><span><small>{{ $feature->link }}</small></span></a></h3><!-- End .banner-title -->
                                <a href="{{ route('product') }}"  class="banner-link">Discover Now <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-lg-6 -->
                    @break
                    @endif
                    @endforeach




                    @php
                    $desiredKey = 2;
                     // Change this value to the desired key (0 for the first feature, 1 for the second, etc.)
                    @endphp
                    @foreach($featuredImage as $key => $feature)
                    @if($key == $desiredKey)
                    <div class="col-lg-6">
                        <div class="banner banner-overlay">
                            <a href="#">
                                <img src="{{ asset($feature->image) }}"  alt="Banner" style="height: 260px">
                            </a>

                            <div class="banner-content">
                                <h3 class="banner-title text-white"><a href="#">{{ $feature->title }}</br><span><small>{{ $feature->link }}</small></span></a></h3><!-- End .banner-title -->
                                <a href="{{ route('product') }}" class="banner-link">Discover Now <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-lg-6 -->
                    @break
                    @endif
                    @endforeach
                </div><!-- End .row -->
</div><!-- End .container -->