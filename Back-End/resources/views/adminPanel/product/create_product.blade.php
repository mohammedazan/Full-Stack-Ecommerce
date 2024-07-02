@extends('adminPanel.layout.layout')
@section('css')
    <style>
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>
@endsection

@section('main_content')
    <div class="page-content">
        <div class="card">
            <input type="hidden" id="selectimgdiv">
            <div class="card-body p-4">
                <div class="form-body mt-4">
                    <form action="{{route('admin.store.product')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="inputProductTitle" class="form-label">Nom du produit<strong
                                                        class="text-danger">*</strong> </label>
                                                <input type="text" class="form-control" name="name"
                                                       id="inputProductTitle"
                                                       placeholder="Entrez le nom du produit" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-2">
                                                <label for="single-select-field" class="form-label">Catégorie du produit
                                                    <strong class="text-danger">*</strong> </label>
                                                <select class="form-select" onchange="getSubcategory(this)"
                                                        name="category_id" id="single-select-field"
                                                        data-placeholder="Choisir une catégorie" required>
                                                    <option></option>
                                                    @foreach($productCategory as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-2">
                                                <label for="single-select-field" class="form-label">Sous-catégorie du produit</label>
                                                <select class="form-select select2 " id="subcategory_id"
                                                        name="subcategory_id" data-placeholder="Choisir une sous-catégorie">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputProductType" class="form-label">Fournisseur</label>
                                            <select name="supplier_id" class="form-select select2" id="inputProductType"
                                                    data-placeholder="Choisir un fournisseur">
                                                <option></option>
                                                @foreach($supplierList as $supplier)
                                                    <option
                                                        value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Marque</label>
                                                <select class="form-control form-control-color w-100"   name="brand_id" >
                                                    <option value="">Aucune marque</option>
                                                    @foreach($brand as $dataBrand)
                                                        <option value="{{$dataBrand->id}}">{{$dataBrand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputProductType" class="form-label">Couleur</label>
                                            <select class="js-example-basic-multiple form-control form-control-color w-100"   name="color[]" multiple="multiple">
                                                @foreach($color as $dataColor)
                                                    <option value="{{$dataColor->name}}">{{$dataColor->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputProductType" class="form-label">Référence
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="reference"
                                                    id="inputProductreference"
                                                    placeholder="Entrez le nom de référence" required data-role="tagsinput" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="inputProductDescription"
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Photo du produit</label>
                                        <input style="display:none" type="file" name="image" class="image">
                                        <div class="row" id="productImglist">
                                            <div class="col-sm-3 mb-2" style="position:relative" id="222"
                                                 onclick="selectImage('222')">
                                                <span class="text-center mainphototxt">Photo principale</span>
                                                <input type="hidden" name="product_img[]" multiple class="222input">
                                                <!--input type="file" name="product_img[]" multiple class="form-control"-->
                                                <div
                                                    class="imgaddcard d-flex justify-content-center align-items-center 222view ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-camera text-primary imgsvg">
                                                        <path
                                                            d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                                        <circle cx="12" cy="13" r="4"></circle>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade modalimage" id="modal" tabindex="-1" role="dialog"
                                             aria-labelledby="modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel">Recadrer l'image</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">�</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="img-container">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <!--  default image where we will set the src via jquery-->
                                                                    <img id="image">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="preview"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler
                                                        </button>
                                                        <button type="button" class="btn btn-primary" id="crop">Recadrer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Coût d'achat <small>Prix_V_HT</small>
                                                <strong class="text-danger">*</strong>
                                            </label>
                                            <input type="number" name="current_purchase_cost"
                                                   value="{{old('current_purchase_cost')}}" id="wholesalepricce"
                                                   class="form-control" id="inputCostPerPrice" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Prix de vente <small>Prix_V_TTC</small> <strong
                                                    class="text-danger">*</strong> </label>
                                            <input type="number" name="previous_wholesale_price"
                                                   value="{{old('previous_wholesale_price')}}" class="form-control"
                                                   id="inputPrice" placeholder="00.00" required>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Prix de gros</label>
                                            <input type="number" name="current_wholesale_price"
                                                   value="{{old('current_wholesale_price')}}" class="form-control"
                                                   id="wholesalepricce" placeholder="00.00">
                                        </div> --}}  
                                        <div class="col-md-6">
                                            <label for="inputStarPoints" class="form-label">Quantité</label>
                                            <input type="number" name="wholesale_minimum_qty" class="form-control"
                                                   id="inputStarPoints" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputStarPoints" class="form-label">Type de réduction</label>
                                            <select name="discount_type" class="form-control" id=""
                                                    onchange="discountType(this)">
                                                <option value="0">Fixe</option>
                                                <option value="1">Pourcentage (%)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6" id="discount">
                                            <label for="inputStarPoints" class="form-label">Montant de réduction</label>
                                            <input type="number" name="discount" class="form-control"
                                                   placeholder="Montant">
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="is_trending" type="checkbox"
                                                       value="1">
                                                <label class="form-check-label">
                                                    Tendance
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="is_popular" type="checkbox"
                                                       value="1">
                                                <label class="form-check-label">
                                                    Populaire
                                                </label>
                                            </div>
                                        </div> --}}
                                        
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Enregistrer le produit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css_plugins')
    {{--    select2--}}
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    {{--    select2--}}
    {{--    crop--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"/>
    {{--    crop--}}
@endsection
@section('js_plugins')
    {{--select 2--}}
        <script src="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{asset('assets/adminPanel')}}/plugins/input-tags/js/tagsinput.js"></script>
        <script src="{{asset('assets/adminPanel')}}/plugins/select2/js/select2-custom.js"></script>
    {{--select 2--}}
    {{--    crop--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    {{--    crop--}}
@endsection
@section('js')

    <script>
        $('.select2').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        function getSubcategory(data) {
            var category_id = $(data).val();
            // alert(category_id)

            var url_link = "{{route('subcategory.list.get')}}"
            $.ajax({
                url: url_link,
                type: "get",
                data: {
                    category_id: category_id,
                },
                success: function (response) {
                    $('#subcategory_id').html(response)
                },
                error: function (xhr) {
                    //Do Something to handle error
                }
            });
        }

    </script>

    <script>

        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;


        $("body").on("change", ".image", function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                bs_modal.modal('show');
            };

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        bs_modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 0,
                viewMode: 0,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 0,
                height: 0,
            });

            canvas.toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;

                    let inputvaluocation = $('#selectimgdiv').val() + 'input';
                    let viewlocation = $('#selectimgdiv').val() + 'view';
                    var uniqnumber = new Date().valueOf();

                    $('.' + inputvaluocation).val(base64data)
                    $('.' + viewlocation).html(`  <img class="imgaddborder" src="${base64data}" height="100%" width="100%" alt="">`);
                    $('#productImglist').append(`
                      <div class="col-sm-3 mb-2" style="position:relative" id="${uniqnumber}" >
                       <div class="remocespen" onclick="removeImage(${uniqnumber})" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle imgsvg removebtn"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></div>
                       <div onclick="selectImage(${uniqnumber})">
                       <input type="hidden" name="product_img[]" class="${uniqnumber}input">
                           <div class="imgaddcard d-flex justify-content-center align-items-center ${uniqnumber}view " >
                               <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#171e243d" class="feather feather-camera imgsvg"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                           </div>
                        </div>
                        </div>
                    `)
                    $(".modalimage").modal('hide');


                };
            });
        });


        function selectImage(data) {
            $('#selectimgdiv').val(data);
            $('.image').click();
        }

        function removeImage(id) {
            $('#' + id).html(`<div class="remocespen" onclick="removeImage(${id})" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle imgsvg removebtn"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></div>
                       <div onclick="selectImage(${id})">
                       <input type="hidden" name="product_img[]" class="${id}input">
                           <div class="imgaddcard d-flex justify-content-center align-items-center ${id}view " >
                               <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#171e243d" class="feather feather-camera imgsvg"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                           </div>
                        </div>`);
        }

        function discountType(data) {

            if ($(data).val() == 0) {
                $('#discount').html(`<label for="inputStarPoints" class="form-label">Discount Amount</label><input type="number" name="discount" class="form-control" placeholder="Amount">`)
            }
            if ($(data).val() == 1) {
                $('#discount').html(`  <label for="inputStarPoints" class="form-label">Discount (%)</label>
                                            <input type="number" name="discount" class="form-control" placeholder="Percentage (%)" required>`)
            }
        }

        function    addnewcolor(){
            // alert('sdfs')
            const color=`<span><input type="color" name="product_color[]" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color"></span>`;
            $('#color').append(color)
        }


        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });


    </script>
@endsection
