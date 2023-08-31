<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Ajouter des sujets à cette matière</h1>
    <a href="<?= URL_BASE . DS . 'matieres' ?>"
        style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<form method="POST"
    action="<?= URL_BASE . DS . 'matieres' . DS . 'addSujetToMatiere' . DS . $variables['idMatiere'] ?>">
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
                <th scope="col">Sujet</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($variables['sujets']); $i++): ?>
                <tr>
                    <td>
                        <input type="hidden" name="idMatiere" value="<?= $variables['idMatiere'] ?>">
                    </td>
                    <td>
                        <?php
                        // Vérifiez si le sujet est déjà lié
                        $isChecked = false;
                        if ($variables['sujetsAlreadyLinked'] != null) {
                            $isChecked = in_array($variables['sujets'][$i]['idSujet'], array_column($variables['sujetsAlreadyLinked'], 'Sujet_idSujet'));
                        }
                        echo '<input type="checkbox" name="sujets[]" value="' . $variables['sujets'][$i]['idSujet'] . '" ' . ($isChecked ? 'checked' : '') . '>';
                        ?>
                    </td>
                    <td>
                        <?= $variables['sujets'][$i]['intitule'] ?>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <input type="submit" name="action" class="btn btn-primary form-control float-right" style="width: 20%;"
        value="Ajouter">
</form>