<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Mes examens</h1>
    <a href="<?= URL_BASE . DS . 'examens' . DS . 'new/1' ?>"
        style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary"><i
            class="fa fa-plus"></i> Créer</a>
</div>

<div class="container-fluid admin">
    <br>
    <br>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id='dataTable'>
                <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="45%">
                    <col width="25%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type d'Evaluation</th>
                        <th>Examen</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($variables['exams'] as $examen): ?>
                        <tr>
                            <th scope="row">
                                <?= $i++; ?>
                            </th>
                            <td>
                                <?= $examen['TypeEval_idTypeEval']; ?>
                            </td>
                            <td>
                                <?= $examen['intitule']; ?>
                            </td>
                            <td>
                                <center>
                                    <a href="<?= URL_BASE . DS . 'examens' . DS . $examen['idExamen'] ?>"
                                        data-toggle="tooltip" title="Voir" class="btn btn-sm btn-outline-success"><i
                                            class="fa fa-eye"></i> Détail</a>
                                    <form method="POST" style="display: inline-block;"
                                        action="<?= URL_BASE . DS . 'examens' . DS . 'delete' . DS . $examen['idExamen'] ?>">
                                        <input type="hidden" name="idExamen" value="<?= $examen['idExamen'] ?>">
                                        <button type="submit" data-toggle="tooltip" title="Supprimer"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cet examen ?')">
                                            <i class="fa fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                    <form method='POST' style="display: inline-block;"
                                        action="<?= URL_BASE . DS . 'examens' . DS . 'imprimer' . DS . $examen['idExamen'] ?>">
                                        <input type="hidden" name="idExamen" value="<?= $examen['idExamen'] ?>">
                                        <button type="submit" data-toggle="tooltip" title="Imprimer"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-print"></i> PDF
                                    </form>
                                </center>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>