
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
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/jquery.countdown.css') }}" rel="stylesheet">
    
    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/skins/skin-demo-13.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/demos/demo-13.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Place your HTML content here -->

    <!-- Toastr Initialization -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            // Toastr Initialization
            @if(Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            @if(Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
        });
    </script>
    @livewireStyles
    <livewire:styles />
</head>


<body>
  
    <div class="page-wrapper">

    @include('guest/partials.header')
        <!-- End .header -->

        <main class="main">
            <div class="alert-container">

        
               <!-- start .slider -->
        @include('guest/partials.intro-slider-container')
                   <!-- End .slider -->
      
            <div class="mb-4"></div><!-- End .mb-2 -->
                 
            <!-- start .container_categorie -->
            @include('guest/partials.container_categorie')
            <!-- End .container -->

            
            <div class="mb-2"></div><!-- End .mb-2 -->

            <!-- start .container-banner -->
            @include('guest/partials.container_banner2')

            {{-- @include('guest/partials.container-banner') --}}
            <!-- End .container -->

            <div class="mb-3"></div><!-- End .mb-3 -->

            <!-- start .HotDealsProducts -->
            {{-- @include('guest/partials.HotDealsProducts') --}}
            @livewire('hot-deals-products')
            <!-- End .HotDealsProducts -->
            <!-- End .bg-light pt-5 pb-5 -->

            <div class="mb-3"></div><!-- End .mb-3 -->


            <!-- End .container_electronics -->

            
            <!-- End .container_electronics -->
            

            <div class="mb-3"></div><!-- End .mb-3 -->

            <!-- start .container_banner2 -->


            <!-- End .container_banner2 -->




            <div class="mb-1"></div><!-- End .mb-1 -->


         <!-- start .container-Furniture -->


            <!-- End .container-Furniture -->

            <div class="mb-3"></div><!-- End .mb-3 -->


            <!-- start .container-clothing  -->

            
            <!-- End .container-clothing  -->

            <div class="mb-3"></div><!-- End .mb-3 -->

            <!-- start .container-brands  -->
            @include('guest/partials.container-brands ')
            <!-- End .container-brands -->

       
              <!-- start .blog-posts -->
              @include('guest/partials.blog-posts ')
            <!-- End .blog-posts -->


            <!-- start .container-Subscribe  -->
            @livewire('container-subscribe')
            <!-- End .container-Subscribe  -->


            


        </main><!-- End .main -->

        <!-- start .footer -->
        @include('guest/partials.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- End .mobile-menu-container -->
    @include('guest/partials.mobile-menu')



    @include('guest/partials.register')

    @include('guest/partials.login')




    


    {{--  @include('guest/partials.popup-container')--}}



    
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
    @livewireScripts
    <livewire:scripts />
</body>
<!-- molla/index-13.html  22 Nov 2019 09:59:31 GMT -->
</html>