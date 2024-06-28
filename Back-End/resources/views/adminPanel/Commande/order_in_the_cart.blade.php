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
                                <th>QTY</th>
                                <th>Order Status</th>
                                <th>Total Payable</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commande as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->users->name }}</td>
                                    <td>
                                        @foreach($c->lignecommande as $lc)
                                            {{ $lc->product->name }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $lc->qte }}
                                    </td>
                                    
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

                                <td>{{ $c->getTotal()}}DH</td>
                                <td>{{ $c->created_at }}</td>
                                

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
