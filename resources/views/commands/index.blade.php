@extends('base')

@section('title', "L'historique")

@section('content')

<div class="container mt-4">
    <h3 class="mb-4">Liste des commandes</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Numéro de commande</th>
                    <th>Date d'achat</th>
                    <th>Statut</th>
                    <th>Le contenu de commande</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commands as $command)
                <tr>
                    <td>{{ $command->id }}</td>
                    <td>{{ $command->updated_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        @if(auth()->user()->role == 'admin')
                            <form method="POST" action="{{ route('command.updateStatus', ['id' => $command->id]) }}">
                                @csrf
                                @if($command->statut)
                                    <button type="submit" class="btn btn-success">Valider</button>
                                @else
                                    <button type="submit" class="btn btn-danger">Invalider</button>
                                @endif
                            </form>
                         @elseif(auth()->user()->role == 'client')
                            @if($command->statut)
                            <p class="btn btn-success">Valider</p>
                            @else
                            <p class="btn btn-danger">Invalider</p>
                            @endif
                        @endif
                    </td>

                    <td>
                        <a class="btn btn-info" href="{{ route('command.contenu', ['id' => $command->id]) }}">
                            <i class="bi bi-eye-fill"></i> Voir le contenu
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection