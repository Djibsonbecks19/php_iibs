<div class="container mt-5">

    <!-- Chart 1: Top Produits -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-pie-chart me-2"></i>Top 10 Produits Vendus</h5>
        </div>
        <div class="card-body">
            <canvas id="topProductsChart" style="height: 400px; width: 100%;"></canvas>
        </div>
    </div>

    <!-- Chart 2:  Commandes par mois -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Commandes Mensuelles</h5>
        </div>
        <div class="card-body">
            <canvas id="monthlyCommandsChart" style="height: 400px; width: 100%;"></canvas>
        </div>
    </div>
</div>

<!-- Chargement Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Circulaire - Top Produits
    const pieCtx = document.getElementById('topProductsChart');
    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($product_names ?? []) ?>,
                datasets: [{
                    data: <?= json_encode($sales_data ?? []) ?>,
                    backgroundColor: <?= json_encode($background_colors ?? [
                        '#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#4bc0c0',
                        '#a8e6cf', '#dcedc1', '#ffd3b6', '#ffaaa5', '#ff8b94'
                    ]) ?>,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Barre - Commandes par mois
    const barCtx = document.getElementById('monthlyCommandsChart');
    if (barCtx) {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($month_labels ?? []) ?>,
                datasets: [{
                    label: 'Commandes',
                    data: <?= json_encode($command_counts ?? []) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
</script>
