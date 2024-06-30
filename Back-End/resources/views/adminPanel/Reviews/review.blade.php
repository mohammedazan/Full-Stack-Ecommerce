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
                            {{-- <td>Action</td> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($review as  $key=>$r)
                        <tr>
                            <td>{{$key+1}}</td>
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

                            {{-- <td>
                                <div class="dropdown d-flex justify-content-center">
                                    <button class="btn btn-primary dropdown-toggle dr-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="align-items-center">
                                            <form action="{{ route('reviews.delete', ['id' => $r->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élément?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" style="background: none; border: none; padding: 0; margin: 0; color: inherit; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-primary">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td> --}}

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

   

</div>



@endsection
