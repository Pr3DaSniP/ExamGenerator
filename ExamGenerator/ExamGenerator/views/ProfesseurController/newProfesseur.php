<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Nouveau professeur</h1>
    <a href="<?= URL_BASE . DS . 'professeurs' ?>"
        style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<form method="post" action="<?= URL_BASE . DS . 'professeurs' . DS . 'add' ?>">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Professeur</th>
                <th scope="col">Matière de référence</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    <input type="hidden" name="idProf" value="">
                    <input type="hidden" name="idMatiere" value="">
                </th>
                <td>
                    <input type="hidden" name="idProf" value="<?= $variables['professeur'][0]['id'] ?>">
                    <?= $variables['professeur'][0]['nom'] . ' ' . $variables['professeur'][0]['prenom'] ?>
                </td>
                <td>
                    <select class="form-control" name="matiere">
                        <?php foreach ($variables['LesMatieres'] as $matiere): ?>
                            <option value="<?= $matiere['idMatiere'] ?>"><?= $matiere['intitule'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <input type="submit" name="action" class="btn btn-primary form-control" value="Add">
                </td>
            </tr>
        </tbody>
    </table>
</form>