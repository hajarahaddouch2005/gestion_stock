@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">1 – Afficher le nom complet du client pour chaque commande</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">ID Commande</th>
                        <th scope="col">Date de Commande</th>
                        <th scope="col">Nom du Client</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->customer_name }}</td>
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
