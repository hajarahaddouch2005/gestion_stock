@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">
                3 – Liste des produits stockés dans les mêmes dépôts que les produits fournis par <strong>Scottie Crona</strong>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover text-center">
                <thead class="table-success">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom du produit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
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
