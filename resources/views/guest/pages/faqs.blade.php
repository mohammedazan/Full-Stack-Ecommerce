<!DOCTYPE html>
<html lang="en">


<!-- molla/index-13.html  22 Nov 2019 09:59:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ForBest</title>
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
    <link rel="stylesheet"  href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet"  href="{{asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery.countdown.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet"  href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/skins/skin-demo-13.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demos/demo-13.css')}}">
</head>
<body>
    <div class="page-wrapper">
    @include('guest/partials.header')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('forbest')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <h2 class="title text-center mb-3">Frequently Asked Questions</h2><!-- End .title -->
                <div class="accordion accordion-rounded" id="accordion-1">
                    
                    @foreach($faqList as $key => $faq)
                    <div class="card card-box card-sm bg-light">
                        <div class="card-header" id="heading-{{ $key }}">
                            <h2 class="card-title">
                                <a class="{{ $key == 0 ? '' : 'collapsed' }}" role="button" data-toggle="collapse" href="#collapse-{{ $key }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $key }}">
                                    {{ $faq->title }}
                                </a>
                            </h2>
                        </div><!-- End .card-header -->
                        <div id="collapse-{{ $key }}" class="collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $key }}" data-parent="#accordion-1">
                            <div class="card-body">
                                {{ $faq->details }}
                            </div><!-- End .card-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .card -->
                    @endforeach
                </div><!-- End .accordion -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
    @include('guest/partials.footer')
    @include('guest/partials.register')
    @include('guest/partials.login')
    @include('guest/partials.mobile-menu')
    </div>
    <!-- Plugins JS File -->
    <script src= "{{asset('assets/js/jquery.min.js')}}" ></script>
    <script src= "{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src= "{{asset('assets/js/jquery.hoverIntent.min.js')}}"></script>
    <script src= "{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
    <script src= "{{asset('assets/js/superfish.min.js')}}" ></script>
    <script src= "{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <!-- Main JS File -->
    <script src= "{{asset('assets/js/main.js')}}"></script>

</body>
</html>