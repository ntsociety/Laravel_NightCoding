@extends('app.layout')
@section('titre')
    Voir Produit
@endsection

@section('content')
    <div class="col-md-6 mx-auto">
        <div class="card shadow border-0 p-4">
            <div class="card-header">
                <h4>Voir Produit <i>{{ $produit->name }}</i>
                    {{-- url --}}
                    <a href="{{ route('produit.index') }}" class="btn btn-danger float-end">Retour</a>
                </h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">{{ $produit->name }}</li>
                    <li class="list-group-item fw-bold text-success">{{ $produit->prix }}</li>
                    <li class="list-group-item">{{ $produit->description }}</li>
                    <li class="list-group-item"><i>{{ $produit->category->name }}</i></li>
                    <li class="list-group-item">
                        <a href="{{ asset('assets/produit/images/' . $produit->image) }}">
                            <img src="{{ asset('assets/produit/images/' . $produit->image) }}"
                                style="height: 300px; width:100%; object-fit:cover;" alt="">
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
