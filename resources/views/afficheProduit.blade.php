@extends('base')

@section('title', 'Produit')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset(optional($produit)->image_path) }}" alt="Image du produit" class="img-fluid rounded" style="object-fit: cover; border: 1px solid #ddd;">

        </div>
        <div class="col-md-6">
            <h1 class="display-4 text-primary">{{ $produit->name }}</h1>
            <p class="lead text-danger">Le prix : {{ $produit->prix }} dt</p>
            <p class="lead text-muted">Le stock : {{ $produit->stock }}</p>

            <hr class="my-4">
            <h5 class="text-info">Plus de détails :</h5>
            <p>{{ $produit->description }}</p>

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

            @if (auth()->check())
         
                <div class="input-group mt-4">
                    <button type="submit" data-toggle="modal" data-target="#monModal" 
                    class="btn btn-primary ">
                        Passer ton commande
                    </button>
                </div>
           
            @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example2Modal">
                Passer ton commande
            </button>
            @endif
        </div>
    </div>
</div>


@endsection