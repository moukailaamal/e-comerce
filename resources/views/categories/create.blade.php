@extends('base')

@section('title', 'Créer une catégorie')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 border p-4 rounded">
            <h4 class="text-center mb-4" style="color: #007bff;">Créer votre catégorie</h4>
            <form action="{{ route('categories.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label" style="color: #555;">Nom de la catégorie</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Votre nom">
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #28a745; border-color: #28a745;">Créer</button>
            </form>
        </div>
    </div>
</div>

@endsection
