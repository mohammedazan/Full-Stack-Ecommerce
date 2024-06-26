@extends('adminPanel.layout.layout')
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
    .copy-btn {
            cursor: pointer;
            background-color: #686868;
            color: white;
            border: none;
            padding: 5px 10px;
            margin-left: 10px;
            border-radius: 3px;
        }
        .message {
            color:#0a90ff;
            display: none;
            margin-left: 10px;
        }
</style>
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
    {{--  $role = Role::where('status',1)->get();<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title"></div>
            <input type="hidden" id="selectimgdiv">
            <div class="ms-auto">
                <div class="btn-group">
                    <div class="d-flex gap-3 mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            <i class="lni lni-circle-plus"></i> Add User
                        </button>
                        {{--                        <a href="#" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Add Category</a>
                    </div>
                </div>
            </div>
        </div>--}}

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom d'utilisateur</th>
                            <th>Email d'utilisateur</th>
                            <th>Date de connexion</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listuser as $key=>$user)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$user->name}}</td>
                                <td id="user-email">{{$user->email}}      
                               
                                    <!-- <button class="copy-btn" onclick="copyEmail()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                          </svg>
                                    </button> -->
                                    <!-- <span id="copy-message" class="message">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                          </svg>
                                    </span> -->
                                </td>
                              
                                  
                                    <!-- <span id="copy-message" class="message">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                          </svg>
                                    </span>
                                 -->
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(' Êtes-vous sûr de vouloir supprimer cet élément ?')">supprimer</button>
                                    </form>
                                </td>       
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        {{--                        <tr>--}}
                        {{--                            <th colspan="6"></th>--}}
                        {{--                            <th>Salary</th>--}}
                        {{--                        </tr>--}}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{--        modal--}}
        <!-- Modal -->
    

        {{--Edit --}}

        {{--        modal--}}
    </div>
    <!--end page wrapper -->
@endsection
@section('css_plugins')
    {{--    select2--}}
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    {{--    select2--}}

    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    {{--    crop--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"/>
    {{--    crop--}}
@endsection
@section('js_plugins')

    {{--select 2--}}
    <script src="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/select2/js/select2-custom.js"></script>
    {{--select 2--}}

    {{--    crop--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    {{--    crop--}}


    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
@section('js')
    <script> 
function copyEmail() {
            // Get the email text
            var emailText = document.getElementById('user-email').innerText;

            // Create a temporary input element
            var tempInput = document.createElement('input');
            tempInput.value = emailText;
            document.body.appendChild(tempInput);

            // Select the text in the input element
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text
            document.execCommand('copy');

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Show the confirmation message
            var message = document.getElementById('copy-message');
            message.style.display = 'inline';

            // Hide the confirmation message after 2 seconds
            setTimeout(function() {
                message.style.display = 'none';
            }, 2000);
        }
        $(document).ready(function () {
            $('#example').DataTable({});
        });
    </script>
    <script>
        function editSupplierInfo(id) {
            var url_link = "{{route('supplier.edit.info')}}"
            $.ajax({
                url: url_link,
                type: "get",
                data: {
                    id: id,
                },
                success: function (response) {
                    $('#updateinfo').html(response)
                    $('#supplier_edit').modal('show')
                },
                error: function (xhr) {
                    //Do Something to handle error
                }
            });


        }

        $(document).ready(function () {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });

        $('.discountType').on('change', function () {
            var selectval = $(this).val();
            if (selectval == 0) {
                $('#discountAmount').attr('placeholder', 'Total Discount');
            }
            if (selectval == 1) {
                $('#discountAmount').attr('placeholder', 'Discount (%)');
            }
        })
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
                aspectRatio: 2,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 400,
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
                    // $('#productImglist').append(`
                    //   <div class="col-sm-3 mb-2" style="position:relative" id="${uniqnumber}" >
                    //    <div class="remocespen" onclick="removeImage(${uniqnumber})" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle imgsvg removebtn"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></div>
                    //    <div onclick="selectImage(${uniqnumber})">
                    //    <input type="hidden" name="product_img[]" class="${uniqnumber}input">
                    //        <div class="imgaddcard d-flex justify-content-center align-items-center ${uniqnumber}view " >
                    //            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#171e243d" class="feather feather-camera imgsvg"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    //        </div>
                    //     </div>
                    //     </div>
                    // `)
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
        function discountType(data){

            if($(data).val()==0){
                $('#discount').html(`<label for="inputStarPoints" class="form-label">Discount Amount</label><input type="number" name="discount" class="form-control" placeholder="Amount">`)
            }
            if($(data).val()==1){
                $('#discount').html(`  <label for="inputStarPoints" class="form-label">Discount (%)</label>
                                            <input type="number" name="discount" class="form-control" placeholder="Percentage (%)" required>`)
            }
        }


    </script>

@endsection
