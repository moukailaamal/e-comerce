@extends('base')

@section('title', 'Les commandes')

@section('content')

<div class="container mt-4">
    <h1 class="mb-3">Le contenue des commandes</h1>
    <a href="{{ route('command.index', ['id' => Auth::user()->id]) }}" class="btn btn-secondary mb-4">Retourner à l'historique</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Image</th>
                <th class="text-center">ID</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Quantité</th>
                <th class="text-center">Prix unitaire</th>
                <th class="text-center">Prix total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $somme = 0;
            @endphp
            @foreach ($contenu as $id => $item)
                <tr>
                    <td class="text-center">
                        <img src="{{ asset($item->image) }}" width="50" alt="Image du produit" class="img-thumbnail">
                    </td>
                    <td class="text-center">{{ $id }}</td>
                    <td class="text-center">{{ $item->name }}</td>
                    <td class="text-center">{{ $item->quantite }}</td>
                    <td class="text-center">{{ $item->{'prix-unitaire'} }}dt</td>
                    @php
                        $prixtotal = $item->quantite * $item->{'prix-unitaire'};
                        $somme += $prixtotal;
                    @endphp
                    <td class="text-center">{{ $prixtotal }}dt</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end"><strong>Total :</strong></td>
                <td class="text-center"><strong>{{ $somme }}dt</strong></td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection
