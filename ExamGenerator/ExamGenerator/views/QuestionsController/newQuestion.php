<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Nouvelle question</h1>
    <a href="<?= URL_BASE . DS . 'questions' ?>"
        style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<form method="post" action="<?= URL_BASE . DS . 'questions' . DS . 'add' ?>">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre de points</th>
                <th scope="col">Sujet</th>
                <th scope="col">Intitulé</th>
                <th scope="col">Réponse</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    <input type="hidden" name="idQuestion" value="">
                </th>
                <td><input class="form-control" type="number" name="nbPoints" value=""></td>
                <td>
                    <select class="form-control" name="sujet">
                        <option value="">Aucun sujet</option>
                        <?php foreach ($variables['subjects'] as $sujet): ?>
                            <option value="<?= $sujet['idSujet'] ?>"><?= $sujet['intitule'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input class="form-control" type="text" name="intitule" value=""></td>
                <td><input class="form-control" type="text" name="reponse" value=""></td>
                <td>
                    <input type="submit" name="action" class="btn btn-primary form-control" value="Add">
                </td>
            </tr>
        </tbody>
    </table>
</form>