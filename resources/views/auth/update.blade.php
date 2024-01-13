@extends('base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Modifiez votre compte</h5>
                    <form method="POST" action="{{ route('auth.update', ['id' => Auth::user()->id]) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" id="nom" class="form-control" placeholder="Votre Nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" id="prenom" class="form-control" placeholder="Votre prénom" required>
                        </div>
                        <div class="mb-3">
                            <label for="numero" class="form-label">Numéro</label>
                            <input type="number" name="numero" value="{{ old('numero', $user->numero) }}" id="numero" class="form-control" placeholder="Votre numéro" required>
                        </div>
                        <div class="mb-3">
                            <label for="profession" class="form-label">Profession</label>
                            <input type="text" name="profession" id="profession" value="{{ old('profession', $user->profession) }}" class="form-control" placeholder="Votre profession" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" name="adresse" value="{{ old('adresse', $user->adresse) }}" id="adresse" class="form-control" placeholder="Votre adresse" required>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre :</label>
                            <select id="genre" class="form-control" name="genre" required>
                                <option value="F" {{ old('genre', $user->genre) == 'F' ? 'selected' : '' }}>Féminin</option>
                                <option value="H" {{ old('genre', $user->genre) == 'H' ? 'selected' : '' }}>Masculin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">Date de Naissance</label>
                            <input type="date" name="date_naissance" value="{{ old('date_naissance', $user->date_naissance) }}" id="date_naissance" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" value="{{ old('email', $user->email) }}" name="email" id="email" class="form-control" placeholder="Votre email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Votre mot de passe">
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection