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
                                <th>Deliver Status</th> 
                                <th>Total </th>
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
                                    
                                @if($c->etat === "payee")
                                    <td><span class="badge bg-success">
                                        {{$c->etat}}
                                    </span></td>
                                @else
                                    <td>
                                        <span class="badge bg-danger">
                                        {{$c->etat}}
                                        </span>
                                    </td>
                                @endif

                                <td>
                                    <form action="{{ route('commande.updateStatus', $c->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="deliver_status" class="form-select" onchange="this.form.submit()">
                                            <option value="processed" {{ $c->deliver_status === 'processed' ? 'selected' : '' }}>Processed</option>
                                            <option value="delivered" {{ $c->deliver_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        </select>
                                    </form>
                                </td>

                                <td>{{ $c->getTotal()}}DH</td>

                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">Action</button>
                                        <ul class="dropdown-menu" style="">
                                       
                                               <li>
                                                <a href="{{ route('commande.details', $c->id) }}" class="dropdown-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-eye text-primary">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                                    </svg>
                                                    See the details
                                                </a>
                                            </li>
                                            
                                            <li class="align-items-center"
                                                onclick="return confirm('Are you sure you want to delete this command ?');">
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
                                                        delete4
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
