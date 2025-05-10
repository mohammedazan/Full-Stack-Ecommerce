@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name User</th>
                                <th>Name Product</th>
                                {{-- <th>QTY</th> --}}
                                <th>Order Status</th>
                                {{-- <th>Total </th> --}}
                                {{-- <th>Created At</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commande as $key=>$c)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $c->users->name }}</td>
                                    <td>
                                        @foreach($c->lignecommande as $lc)
                                            {{ $lc->product->name}} ({{ $lc->qte }}) <br>
                                        @endforeach
                                    </td>
                                    {{-- <td>
                                        {{ $lc->qte }}
                                    </td> --}}
                
                                @if($c->etat === "en cours")
                                    <td>
                                        <span class="badge bg-danger">
                                            {{$c->etat}}
                                    </span>
                                </td>
                                @endif
                                


                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">Action</button>
                                        <ul class="dropdown-menu" style="">
                                       
                                            <li class="align-items-center"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                                <form action="{{ route('commande.delete', $c->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-trash text-primary">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg>
            
                                                        delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                
                                
                                

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('css_plugins')
    <link href="{{ asset('assets/adminPanel') }}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection

@section('js_plugins')
    <script src="{{ asset('assets/adminPanel') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/adminPanel') }}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({});
        });
    </script>
@endsection
