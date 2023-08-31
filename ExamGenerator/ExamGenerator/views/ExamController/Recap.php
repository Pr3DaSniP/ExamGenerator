<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Récapitulatif
        <form method='POST' action='<?= URL_BASE . DS . 'examens' . DS . 'finaliser' ?>' style="display: inline-block;">
            <input type='submit' class='btn btn-primary' value='Finaliser' />
        </form>
    </h1>

    <a href="<?= URL_BASE . DS . 'examens' ?>"
        style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<br /><br />

<?php

$typeEval = $variables['recap']['typeEval'];
$intitule = $variables['recap']['intitule'];
$coefficient = $variables['recap']['coef'];
$sujets = $variables['recap']['sujets'];

$sujets_with_questions = [];
foreach ($sujets as $sujet) {
    if (!in_array($sujet['sujetIntitule'], $sujets_with_questions)) {
        $sujets_with_questions[] = $sujet['sujetIntitule'];
    }
    $sujets_with_questions[][] = [
        'intitule' => $sujet['question'],
        'point' => $sujet['point']
    ];
}

?>


<?php

$nbPages = 1;
for ($i = 0; $i < count($sujets_with_questions); $i++) {

    if ($i % 10 == 0) {
        if ($i == 0) {
            ?>

            <div class="card">
                <div class="titre">
                    <h1 class="text-center">
                        <?= $intitule ?>
                    </h1>
                    <div class="sous-titre">
                        <h6 class="text-center">
                            <?= $typeEval['intitule'] ?> Coefficient:
                            <?= $coefficient ?>
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

            <?php if (is_string($sujets_with_questions[$i])): ?>
                <div class="titre_sujet">
                    <h3>
                        <span class="text-primary">
                            <?= $sujets_with_questions[$i] ?>
                        </span>
                    </h3>
                </div>
                <hr class="my-4" />
            <?php elseif (is_array($sujets_with_questions[$i])): ?>
                <?php foreach ($sujets_with_questions[$i] as $question): ?>
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