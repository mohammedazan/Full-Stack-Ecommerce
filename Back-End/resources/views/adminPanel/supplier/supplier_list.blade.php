@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title">Liste des fournisseurs</div>

            <div class="ms-auto">
                <div class="btn-group">
                    <div class="d-flex gap-3 mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            <i class="lni lni-circle-plus"></i> Ajouter un fournisseur
                        </button>
                        {{--                        <a href="#" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Ajouter une catégorie</a>--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom du fournisseur</th>
                            <th>Téléphone</th>
                            <th>Adresse du fournisseur</th>
                            <th>Nom de la société</th>
                            <th>Infos sur la société</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($suppliers as $key=>$supplierList)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                   <strong class="namest">Nom</strong> :  {{$supplierList->supplier_name}} <br>
                                   <strong class="namest">Email</strong> :  {{$supplierList->supplier_email}} <br>

                                </td>
                                <td>
                                    {{$supplierList->supplier_phone_one}}
                                    <br>
                                    {{$supplierList->supplier_phone_two}}
                                </td>
                                <td>{{$supplierList->supplier_address}}</td>
                                <td>{{$supplierList->company_name}}</td>
                                <td>
                                    @if($supplierList->company_phone)
                                   <span> <strong class="namest">Téléphone : </strong>{{$supplierList->company_phone}}</span> <br>
                                        @endif
                                        {{$supplierList->company_address}}
                                        </td>
                                    <td>
                                        <div class="dropdown d-flex justify-content-center">
                                            <button class="btn btn-primary dropdown-toggle dr-btn" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">Paramètres
                                            </button>
                                            <ul class="dropdown-menu" style="">
                                                <li onclick="editSupplierInfo({{$supplierList->id}})"><a class="dropdown-item"
                                                                                      href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-edit text-primary">
                                                        <path
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path
                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>
                                                    Modifier</a>
                                            </li>
                                            <li class="align-items-center"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.delete.category',['id'=>1])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-trash text-primary">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                        
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                    Supprimer</a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                        <tfoot>
{{--                        <tr>--}}
{{--                            <th colspan="6"></th>--}}
{{--                            <th>Salaire</th>--}}
{{--                        </tr>--}}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{--        modal--}}
        <!-- Modal -->
        <form action="{{route('admin.store.supplier')}}" method="post">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Créer un fournisseur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6" style="border-right:1px solid #dfdada">
                                    <div class="mb-2 row">
                                        <div class="col-sm-12"><h6 class="titleheadst">Infos sur le fournisseur</h6></div>
                                        <div class="col-sm-6">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Nom du fournisseur
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="supplier_name"
                                                       placeholder="Nom du fournisseur" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Téléphone du fournisseur
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="supplier_phone_one"
                                                       placeholder="Téléphone du fournisseur" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Téléphone du fournisseur 2
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="supplier_phone_two"
                                                       placeholder="Téléphone du fournisseur 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Email du fournisseur
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="supplier_email"
                                                       placeholder="Email du fournisseur">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="supplier_address" class="col-sm-12  pr-0 col-form-label">Adresse du fournisseur
                                            </label>
                                            <div class="col-sm-12">
                                                <textarea name="supplier_address" class="form-control"
                                                          id="supplier_address" cols="10" rows="3"
                                                          placeholder="Adresse du fournisseur"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6" style="border-right:1px solid #dfdada">
                                    <div class="col-sm-12 "><h6 class="titleheadst">Infos sur la société</h6></div>
                                    <div class="mb-2 row">
                                        <div class="col-sm-6">
                                            <label for="company_name" class="col-sm-12  pr-0 col-form-label">Nom de la société
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="company_name" class="form-control"
                                                       name="company_name"
                                                       placeholder="Nom de la société" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="company_phone" class="col-sm-12  pr-0 col-form-label">Téléphone de la société
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="company_phone" class="form-control"
                                                       name="company_phone"
                                                       placeholder="Téléphone de la société" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="com_email" class="col-sm-12  pr-0 col-form-label">Email de la société
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="com_email" class="form-control"
                                                       name="company_email"
                                                       placeholder="Email de la société">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="due" class="col-sm-12  pr-0 col-form-label">Solde dû précédent
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="number" id="due" class="form-control" name="previous_due"
                                                       placeholder="Solde dû" step="any" min="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="company_address" class="col-sm-12  pr-0 col-form-label">Adresse de la société
                                            </label>
                                            <div class="col-sm-12">
                                                <textarea name="company_address" class="form-control"
                                                          id="company_address" cols="10" rows="3"
                                                          placeholder="Adresse de la société"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end p-3">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </div>

                </div>
            </div>
    </form>

    {{--Modifier --}}
    <form action="{{route('admin.update.supplier')}}" method="post">
        @csrf
        <div class="modal fade" id="supplier_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier le fournisseur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body" id="updateinfo">

                    </div>
                    <div class="d-flex justify-content-end p-3">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{--        modal--}}
    </div>
    <!--end page wrapper -->
@endsection

@section('css_plugins')
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({});
        });
    </script>
    <script>
        function editSupplierInfo(id) {
            var url_link="{{route('supplier.edit.info')}}"
            $.ajax({
                url: url_link,
                type: "get",
                data: {
                    id:id,
                },
                success: function(response) {
                    $('#updateinfo').html(response)
                    $('#supplier_edit').modal('show')
                },
                error: function(xhr) {
                    //Do Something to handle error
                }});


        }

        $(document).ready(function () {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>

@endsection
