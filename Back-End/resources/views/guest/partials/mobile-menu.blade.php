    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            
            <form action="#" method="get" class="mobile-search" id="mobile-search-form">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="q" id="mobile-search" placeholder="Search product ..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>
            <div id="mobile-search-results" class="search-results" style="margin-top: -23px; overflow: hidden; "></div>
            
            <style>
            .search-results {
                position: absolute;
                background: white;
                border: 1px solid #ccc;
                width: 100%;
                max-height: 200px;
                overflow-y: auto;
                z-index: 1000;
                display: none; /* Start hidden */
            }
            
            .search-results a {
                display: block;
                padding: 8px;
                border-bottom: 1px solid #eee;
                color: #333;
                text-decoration: none;
            }
            
            .search-results a:hover {
                background-color: #f0f0f0;
            }
            </style>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#mobile-search').on('keyup', function() {
                    var query = $(this).val();
                    if (query.length > 2) {
                        console.log('Sending AJAX request with query:', query);
                        $.ajax({
                            url: "{{ route('product.search') }}",
                            type: "GET",
                            data: { q: query },
                            success: function(data) {
                                console.log('AJAX response:', data);
                                $('#mobile-search-results').html(data).show();
                                console.log('Mobile search results should be visible now');
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX error:', error);
                            }
                        });
                    } else {
                        $('#mobile-search-results').html('').hide();
                    }
                });
            
                $(document).on('click', '.search-result-item', function() {
                    var productId = $(this).data('id');
                    // Construct the URL with query parameter
                    var url = "{{ url('productdetail') }}?id=" + productId;
                    window.location.href = url;
                });
            });
            </script>
            

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="{{route('forbest')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('product')}}" class="sf-with-ul">Product</a>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                                <ul>
                                    <li>
                                        <a href="{{route('about')}}">About</a>
                                    </li>
                                    <li>
                                        <a href="{{route('contact')}}">Contact</a>
                                    </li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="{{route('faqs')}}">FAQs</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('blogall')}}">Blog</a>
                            </li>
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        @foreach($category as $key => $category)
                        <ul class="mobile-cats-menu">
                            <li><a class="mobile-cats-lead" href="{{ route('product.category', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
                        </ul><!-- End .mobile-cats-menu -->
                        @endforeach

                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->
