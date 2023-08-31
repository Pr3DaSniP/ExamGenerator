<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Mes Examens</h1>
    <a href="<?= URL_BASE . DS . 'examens' ?>"
        style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<br /><br />

<?php

$sujets = [];
for($i = 0; $i < count($variables['questions']); ++$i) {
    if (!in_array($variables['questions'][$i]['sujet'], $sujets)) {
        $sujets[] = $variables['questions'][$i]['sujet'];
    }
    $sujets[][] = [
        'intitule' => $variables['questions'][$i]['intitule'],
        'point' => $variables['questions'][$i]['nbPointsPersonnalise']
    ];
}

$nbPages = 1;
for ($i = 0; $i < count($sujets); $i++) {

    if ($i % 10 == 0) {
        if ($i == 0) {
            ?>

            <div class="card">
                <div class="titre">
                    <h1 class="text-center">
                        <?= $variables['exams']['intitule'] ?>
                    </h1>
                    <div class="sous-titre">
                        <h6 class="text-center">
                            <?= $variables['exams']['TypeEval_idTypeEval'] ?> Coefficient:
                            <?= $variables['exams']['coefficient'] ?>
                        </h6>
                    </div>
                </div>
                <hr class="my-4" />

                <?php
        } else {
            ?>
            </div>
            <div class="card">

                <?php
        }
    }

    ?>
        <div class="sujet">

            <?php if (is_string($sujets[$i])): ?>
                <div class="titre_sujet">
                    <h3>
                        <span class="text-primary">
                            <?= $sujets[$i] ?>
                        </span>
                    </h3>
                </div>
                <hr class="my-4" />
            <?php elseif (is_array($sujets[$i])): ?>
                <?php foreach ($sujets[$i] as $question): ?>
                    <div class="question">
                        <?= '(' . $question['point'] . ' pts)' ?>
                        <div>
                            <?= $question['intitule'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
}

?>

</div>

<style>
    .card {
        margin: 0 auto 20px auto;
        width: 80%;
        height: 100%;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .titre {
        text-align: center;
    }

    .sous-titre {
        text-align: center;
    }

    .sujet {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }

    .titre_sujet {
        text-align: left;
    }

    .question {
        margin: 0 auto;
        width: 100%;
        height: 100%;
        padding: 20px;
    }
</style>