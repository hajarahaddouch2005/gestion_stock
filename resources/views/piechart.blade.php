@extends('layout.app')

@section('content')
<div class="container mt-5 text-center">
    <h2 class="mb-4">Répartition des Produits par Catégorie (Pie Chart)</h2>

    <canvas id="pieChart" width="400" height="400"></canvas>
</div>

<script>
    var ctx = document.getElementById('pieChart').getContext('2d');

    var pieChart = new Chart(ctx, {
        type: 'pie',  // type mdawra
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Produits par catégorie',
                data: {!! json_encode($data) !!},
                backgroundColor: [
                    '#FF6384',  // rouge
                    '#36A2EB',  // bleu
                    '#FFCE56',  // jaune
                    '#4BC0C0',  // cyan
                    '#9966FF',  // violet
                    '#FF9F40'   // orange
                ],
                hoverOffset: 30
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });
</script>
@endsection
