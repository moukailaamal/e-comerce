@extends('base')

@section('title', 'Les catégories')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Catégories</h1>
        <a class="btn btn-primary mb-3" href="{{ route('categories.create') }}">Créer une nouvelle catégorie</a>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Modifier</th>
                    <th class="text-center">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                    <tr>
                        <td class="text-center">{{ $categorie->id }}</td>
                        <td class="text-center">{{ $categorie->name }}</td>
                        <td class="text-center">
                            <a class="btn btn-info" href="{{ route('categories.edit', $categorie->id) }}">Modifier</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
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
