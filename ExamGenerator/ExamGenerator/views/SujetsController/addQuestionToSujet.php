<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Ajouter une question à ce sujet</h1>
    <a href="<?= URL_BASE . DS . 'sujets' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
        class="btn btn-primary">Retour</a>
</div>
<form method="POST" action="<?= URL_BASE . DS . 'sujets' . DS . 'addQuestionToSujet' . DS . $variables['idSujet'] ?>">
    <table class="table">
        <colgroup>
            <col width="5%">
            <col width="5%">
            <col width="90%">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Question</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($variables['questions'] as $question): ?>
                <?php if ($question['idSujet'] == $variables['idSujet'] || $question['idSujet'] == null): ?>
                    <tr>
                        <td>
                            <input type="hidden" name="idSujet" value="<?= $variables['idSujet'] ?>">
                        </td>
                        <td>
                            <input type="checkbox" name="questions[]" value="<?= $question['id'] ?>"
                                <?= $question['idSujet'] == $variables['idSujet'] ? 'checked' : '' ?>>
                        </td>
                        <td>
                            <?= $question['question'] ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <input type="submit" name="action" class="btn btn-primary form-control float-right" style="width: 20%;"
        value="Ajouter">
</form>