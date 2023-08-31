<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Nouvel examen</h1>
    <a href="<?= URL_BASE . DS . 'examens' ?>"
        style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<br /><br />

<div class="card shadow mb-4">
    <div class="card-body">
        <h2>
            <span class="text-primary">
                Etape 1: Choisir le type d'évaluation
            </span>
        </h2>
        <form method="POST" action="<?= URL_BASE . DS . 'examens' . DS . 'new' . DS . '2' ?>">
            <div class="form-group">
                <br />
                <h3>
                    <span class="text-secondary">
                        Type d'évaluation
                    </span>
                </h3>
                <select class="form-control" name="typeEval">
                    <?php foreach ($variables['typeEval'] as $typeeval): ?>
                        <option value="<?= $typeeval['idTypeEval'] ?>"><?= $typeeval['intitule'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Suivant</button>
        </form>
    </div>
</div>