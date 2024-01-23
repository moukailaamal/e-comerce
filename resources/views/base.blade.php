<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-w3f7F/zEZ8QAzGgGgEszZKVF5mnnFkL69eJf5J4XJrebeIZJ8InFVMZjDfNPQbyXVeNzV1k5FkLQsnj5qPc+f3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif



    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('storage/image/logo.png') }}" alt="logo" style="width: 80px; height: 40px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                            <i class="bi bi-house-door"></i> Accueil
                        </a>
                    </li>
                    @auth
                    @if(Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produits.index') }}">Produits</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('command.index', ['id' => Auth::user()->id])}}">
                            Liste de commande
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        @auth
                        <div class="dropdown">
                            <a class="nav-link ml-0 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> Mon profil
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-header">{{ Auth::user()->name }}</div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user"></i> {{ Auth::user()->prenom }}</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-map-marker-alt"></i> {{ Auth::user()->adresse }}</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-phone"></i> {{ Auth::user()->numero }}</a>
                                <div class="dropdown-divider"></div>
                                @if(auth()->user()->role == 'client')
                                <a href="{{ route('auth.edit', ['id' => Auth::user()->id]) }}" class="dropdown-item btn btn-link">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <a class="dropdown-item btn btn-link" href="{{ route('command.index', ['id' => Auth::user()->id])}}">
                                    <i class="fas fa-history mr-1"></i> Historique
                                </a>

                                @endif
                                <form method="POST" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn btn-link">
                                        <i class="bi bi-box-arrow-right"></i> Se déconnecter
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endauth
                    </li>

                    @unless(Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('auth.registerForm') }}" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('auth.login') }}">
                            @csrf
                            <button class="nav-link" type="submit">Login</button>
                        </form>
                    </li>
                    @endunless

                    <!-- le panier -->
                    @if (auth()->check())
                    <li class="nav-item">
                        <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#monModal">
                            <i class="fa fa-shopping-cart"></i> Panier
                            <span class="badge badge-danger">{{ isset($panier) ? count($panier) : 0 }}</span>
                        </button>
                    </li>
                    @else
                    <li class="nav-item">
                        <button data-toggle="modal" data-target="#example2Modal">
                            <i class="fa fa-shopping-cart"></i> Panier
                            <span class="badge badge-danger">{{ isset($panier) ? count($panier) : 0 }}</span>
                        </button>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
        >
        <!-- la modal de panier si elle connecter -->
        <div class="modal fade" id="monModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="monModalTitle">Votre panier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            @if($panier)
                            <div class="panier">
                                @php
                                $somme = 0;
                                @endphp
                                @foreach($panier as $id => $item)

                                <div class="row gy-1">
                                    <div class="col">
                                        <img src="{{ asset($item['image']) }}" width="50" alt="Image du produit">
                                    </div>
                                    <div class="col">{{ $item['name'] }} </div>
                                    <div class="col">{{ $item['quantite'] }} </div>
                                    <div class="col">{{ $item['prix-unitaire'] }}dt</div>
                                    @php
                                    $prixtotal = $item['quantite'] * $item['prix-unitaire'];
                                    $somme += $prixtotal;
                                    @endphp
                                    <div class="col">{{ $prixtotal }}dt</div>
                                    <div class="col d-flex">

                                       
                                            <button id="{{$id}}"class=" deminuer btn btn-sm" type="submit">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                       

                                        
                                            <button id="{{$id}}" class=" destroy btn btn-sm" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                       
                                      
                                        
                                            <button id="{{$id}}" class=" augmenter btn btn-sm" type="submit">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                       
                                    </div>
                                </div>

                                @endforeach
                            </div>
                            @else
                            <p>Votre panier est vide.</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if($panier)
                        <div class="row">
                            <div class="col">Total </div>
                            <div class="col font-weight-bold">{{$somme}}</div>
                        </div>
                        @endif
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h5 class="card-title text-center mb-4">Finaliser l'achat</h5>
                                        @if($panier)
                                        <form action="{{ route('command.passerCommande') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="adresse" class="form-label">Votre adresse :</label>
                                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrez votre adresse" required>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Commander</button>
                                            </div>
                                        </form>


                                        @else
                                        <div class="text-center">
                                            <button type="reset" class="btn btn-primary">Commander</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--la modal si n'est pas connecter-->
        <div class="modal fade" id="example2Modal" tabindex="-1" role="dialog" aria-labelledby="example2ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="example2ModalLabel">Confirmation d'ajout au panier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Veuillez vous connecter pour ajouter cet article au panier.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <a href="{{ route('auth.registerForm') }}" class="btn btn-success">S'inscrire</a>
                        <a href="{{ route('auth.login') }}" class="btn btn-primary">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>

        @yield('content');
    </main>
    <footer class="bg-white border-bottom border-top">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="border-right py-5 pr-5">
                        <h6 class="mt-0 mb-4 f-14 text-dark font-weight-bold">NOTRE CATEGORIES</h6>
                        <div class="row no-gutters">
                            <div class="col-6">
                                <ul class="list-unstyled mb-0">
                                    @isset($categories)
                                    @for($i = 0; $i < count($categories); $i++) <li>
                                        <a class="text-dark" href="#">
                                            {{ $categories[$i]->name }}
                                        </a>
                                        </li>
                                        @endfor
                                        @endisset
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="py-5 pl-5">
                        <h6 class="mt-0 mb-4 f-14 text-dark font-weight-bold">DOWNLOAD APP</h6>
                        <div class="app">
                            <a href="#">
                                <img class="img-fluid" src="{{ asset('storage/image/google.png') }}">
                            </a>
                            <a href="#">
                                <img class="img-fluid" src="{{ asset('storage/image/apple.png') }}">
                            </a>
                        </div>
                        <h6 class="mt-4 mb-4 f-14 text-dark font-weight-bold">KEEP IN TOUCH</h6>
                        <div class="footer-social">
                            <a href="#" class="text-dark"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-dark"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="text-dark"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-dark"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="text-dark"><i class="bi bi-messenger"></i></a>
                            <a href="#" class="text-dark"><i class="bi bi-google"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer>
