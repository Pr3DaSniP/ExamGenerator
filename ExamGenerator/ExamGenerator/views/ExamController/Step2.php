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
                Etape 2: Choisir les sujets abordés
            </span>
        </h2>
        <form method="POST" action="<?= URL_BASE . DS . 'examens' . DS . 'new' . DS . '3' ?>">
            <div class="form-group">
                <br />
                <h3>
                    <span class="text-secondary">
                        Sujets
                    </span>
                </h3>
                <?php $i = 0; ?>
                <?php foreach ($variables['sujets'] as $sujet): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sujet<?= $i ?>" name="sujets[]"
                            value="<?= $sujet['idSujet'] ?>">
                        <label class="form-check-label" for="sujet<?= $i++ ?>">
                            <?= $sujet['intitule'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary">Suivant</button>
        </form>
    </div>
</div>