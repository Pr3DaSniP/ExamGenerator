<?php
$json_data = json_encode(array_column($data1, 'SommeNoteAttribuee'), JSON_NUMERIC_CHECK);
$json_labels = json_encode(array_column($data1, 'intitule'), JSON_NUMERIC_CHECK);
?>

<br />
<h1 class="mt-5">Accueil étudiant</h1>
<p class="lead">Je suis un étudiant ! 🤠</p>

<div class='row'>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Ma moyenne générale est de :</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $data[0]['Moyenne']; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Nombre de notes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $nbNote ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-xl-5 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Courbes évolutives des notes</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myChart" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line', // Utilisation d'un graphique en ligne pour le type "area chart"
        data: {
            labels: <?php echo $json_labels; ?>,
            datasets: [{
                data: <?php echo $json_data; ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Définition de la couleur de fond de l'aire
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 20
                },
            },
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    display: false
                }
            }
        }
    });
</script>