@extends('layout.app')

@section('content')
<div class="container">
    <h2>6 – les depots qui ont une valeur surpérieur a la valeur du depot ‘Lind-Gislason’ {{ $value }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>store id</th>
                <th>store name</th>
                <th>value</th>

            </tr>
        </thead>
        <tbody>
              @forelse($stores as $store)
                <tr>
                    <td>{{ $store->store_id }}</td>
                    <td>{{ $store->store_name }}</td>
                    <td>{{ $store->totalV }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun enregistrement trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Retour au Dashboard</a>
</div>
@endsection
