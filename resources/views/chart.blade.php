@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Statistiques des Produits par Catégorie</h2>

    <canvas id="productChart" width="400" height="200"></canvas>
</div>

<script>
    var ctx = document.getElementById('productChart').getContext('2d');
    var productChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Nombre de Produits',
                data: {!! json_encode($data) !!},
                backgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
