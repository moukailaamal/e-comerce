@extends('base')
@section('title', 'Liste de produits')

@section('content')

<div class="container">
    <h2 class="text-primary m-4">{{$nomCategorie}}</h2>
    @foreach($produits as $produit)
        <div class="row mb-4" style="height: 550px;">
            <div class="col">
                <img src="{{ asset($produit->image_path) }}" alt="Image du produit" class="img-fluid rounded" style="object-fit: cover; width: 100%; height: 550px;border: 1px solid #ddd;">
            </div>
            <div class="col">
                <h1 class="display-4 text-primary">{{ $produit->name }}</h1>
                <p class="lead text-danger">Le prix : {{ $produit->prix }} dt</p>
                <p class="lead text-muted">Le stock : {{ $produit->stock }}</p>
                <hr class="my-4">
                <h5 class="text-info">Plus de détails :</h5>
                <p>{{ $produit->description }}</p>
                
                <!-- Le panier -->
                @if (auth()->check() )
                                    @if($produit->stock>0)
                                    @if(isset($panier[$produit->id]))
                                        @if($panier[$produit->id]['quantite']<$produit->stock)
                                        <form action="{{ route('panier.ajouter', ['id' => $produit->id]) }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                        <i class="icofont-plus"></i> Ajouter au panier
                                                    </button>
                                                    <input type="number" name="quantite" value="{{ isset($panier[$produit->id]['quantite']) ? $panier[$produit->id]['quantite'] : 0 }}" class="form-control" style="max-width: 70px;" readonly>
                                                </div>
                                            </form>
                                        @endif
                                    @else
                                    <form action="{{ route('panier.ajouter', ['id' => $produit->id]) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                    <i class="icofont-plus"></i> Ajouter au panier
                                                </button>
                                                <input type="number" name="quantite" value="{{ isset($panier[$produit->id]['quantite']) ? $panier[$produit->id]['quantite'] : 0 }}" class="form-control" style="max-width: 70px;" readonly>
                                            </div>
                                        </form>
                                    @endif 
                                    @endif
                                        @else
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#example2Modal">
                                                Ajouter au panier
                                            </button>
                                        </div>
                                        @endif

<!-- La commande -->
@if (auth()->check())
    <div class="input-group mt-2">
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#monModal">
            Passer une commande
        </button>
    </div>
@else
    <div class="input-group mt-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#example2Modal">
            Passer une commande
        </button>
    </div>
@endif

            </div>
        </div>
    @endforeach
</div>

@endsection
