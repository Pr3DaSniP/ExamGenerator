<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Associer des cursus à
        <?= $variables['niveau'][0]['intitule'] ?>
    </h1>
    <a href="<?= URL_BASE . DS . 'niveaux' ?>"
        style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<form method="post" action="<?= URL_BASE . DS . 'niveaux' . DS . 'associate' ?>">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cursus</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    <input type="hidden" name="idNiveau" value="<?= $variables['niveau'][0]['idNiveau'] ?>">
                </th>
                <td>
                    <div class="form-check">
                        <?php foreach ($variables['cursus'] as $cursus): ?>

                            <input type="checkbox" name="cursus[]" value="<?= $cursus['idCursus'] ?>">
                            <?= '(' . $cursus['idCursus'] . ') ' . $cursus['libelle'] ?>
                            <br>

                        <?php endforeach; ?>
                    </div>
                </td>
                <td>
                    <input type="submit" name="action" class="btn btn-primary form-control" value="Add">
                </td>
            </tr>
        </tbody>
    </table>
</form>