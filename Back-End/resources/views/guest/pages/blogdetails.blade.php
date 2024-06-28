
<!DOCTYPE html>
<html lang="en">


<!-- molla/index-13.html  22 Nov 2019 09:59:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> ForBest </title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/adminPanel/images/Forbest-favicon-01.png') }}" type="image/jpg">  
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/jquery.countdown.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/skins/skin-demo-13.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/demos/demo-13.css')}}" rel="stylesheet">


</head>

<body>
    <div class="page-wrapper">
    
    @include('guest/partials.header')
        <!-- End .header -->
 
        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('forbest')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('blogall')}}">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog details</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <figure class="entry-media">
                    <img src="{{ asset('uploads_blogs/blogs/' . $blogs->img) }}" alt="mage desc"   >

                </figure><!-- End .entry-media -->
                <div class="container">
                    <article class="entry single-entry entry-fullwidth">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <span class="entry-author">
                                            by <a href="#">{{$blogs->blogowner}}</a>
                                        </span>
                                        <span class="meta-separator">|</span>
                                        <a href="#">{{$blogs->created_at}}</a>
                                    </div><!-- End .entry-meta -->

                                    <br>
                                    <h2 class="entry-title entry-title-big">
                                      {{$blogs->title}}
                                    </h2><!-- End .entry-title -->

                                    <!-- <div class="entry-cats">
                                        in <a href="#">Travel</a>
                                    </div> -->
                                    <!-- End .entry-cats -->
                                    <br>
                                    <div class="entry-content editor-content">
                                        <p>{{$blogs->content}}</p>

                                        <div class="pb-1"></div><!-- End .pb-1 -->

                                  
                                    </div><!-- End .entry-content -->

                                </div><!-- End .entry-body -->
                            </div><!-- End .col-lg-11 -->

                            <div class="col-lg-1 order-lg-first mb-2 mb-lg-0">
                            <div class="sticky-content">
                <div class="social-icons social-icons-colored social-icons-vertical">
                    <span class="social-label">SHARE:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                    <!-- Add more social media sharing links for other platforms -->
                    <!-- For Pinterest -->
                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(request()->fullUrl()) }}" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    <!-- For LinkedIn -->
                    <a href="https://www.linkedin.com/shareArticle?url={{ urlencode(request()->fullUrl()) }}" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                </div><!-- End .soial-icons -->
            </div><!-- End .sticky-content -->
                            </div><!-- End .col-lg-1 -->
                        </div><!-- End .row -->

                    </article><!-- End .entry -->

             
                     <!-- start .blog-posts -->
                            @include('guest/partials.blog-posts ')
                            <!-- End .blog-posts -->
                    <!-- <div class="comments">
                        <h3 class="title">0 Comment</h3>
                    </div> -->

             
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
        @include('guest/partials.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- End .mobile-menu-container -->

    

    @include('guest/partials.register')

    @include('guest/partials.login')
    @include('guest/partials.mobile-menu')



    <script src= "{{asset('assets/js/jquery.min.js')}}"></script>

    <script src= "{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.hoverIntent.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.waypoints.min.js')}}"></script>

    <script src= "{{asset('assets/js/superfish.min.js')}}"></script>

    <script src= "{{asset('assets/js/owl.carousel.min.js')}}"></script>

    <script src= "{{asset('assets/js/bootstrap-input-spinner.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.plugin.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.countdown.min.js')}}"></script>

    <!-- Main JS File -->
    <script src= "{{asset('assets/js/main.js')}}"></script>

    <script src= "{{asset('assets/js/demos/demo-13.js')}}"></script>

</body>


<!-- molla/index-13.html  22 Nov 2019 09:59:31 GMT -->
</html>