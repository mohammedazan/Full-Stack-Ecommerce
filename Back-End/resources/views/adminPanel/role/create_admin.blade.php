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
</style>
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title"></div>
            <input type="hidden" id="selectimgdiv">
            <div class="ms-auto">
                <div class="btn-group">
                    <div class="d-flex gap-3 mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            <i class="lni lni-circle-plus"></i> Ajouter Utilisateur
                        </button>
                        {{--                        <a href="#" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Add Category</a>--}}
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
                            <th>Nom Admin</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($admin as $key=>$admindata)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$admindata->name}}</td>
                                <td> {{$admindata->email}}</td>
                                <td>{{ $admindata->role ? $admindata->role->name : 'Aucun Rôle' }}</td>
                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Paramètres
                                        </button>
                                        <ul class="dropdown-menu" style="">
{{--                                            <li onclick="editSupplierInfo({{$offerList->id}})"><a--}}
{{--                                                    class="dropdown-item"--}}
{{--                                                    href="#">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"--}}
{{--                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"--}}
{{--                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                         class="feather feather-edit text-primary">--}}
{{--                                                        <path--}}
{{--                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>--}}
{{--                                                        <path--}}
{{--                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>--}}
{{--                                                    </svg>--}}
{{--                                                    Modifier</a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}

{{--                                                <a--}}
{{--                                                    class="dropdown-item"--}}
{{--                                                    href="#">--}}
{{--                                                    <i class="lni lni-offer"--}}
{{--                                                       style="    color: #008cff!important;font-size: 21px;"></i>--}}
{{--                                                    Configuration d'offre</a>--}}
{{--                                            </li>--}}
                                            <li class="align-items-center"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.admin.delete',['id'=>$admindata->id])}}">
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
                        {{--                            <th>Salary</th>--}}
                        {{--                        </tr>--}}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{--        modal--}}
        <!-- Modal -->
        <form action="{{route('admin.admin.store')}}" method="post">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Créer Utilisateur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12" style="border-right:1px solid #dfdada">
                                    <div class="mb-2 row">
                                        <div class="col-sm-12">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Nom
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="name"
                                                       placeholder="Nom" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Email
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="email"
                                                       placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-2">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Rôle
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <select name="role_id" class="form-control" id="" required>
                                                    <option value="">SÉLECTIONNER UN RÔLE</option>
                                                    @foreach($role as $roledata)
                                                        <option value="{{$roledata->id}}">{{$roledata->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-2">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Mot de passe
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="password" id="inputname" class="form-control"
                                                       name="password"
                                                       placeholder="Mot de passe" required>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end p-3">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        {{--Edit --}}
        <form action="{{route('admin.update.supplier')}}" method="post">
            @csrf
            <div class="modal fade" id="supplier_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier Fournisseur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    </div>
    </div>
    <!--end page wrapper -->
    <!--end page-wrapper-->
@endsection
@section('scripts')
    <script>

    </script>
@endsection

