<?php include_once VIEWS . DS . '_common' . DS . 'html.errors.php' ?>
<?php include_once VIEWS . DS . '_common' . DS . 'html.success.php' ?>
<?php include_once VIEWS . DS . '_common' . DS . 'html.warning.php' ?>

<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Importer des données</h1>
    <a href="<?= URL_BASE . DS . 'home' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
        class="btn btn-primary">Retour</a>
</div>
<br />
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Importer des données</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="<?= URL_BASE . DS . 'import_data' . DS . 'import' ?>" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">Fichier</label>
                    <input type="file" class="form-control-file" id="file" name="files[]" accept=".csv,.txt"
                        aria-describedby="fileHelpId" multiple required>
                    <small id="fileHelpId" class="form-text text-muted">Choisissez un fichier</small>
                </div>
                <button type="submit" class="btn btn-primary">Importer</button>
            </form>
        </div>
    </div>
</div>
<br />
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Exemple de fichier CSV</h6>
        <small id="fileHelpId" class="form-text text-muted">Référer vous aux exemples ci-dessous pour créer votre
            fichier CSV
        </small>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th style="width: 20%">Cursus</th>
                    <th style="width: 20%"></th>
                    <th style="width: 20%"></th>
                    <th style="width: 20%"></th>
                    <th style="width: 20%"></th>
                </tr>
                <tbody>
                    <tr>
                        <td>C1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>C2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>...</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th style="width: 20%">Professeurs</th>
                    <th style="width: 20%"></th>
                    <th style="width: 20%"></th>
                    <th style="width: 20%"></th>
                    <th style="width: 20%"></th>
                </tr>
                <tbody>
                    <tr>
                        <td>Nom</td>
                        <td>Prenom</td>
                        <td>Matiere</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>OpenGL</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>...</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br />
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Exemple de fichier TXT</h6>
        <small id="fileHelpId" class="form-text text-muted">Référer vous aux exemples ci-dessous pour créer votre
            fichier TXT
            <ul>
                <li>Les données doivent être séparées par des points-virgules</li>
            </ul>
        </small>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th style="width: 100%">Cursus</th>
                </tr>
                <tbody>
                    <tr>
                        <td>C1</td>
                    </tr>
                    <tr>
                        <td>C2</td>
                    </tr>
                    <tr>
                        <td>...</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th style="width: 100%">Professeurs</th>
                </tr>
                <tbody>
                    <tr>
                        <td>Nom<b>;</b>Prenom<b>;</b>Matiere</td>
                    </tr>
                    <tr>
                        <td>John<b>;</b>Doe<b>;</b>OpenGL</td>
                    </tr>
                    <tr>
                        <td>...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>