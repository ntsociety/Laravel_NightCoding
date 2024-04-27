@extends('app.layout')
@section('titre')
    Produit
@endsection

{{-- contenu --}}
@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-header">
                @if (session('message'))
                    <div class="alert alert-success" id="success-msg">
                        {{ session('message') }}
                    </div>
                @endif
                <h4>Liste Produit <span class="badge bg-primary">{{ $totalProduit }}</span>
                    {{-- url --}}
                    <a href="{{ route('produit.create') }}" class="btn btn-primary float-end">Ajouter</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Descrition</th>
                            <th>Catégorie</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($produit->count() > 0)
                            @foreach ($produit as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset('assets/produit/images/' . $item->image) }}"
                                            style="height: 70px; width:70px; object-fit:cover;" alt="">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->prix }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('produit.show', $item->id) }}"
                                                class="btn btn-info me-2">Voir</a>
                                            <a href="{{ route('produit.edit', $item->id) }}"
                                                class="btn btn-primary me-2">Modifier</a>
                                            <form action="{{ route('produit.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Voulez-vous supprimer ce produit ?')"
                                                    type="submit">Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Pas de données</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $produit->links() }}
        </div>
    </div>

@endsection
