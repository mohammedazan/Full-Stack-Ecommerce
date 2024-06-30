<div class="row">
    <div class="col-lg-8">
        <div class="border border-3 p-4 rounded">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="inputProductTitle" class="form-label">Product Name</label>
                        <p>{{$productInfo->name}}</p>
                        
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <label for="single-select-field" class="form-label">Product Category</label>
                        <p>{{$productInfo->category->name}}</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <label for="single-select-field" class="form-label">Product Subcategory</label>
                        <p>{{$productInfo->subcategory->name}}</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="inputProductType" class="form-label">Supplier</label>
                    <p>{{$productInfo->supplier->supplier_name}}</p>
                </div>
                <div class="col-sm-6">
                    <label for="inputProductType" class="form-label">Color</label>
                    <div class="colorinputdiv" id="color">
                        @foreach(explode(",", $productInfo->color) as $data)
                            <span style="background-color:{{$data}};width:20px;height:20px;display:inline-block;"></span>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Size</label>
                        <p>{{$productInfo->size}}</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="inputProductDescription" class="form-label">Description</label>
                        <p>{{$productInfo->description}}</p>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Product Photo</label>
                <div class="row" id="productImglist">
                    <div class="col-sm-3 mb-2">
                        <img src="{{asset($productInfo->image_path)}}" width="100%" alt="">
                    </div>
                    @foreach($productInfo->productImage as $image)
                        <div class="col-sm-3 mb-2">
                            <img src="{{asset($image->image)}}" width="100%" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="border border-3 p-4 rounded">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="inputCostPerPrice" class="form-label">Purchase Cost</label>
                    <p>{{$productInfo->current_purchase_cost}}</p>
                </div>
                <div class="col-md-6">
                    <label for="inputPrice" class="form-label">Sell Price</label>
                    <p>{{$productInfo->current_sale_price}}</p>
                </div>
                <div class="col-md-6">
                    <label for="inputCompareatprice" class="form-label">Wholesale Price</label>
                    <p>{{$productInfo->current_wholesale_price}}</p>
                </div>
                <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Wholesale Qty</label>
                    <p>{{$productInfo->wholesale_minimum_qty}}</p>
                </div>
                <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Discount Type</label>
                    <p>{{$productInfo->discount_type == 0 ? 'Fixed' : 'Percentage'}}</p>
                </div>
                @if($productInfo->discount_type == 0)
                    <div class="col-md-6">
                        <label for="inputStarPoints" class="form-label">Discount Amount</label>
                        <p>{{$productInfo->discount}}</p>
                    </div>
                @else
                    <div class="col-md-6">
                        <label for="inputStarPoints" class="form-label">Discount (%)</label>
                        <p>{{$productInfo->discount}}</p>
                    </div>
                @endif
                <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Is Trending</label>
                    <p>{{$productInfo->is_trending ? 'Yes' : 'No'}}</p>
                </div>
                <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Is Popular</label>
                    <p>{{$productInfo->is_popular ? 'Yes' : 'No'}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
