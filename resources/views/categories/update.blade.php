@extends('base')

@section('title', 'Modifier une catégorie')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 border p-4 rounded">
            <h4 class="text-center mb-4" style="color: #007bff;">Modifier votre catégorie</h4>
            <form action="{{ route('categories.update', $categorie->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label" style="color: #555;">Nom de la catégorie</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $categorie->name }}">
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #28a745; border-color: #28a745;">Modifier</button>
            </form>
        </div>
    </div>
</div>

@endsection
