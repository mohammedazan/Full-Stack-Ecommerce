@extends('adminPanel.layout.layout')

@section('main_content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @if($commande)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h4 class="text-primary">Order Details</h4>
                                    <hr>
                                    {{-- <p><strong>Order ID:</strong> {{ $commande->id }}</p> --}}
                                    <p><strong>Date of purchase of the product :</strong>{{ $commande->created_at }}</p>
                                    <p><strong>Customer Name:</strong> {{ $commande->first_name }} {{ $commande->last_name }}</p>
                                    <p><strong>Email:</strong> {{ $commande->email }}</p>
                                    <p><strong>Phone:</strong> {{ $commande->phone }}</p>
                                    <p><strong>Address:</strong><br>
                                        @if($commande->city)
                                        {{ $commande->city->name }},
                                    @endif
                                        {{ $commande->street_address }},<br>
                                    {{ $commande->postcode }}</p>
                                    <p><strong>Company Name:</strong> {{ $commande->company_name }}</p>


                                    @if($commande->city->country)
                                    <p><strong>Country:</strong> {{ $commande->city->country->name }}</p>
                                @endif

      

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h4 class="text-primary">Products Ordered</h4>
                                    <hr>
                                    <ul class="list-group">
                                        @foreach($commande->lignecommande as $lc)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $lc->product->name }}
                                                <span class="badge bg-success rounded-pill">Quantity: {{ $lc->qte }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <p>No order details found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
