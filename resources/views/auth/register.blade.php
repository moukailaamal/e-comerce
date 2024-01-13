@extends('base')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Créez votre compte</h5>
                        <form action="{{ route('auth.register') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" name="name" id="nom" class="form-control" placeholder="Votre Nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Votre prénom" required>
                            </div>
                            <div class="mb-3">
                                <label for="numero" class="form-label">Numéro</label>
                                <input type="number" name="numero" id="numero" class="form-control" placeholder="Votre numéro" required>
                            </div>
                            <div class="mb-3">
                                <label for="profession" class="form-label">Profession</label>
                                <input type="text" name="profession" id="profession" class="form-control" placeholder="Votre profession" required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" name="adresse" id="adresse" class="form-control" placeholder="Votre adresse" required>
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre :</label>
                                <select id="genre" class="form-control" name="genre" required>
                                    <option value="F">Féminin</option>
                                    <option value="H">Masculin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date_naissance" class="form-label">Date de Naissance</label>
                                <input type="date" name="date_naissance" id="date_naissance" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Votre mot de passe" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Créer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
