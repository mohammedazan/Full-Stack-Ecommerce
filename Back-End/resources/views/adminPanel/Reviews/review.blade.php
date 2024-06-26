@extends('adminPanel.layout.layout')

@section('main_content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Évaluation</th>
                            <th>Nom de l'utilisateur</th>
                            {{-- <th>Détails de l'évaluation du produit</th> --}}
                            <th>Nom du produit</th>
                            <th>Date</th>
                            <th>Contenu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($review as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>
                                @for ($i = 0; $i < $r->rate; $i++)
                                    <i class="fas fa-star" style="color: #ffc107;"></i>
                                @endfor
                            </td>
                            <td>{{ $r->user->name }}</td>
                            {{-- <td>{{ $r->product_id }}</td> --}}
                            <td>{{ $r->product->name }}</td>
                            <td>{{ $r->created_at }}</td>
                            <td>{{ $r->content }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

   

</div>



@endsection
