<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Liste des questions</h1>
    <a href="<?= URL_BASE . DS . 'questions' . DS . 'new' ?>"
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
                        <th>Sujet</th>
                        <th>Question</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($variables['questions'] as $question): ?>
                        <tr>
                            <th scope="row">
                                <?= $i++; ?>
                            </th>
                            <td>
                                <?= $question['sujet']; ?>
                            </td>
                            <td>
                                <?= $question['question']; ?>
                            </td>
                            <td>
                                <center>
                                    <a href="<?= URL_BASE . DS . 'questions' . DS . $question['id'] ?>"
                                        data-toggle="tooltip" title="Voir" class="btn btn-sm btn-outline-success"><i
                                            class="fa fa-eye"></i> Détail</a>
                                    <form method="POST" style="display: inline-block;"
                                        action="<?= URL_BASE . DS . 'questions' . DS . 'delete' . DS . $question['id'] ?>">
                                        <input type="hidden" name="idQuestion" value="<?= $question['id'] ?>">
                                        <input type="hidden" name="question" value="<?= $question['question'] ?>">
                                        <button type="submit" data-toggle="tooltip" title="Supprimer"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cette question ?')">
                                            <i class="fa fa-trash"></i> Supprimer
                                        </button>
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