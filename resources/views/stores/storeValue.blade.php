@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">5 – Valeur de chaque dépôt (somme des valeurs des produits qu’il contient)</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nom du dépôt</th>
                        <th>Valeur totale (DH)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stores as $store)
                        <tr>
                            <td>{{ $store->store_name }}</td>
                            <td>{{ number_format($store->totalV, 2, ',', ' ') }} DH</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Aucun enregistrement trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="text-end">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mt-3">
                    ⬅ Retour au Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
