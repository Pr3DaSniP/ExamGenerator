<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Associer des matières à
        <?= $variables['cursus'][0]['libelle'] ?>
    </h1>
    <a href="<?= URL_BASE . DS . 'cursus' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
        class="btn btn-primary">Retour</a>
</div>
<form method="post" action="<?= URL_BASE . DS . 'cursus' . DS . 'associate' ?>">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Matières</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    <input type="hidden" name="idCursus" value="<?= $variables['cursus'][0]['idCursus'] ?>">
                </th>
                <td>
                    <div class="form-check">
                        <?php foreach ($variables['matieres'] as $matiere): ?>

                            <input type="checkbox" name="matieres[]" value="<?= $matiere['idMatiere'] ?>">
                            <?= '(' . $matiere['idMatiere'] . ') ' . $matiere['intitule'] ?>
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