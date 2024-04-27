@extends('app.layout')
@section('titre')
    Modifier
@endsection

@section('content')
    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h4>Modifier Produit <i>{{ $produit->name }}</i>
                    {{-- url --}}
                    <a href="{{ route('produit.index') }}" class="btn btn-danger float-end">Retour</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('produit.update', $produit->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <select name="category_id" id=""
                            class="form-select @error('category_id') is-invalid @enderror">
                            <option value="{{ $produit->category->id }}" selected>{{ $produit->category->name }}</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="name" value="{{ $produit->name }}" placeholder="Nom du produit"
                            id="" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" name="prix" value="{{ $produit->prix }}" placeholder="Prix du produit"
                            id="" class="form-control @error('prix') is-invalid @enderror">
                        @error('prix')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <textarea name="description" id="" placeholder="Description" rows="5"
                            class="form-control @error('description') is-invalid @enderror">{{ $produit->description }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <a href="{{ asset('assets/produit/images/' . $produit->image) }}">
                            <img src="{{ asset('assets/produit/images/' . $produit->image) }}"
                                style="height: 100px; width:100%; object-fit:cover;" alt="">
                        </a>
                        <input type="file" name="image" id=""
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn btn-outline-primary" type="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
