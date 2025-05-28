@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                2 – Liste des fournisseurs ayant livré les produits commandés par <strong>Annabel Stehr</strong>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Nom du produit</th>
                        <th scope="col">Nom du fournisseur</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->first_name }} {{ $supplier->last_name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-muted">Aucun enregistrement trouvé.</td>
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
