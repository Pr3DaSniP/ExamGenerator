<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Liste des sujets</h1>
    <a href="<?= URL_BASE . DS . 'sujets' . DS . 'new' ?>"
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
                    <col width="55%">
                    <col width="45%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sujet</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($variables['sujets'] as $sujet): ?>
                        <tr>
                            <th scope="row">
                                <?= $i++; ?>
                            </th>
                            <td>
                                <?= $sujet['intitule']; ?>
                            </td>
                            <td>
                                <center>
                                    <a href="<?= URL_BASE . DS . 'sujets' . DS . 'questions' . DS . 'add' . DS . $sujet['idSujet'] ?>"
                                        data-toggle="tooltip" title="Ajouter une question"
                                        class="btn btn-sm btn-outline-info"><i class="fa fa-plus"></i> Ajouter
                                        Question</a>
                                    <a href="<?= URL_BASE . DS . 'sujets' . DS . $sujet['idSujet'] ?>" data-toggle="tooltip"
                                        title="Voir" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i>
                                        Détail</a>
                                    <form method="POST" style="display: inline-block;"
                                        action="<?= URL_BASE . DS . 'sujets' . DS . 'delete' . DS . $sujet['idSujet'] ?>">
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