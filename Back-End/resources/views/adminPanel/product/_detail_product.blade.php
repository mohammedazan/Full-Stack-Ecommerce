<div class="row">
    <div class="col-lg-8">
        <div class="border border-3 p-4 rounded">
            <div class="row">
                <div class="col-sm-6">
                    <input type="hidden" name="product_id" value="{{ $productInfo->id }}">
                    <div class="mb-3">
                        <label for="inputProductTitle" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $productInfo->name }}" id="inputProductTitle" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <label for="single-select-field" class="form-label">Product Category</label>
                        <select class="form-select" name="category_id" id="single-select-field" disabled>
                            @foreach($productCategory as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $productInfo->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <label for="single-select-field" class="form-label">Product Subcategory</label>
                        <select class="form-select" id="subcategory_id" name="subcategory_id" disabled>
                            @foreach($productSubcategory as $subcategory)
                                <option value="{{ $subcategory->id }}" {{ $subcategory->id == $productInfo->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="inputProductType" class="form-label">Supplier</label>
                    <select name="supplier_id" class="form-select select2" id="inputProductType" disabled>
                        @foreach($supplierList as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == $productInfo->supplier_id ? 'selected' : '' }}>{{ $supplier->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="inputProductType" class="form-label">Color</label>
                    <div class="colorinputdiv" id="color">
                        @foreach(explode(",", $productInfo->color) as $data)
                            <span><input type="color" name="product_color[]" class="form-control form-control-color" value="{{ $data }}" disabled></span>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Size</label>
                        <input type="text" id="myInput" name="size" class="form-control" data-role="tagsinput" value="{{ $productInfo->size }}" readonly>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="inputProductDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="inputProductDescription" rows="3" readonly>{{ $productInfo->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Product Photo</label>
                <div class="row" id="productImglist">
                    <div class="col-sm-3 mb-2">
                        <span class="text-center mainphototxt">Main Photo</span>
                        <div class="imgaddcard d-flex justify-content-center align-items-center">
                            <img class="imgaddborder" src="{{ asset($productInfo->image_path) }}" width="100%" alt="">
                        </div>
                    </div>
                    @foreach($productInfo->productImage as $image)
                        <div class="col-sm-3 mb-2">
                            <div class="imgaddcard d-flex justify-content-center align-items-center">
                                <img class="imgaddborder" src="{{ asset($image->image) }}" width="100%" alt="">
                            </div>
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
                    <input type="number" name="current_purchase_cost" value="{{ $productInfo->current_purchase_cost }}" class="form-control" id="inputCostPerPrice" readonly>
                </div>
                <div class="col-md-6">
                    <label for="inputPrice" class="form-label">Sell Price</label>
                    <input type="number" name="current_sale_price" value="{{ $productInfo->current_sale_price }}" class="form-control" id="inputPrice" readonly>
                </div>
                <div class="col-md-6">
                    <label for="inputCompareatprice" class="form-label">Wholesale Price</label>
                    <input type="number" name="current_wholesale_price" value="{{ $productInfo->current_wholesale_price }}" class="form-control" id="wholesalepricce" readonly>
                </div>
                <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Wholesale Qty</label>
                    <input type="number" name="wholesale_minimum_qty" value="{{ $productInfo->wholesale_minimum_qty }}" class="form-control" id="inputStarPoints" readonly>
                </div>
                <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Discount Type</label>
                    <select name="discount_type" class="form-control" disabled>
                        <option value="0" {{ $productInfo->discount_type == 0 ? 'selected' : '' }}>Fixed</option>
                        <option value="1" {{ $productInfo->discount_type == 1 ? 'selected' : '' }}>Percentage (%)</option>
                    </select>
                </div>
                <div class="col-md-6" id="discount">
                    <label for="inputStarPoints" class="form-label">Discount Amount</label>
                    <input type="number" name="discount" value="{{ $productInfo->discount }}" class="form-control" placeholder="Amount" readonly>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="is_trending" type="checkbox" value="1" {{ $productInfo->is_trending == 1 ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="flexCheckDisabled">Is Trending</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="is_popular" type="checkbox" value="1" {{ $productInfo->is_popular == 1 ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="flexCheckDisabled">Is Popular</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
