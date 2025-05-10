<div class="blog-posts bg-light pt-4 pb-7">
                <div class="container">
                    <h2 class="title"> @yield('name_blogs','From Our Blog')</h2><!-- End .title-lg text-center -->

                    <div class="owl-carousel owl-simple" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                },
                                "1280": {
                                    "items":4,
                                    "nav": true, 
                                    "dots": false
                                }
                            }
                        }'>
                        @foreach($Blogs as $b)

                        <article class="entry">
                            <figure class="entry-media">
                                <a href="/blogdetail/{{$b->id}}">
                                    <img src="{{ asset('uploads_blogs/blogs/' . $b->img) }}" alt="mage desc"   style=" height: 200px;">
                                </a>
                            </figure><!-- End .entry-media -->

                            <div class="entry-body">
                                <div class="entry-meta">
                                    <a href="/blogdetail/{{$b->id}}">{{$b->created_at}}</a>
                                </div><!-- End .entry-meta -->

                                <h3 class="entry-title">
                                    <a href="/blogdetail/{{$b->id}}">{{$b->Shorttitle}}</a>
                                </h3><!-- End .entry-title -->

                                <div class="entry-content">
                                    <p><p>
                                    <a href="/blogdetail/{{$b->id}}" class="read-more">Continue Reading</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                    
                        @endforeach

                    
                    </div><!-- End .owl-carousel -->
                </div><!-- End .container -->
            </div>