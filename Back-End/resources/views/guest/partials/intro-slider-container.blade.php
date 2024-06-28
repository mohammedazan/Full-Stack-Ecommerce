<div class="intro-slider-container" style="margin-top: 0.1px">
                <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                        "nav": false,
                        "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>
                    @foreach($offer as $key=>$offerList)
                    <div class="intro-slide" style="background-image: url({{asset($offerList->banner_image)}});">
                        <div class="container intro-content">
                            <div class="row">
                                <div class="col-auto offset-lg-3 intro-col">
                                    <h3 class="intro-subtitle">Trade-In Offer</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title" style="color: #0d4377">{{$offerList->offer_name}} 
                                    </h1><!-- End .intro-title -->
                                    @php 
                                       $id = $offerList->id
                                    @endphp
                                    <a href="{{ route('product.offer', ['id' => $id]) }}" class="btn btn-outline-primary-2">
                                        <span>Shop Now</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .col-auto offset-lg-3 -->
                            </div><!-- End .row -->
                        </div><!-- End .container intro-content -->
                    </div><!-- End .intro-slide -->
                    @endforeach
                </div><!-- End .owl-carousel owl-simple -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div>
            <!-- End .intro-slider-container -->
