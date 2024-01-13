@extends('base')

@section('title', 'Accueil')

@section('content')


<div class="container mt-5">
    <div class="row">
        <div class="col">
            @foreach($categories as $categorie)
            @php $prod = 0; @endphp
            <div class="card mb-4 flex-fill">
                <div class="card-header bg-light d-flex justify-content-between">
                    <h4 class="text-primary">{{ $categorie->name }}</h4>
                    <a href="{{route('produits.listeProduit',['id' => $categorie->id])}}">
                        <h5 class="text-right">Voir tous</h5>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row bg-light">
                        @foreach($produits as $produit)
                        @if($produit->categorie_id == $categorie->id)
                        @php $prod++; @endphp
                        <div class="col-md-4 mb-4 h-100">
                            <div class="card h-100">
                                <a href="{{ route('afficheProduit', ['id' => $produit->id]) }}">
                                    <img src="{{ asset($produit->image_path) }}" alt="Image du produit" class="img-fluid rounded" style="object-fit: cover; width: 100%; height: 300px; border: 1px solid #ddd;">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title text-success">{{ $produit->name }}</h5>
                                    <p class="card-text text-muted">Prix : {{ $produit->prix }} dt</p>
                                    <p class="card-text text-muted">Stock : {{ $produit->stock }}</p>
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



                                </div>
                            </div>
                        </div>
                        @if($prod == 3)
                        @break
                        @endif
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection