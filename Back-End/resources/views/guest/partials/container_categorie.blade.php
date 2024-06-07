    <!-- start .container_categorie -->
            <div class="container">
                <h2 class="title text-center mb-2">Explore Popular Categories</h2><!-- End .title -->

                <div class="cat-blocks-container">
                    <div class="row">
                        @php
                        // Shuffle the category collection and take the first six
                        $randomCategories = $category->shuffle()->take(6);
                    @endphp
                    
                    @foreach($randomCategories as $key => $categorylist)
                    @php
                    $id = $categorylist->id
                    @endphp
                        <div class="col-6 col-sm-4 col-lg-2">
                            <a href="{{ route('product.category', ['id' => $id]) }}"  class="cat-block">
                                <figure>
                                    <span>
                                        <img src="{{ asset($categorylist->image) }}" alt="Category image">
                                    </span>
                                </figure>
                                <br>
                                <h3 class="cat-block-title">{{ $categorylist->name }}</h3><!-- End .cat-block-title -->
                            </a>
                        </div>
                    @endforeach<!-- End .col-sm-4 col-lg-2 -->
                    </div><!-- End .row -->
                </div><!-- End .cat-blocks-container -->
            </div>
            <!-- End .container -->
