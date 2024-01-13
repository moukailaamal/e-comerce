@extends('base')

@section('title', 'Modifier un produit')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 border p-4 rounded">
            <h4 class="text-center mb-4" style="color: #007bff;">Modifier votre produit</h4>
            <form action="{{ route('produits.update', $produit->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label" style="color: #555;">Nom du produit</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $produit->name }}">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label" style="color: #555;">Prix</label>
                    <input type="number" name="prix" id="prix" class="form-control" value="{{ $produit->prix }}">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label" style="color: #555;">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ $produit->stock }}" placeholder="Stock" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label" style="color: #555;">Description</label>
                    <textarea id="description" maxlength="255" name="description" class="form-control" placeholder="Décrire">{{ $produit->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label" style="color: #555;">Choisir l'image</label>
                    <input class="form-control" name="image" type="file" id="image">
                </div>
                <div class="mb-3">
                    <label for="categorie_id" class="form-label" style="color: #555;">Sélectionner la catégorie</label>
                    <select id="categorie_id" name="categorie_id" class="form-select">
                        @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #28a745; border-color: #28a745;">Modifier</button>
            </form>
        </div>
    </div>
</div>

@endsection
