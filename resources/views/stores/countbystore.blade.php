@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">4 – Le nombre des produits par dépôt</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID Dépôt</th>
                        <th scope="col">Nom du Dépôt</th>
                        <th scope="col">Nombre de Produits</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stores as $store)
                        <tr>
                            <td>{{ $store->store_id }}</td>
                            <td>{{ $store->store_name }}</td>
                            <td>{{ $store->nbProducts }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted">Aucun enregistrement trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="text-end">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">← Retour au Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
