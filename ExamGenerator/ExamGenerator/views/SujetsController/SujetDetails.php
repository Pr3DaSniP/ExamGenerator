<br />
<div>
    <h1 style="display: inline-block" class="mt-5">
        <?= $variables['sujet'][0]['intitule']; ?>
    </h1>
    <a href="<?= URL_BASE . DS . 'sujets' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
        class="btn btn-primary">Retour</a>
</div>
<form method="post" action="<?= URL_BASE . DS . 'sujets' . DS . 'update' . DS . $variables['sujet'][0]['idSujet'] ?>">
    <table class="table">
        <colgroup>
            <col width="5%">
            <col width="70%">
            <col width="25%">
        </colgroup>
        <thead>
            <tr>
                <th>#</th>
                <th>Sujet</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($variables['sujet'] as $sujet): ?>
                <tr>
                    <th scope="row">
                    </th>
                    <td>
                        <input class="form-control" type="text" name="sujet" value="<?= $sujet['intitule'] ?>">
                    </td>
                    <td>
                        <center>
                            <input type="hidden" name="idSujet" value="<?= $sujet['idSujet'] ?>">
                            <input type="submit" name="action" class="btn btn-primary form-control" value="Update">
                        </center>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
<div>
    <h1 style="display: inline-block" class="mt-5">
        Questions
    </h1>
</div>
<table class="table">
    <tbody>
        <?php foreach ($variables['questionsLibelle'] as $question): ?>
            <tr>
                <td class="align-middle">
                    <?= $question['libelle'] ?>
                </td>
                <td class="align-middle text-right">
                    <a href="<?= URL_BASE . DS . 'questions' . DS . $question['idQuestion'] ?>"
                        class="btn btn-outline-primary">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>