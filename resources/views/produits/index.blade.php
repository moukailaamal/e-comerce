@extends('base')

@section('title', 'Les articles')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Articles</h1>
        <a class="btn btn-primary mb-3" href="{{ route('produits.create') }}">Créer un nouveau produit</a>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Prix</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Catégorie</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Modifier</th>
                    <th class="text-center">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produits as $produit)
                    <tr>
                        <td class="text-center">{{ $produit->id }}</td>
                        <td class="text-center">{{ $produit->name }}</td>
                        <td class="text-center">{{ $produit->prix }}</td>
                        <td class="text-center">{{ $produit->stock }}</td>
                        <td class="text-center">{{ $produit->description }}</td>
                        <td class="text-center">{{ $produit->categorie->name }}</td>
                        <td class="text-center">
                            <img src="{{ asset($produit->image_path) }}" alt="Image du produit" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td class="text-center">
                            <a class="btn btn-info" href="{{ route('produits.edit', $produit->id) }}">Modifier</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
