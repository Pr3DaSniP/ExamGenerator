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
                Dernière étape: Finaliser l'examen
            </span>
        </h2>
        <form method="POST" action="<?= URL_BASE . DS . 'examens' . DS . 'new' . DS . '5' ?>">
            <br />
            <div class="form-group">
                <div class="form-group">
                    <h3>
                        <span class="text-secondary">
                            Intitulé
                        </span>
                    </h3>
                    <input type="text" class="form-control" id="intitule" name="intitule"
                        placeholder="Intitulé de l'examen" required>
                </div>
                <div class="form-group">
                    <h3>
                        <span class="text-secondary">
                            Coefficient
                        </span>
                    </h3>
                    <input type="number" class="form-control" id="coefficient" name="coefficient"
                        placeholder="Coefficient de l'examen" value="1" min="1" required>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Finaliser">
        </form>
    </div>
</div>