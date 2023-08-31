<br />
<h1 class="mt-5">Accueil Teacher</h1>
<p class="lead">Je suis un enseignant ! 🕵️‍♂️</p>

<?php

$label = array_map(function ($item) {
    return $item['Sujet'];
}, $questions_per_subject);

array_push($label, 'Aucun sujet');

$data = array_map(function ($item) {
    return $item['NombreQuestions'];
}, $questions_per_subject);

array_push($data, $total_questions[0]['NombreQuestions'] - array_sum($data));

$color = [];
foreach ($data as $key => $value) {
    $color[] = '#' . substr(md5(rand()), 0, 6);
}

?>

<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Répartition des questions par sujets</h6>
        </div>
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChart" class="chartjs-render-monitor"></canvas>
            </div>
            <div class="mt-4 text-center small">
                <?php foreach ($data as $key => $value): ?>
                    <?php if ($value == 0)
                        continue; ?>
                    <span class="mr-2">
                        <i class="fas fa-circle" style="color: <?= $color[$key] ?>"></i>
                        <?= $label[$key] ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
    #myPieChart {
        margin: 0 auto;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($label) ?>,
            datasets: [{
                data: <?= json_encode($data) ?>,
                backgroundColor: <?= json_encode($color) ?>,
            }],
        },
        options: {
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