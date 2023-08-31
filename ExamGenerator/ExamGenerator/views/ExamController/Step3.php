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
                Etape 3: Choisir les questions
            </span>
        </h2>
        <form method="POST" action="<?= URL_BASE . DS . 'examens' . DS . 'new' . DS . '4' ?>">
            <br />
            <?php $i = 0; ?>
            <?php foreach ($variables['questions'] as $question): ?>
                <div class="form-group">
                    <h3>
                        <span class="text-secondary">
                            <?= $question['intitule'] ?>
                        </span>
                    </h3>
                    <table class="table table-bordered" cellspacing="0">
                        <colgroup>
                            <col span="1" style="width: 80%;">
                            <col span="1" style="width: 20%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($question['questions'] as $qs): ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <?php if ($qs['id'] != -1): ?>
                                                <input class="form-check-input" type="checkbox" id="question<?= $i ?>"
                                                    name="questions[]" value="<?= $qs['id'] ?>">
                                            <?php endif ?>
                                            <label class="form-check-label" for="question<?= $i++ ?>">
                                                <?= $qs['question'] ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($qs['id'] != -1): ?>
                                            <input type="number" class="form-control pts" name="points[]" value="-1" min="1"
                                                max="20" disabled>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <br /><br />
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Suivant</button>
        </form>
    </div>
</div>

<script>
    const cbx = document.querySelectorAll('.form-check-input');
    const inputs_pts = document.querySelectorAll('.pts');

    cbx.forEach((cb, i) => {
        cb.addEventListener('change', (e) => {
            if (cb.checked) {
                inputs_pts[i].value = 1;
                inputs_pts[i].disabled = false;
            } else {
                inputs_pts[i].value = -1;
                inputs_pts[i].disabled = true;
            }
        });
    });
</script>