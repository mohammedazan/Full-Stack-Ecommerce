
<!DOCTYPE html>
<html lang="en">


<!-- molla/index-13.html  22 Nov 2019 09:59:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> ForBest</title>
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

            <!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/forbest') }}" >Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact us </li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
        
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        @foreach ($CompanyInfo as $key => $Company)
                            
                        <div class="col-md-8">
                            <div id="map" class="mb-5" style="position: relative;">
                              <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3165.8767928302733!2d-122.08424938468195!3d37.42206537982562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb5a5f2a6b97f%3A0xd8f28d798d6cd469!2sGoogleplex!5e0!3m2!1sen!2sus!4v1594861850145!5m2!1sen!2sus"
                                width="780"
                                height="500"
                                frameborder="0"
                                style="border:0;"
                                allowfullscreen=""
                                aria-hidden="false"
                                tabindex="0">
                              </iframe>
                              <a href="https://maps.app.goo.gl/ZGna22EurDsEXksV9" target="_blank" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></a>
                            </div><!-- End #map -->
                          </div><!-- End .col-md-8 -->
                          
                        <div class="col-md-4">
                            <div class="contact-box text-center">
                                <h3>Office</h3>
                                <address>{{ $Company->company_address }}</address>
                            </div><!-- End .contact-box -->
                            <div class="contact-box text-center">
                                <h3>Start a Conversation</h3>
                                <div><a href="mailto:#">{{ $Company->email }}</a></div>
                                <div><a href="tel:#">{{ $Company->phone }}</div>
                            </div><!-- End .contact-box -->
                            <div class="contact-box text-center">
                                <h3>Social</h3>
                                <div class="social-icons social-icons-color justify-content-center">
                                    <a href="{{$Company->facebook_link}}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a  href="{{$Company->twitter_link}}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="{{$Company->youtube_link}}"  class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .contact-box -->
                        </div><!-- End .col-md-4 -->
                        @endforeach
                    </div><!-- End .row -->
        
                    <hr class="mt-3 mb-5 mt-md-1">
                    <div class="touch-container row justify-content-center">
                        <div class="col-md-9 col-lg-7">
                            <div class="text-center">
                                <h2 class="title mb-1">Get In Touch</h2><!-- End .title mb-2 -->
                            </div><!-- End .text-center -->
                  
                            <form id="contact-form" action="#" method="post" class="contact-form mb-2">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="cname" class="sr-only">Name</label>
                                        <input name="name" type="text" class="form-control" id="name" placeholder="Name *" required>
                                    </div><!-- End .col-sm-4 -->
        
                                    <div class="col-sm-4">
                                        <label for="email" class="sr-only">Email</label>
                                        <input name="email" type="email" class="form-control" id="email" placeholder="Email *" required>
                                    </div><!-- End .col-sm-4 -->
                                </div><!-- End .row -->
        
                                <label for="subject" class="sr-only">Subject</label>
                                <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
        
                                <label for="message" class="sr-only">Message</label>
                                <textarea name="message" class="form-control" cols="30" rows="4" id="message" required placeholder="Message *"></textarea>
        
                                <div class="text-center">
                                    <button type="submit" onclick="SendMail()" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                        <span>SUBMIT</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div><!-- End .text-center -->
                            </form><!-- End .contact-form -->
                        </div><!-- End .col-md-9 col-lg-7 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main>
        <!-- End .main -->


        

        

  

        <!-- start .footer -->
        @include('guest/partials.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- End .mobile-menu-container -->

    @include('guest/partials.register')

    @include('guest/partials.login')

    @include('guest/partials.mobile-menu')


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init("RqLCsPE-Jb3Vm1pME");
        })();

        function SendMail() {
            event.preventDefault();

            var params = {
                from_name: document.getElementById("name").value,
                email: document.getElementById("email").value,
                subject: document.getElementById("subject").value,
                message: document.getElementById("message").value
            };

            emailjs.send("service_0won254", "template_6rvsy6d", params)
                .then(function(response) {
                    alert("Success! " + response.status);
                    document.getElementById("contact-form").reset();
                }, function(error) {
                    alert("Failed to send your message. Please try again.");
                });
        }
    </script>


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