<script>
    // ajouter
 $(document).ready(function() {
    $('.ajouter').click(function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('panier.ajouter') }}', // Assurez-vous que le nom de la route est correct ici
            data: {
                _token: '{{ csrf_token() }}',
                id: $(this).attr('id'),
            },

            success: function(response) {
                $(this).text("Deja ajouter");
                // Action en cas de succès (par exemple, afficher un message)
                alert(response.message);
            },
            error: function(response) {
                console.log(response);
                // Action en cas d'erreur
                alert('Erreur lors de l\'ajout au panier');
            }
        });
    });
});
// augmenter
$(document).ready(function() {
    $('.augmenter') .click(function() {
        // Stocke la référence à this
        var $this = $(this);
        var produitId = $this.attr('id');

        $.ajax({
            type: 'GET',
            url: '/panier/augmenter/' + produitId,
    

            success: function(response) {
               
                // Action en cas de succès (par exemple, afficher un message)
                alert(response.message);

            },
            error: function(response) {
                console.log(response)
                // Action en cas d'erreur
            }
        });
    });
});
// deminuer
$(document).ready(function() {
    $('.deminuer').click(function() {
        // Stocke la référence à this
        var $this = $(this);
        var produitId = $this.attr('id');

        $.ajax({
            type: 'POST',
            url: '/panier/deminuer/' + produitId,
            data: {
                _token: '{{ csrf_token() }}',
                id: produitId,
            },

            success: function(response) {
                $this.text("on a deminuer la quantité ")
                // Action en cas de succès (par exemple, afficher un message)
                alert(response.message);

            },
            error: function(response) {
                console.log(response)
                // Action en cas d'erreur
            }
        });
    });
});
// distroy
$(document).ready(function() {
    $('.destroy').click(function() {
        // Stocke la référence à this
        var $this = $(this);
        var produitId = $this.attr('id');

        $.ajax({
            type: 'POST',
            url: '/panier/destroy/' + produitId,
            data: {
                _token: '{{ csrf_token() }}',
                id: produitId,
            },

            success: function(response) {
                $this.text("le produit est supprimer ")
                // Action en cas de succès (par exemple, afficher un message)
                alert(response.message);

            },
            error: function(response) {
                console.log(response)
                // Action en cas d'erreur
            }
        });
    });
});
</script>
    <script src="https://kit.fontawesome.com/14273d579a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>