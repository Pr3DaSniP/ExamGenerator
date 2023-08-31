<br />
<div>
  <h1 style="display: inline-block" class="mt-5">Liste des cursus</h1>
  <a href="<?= URL_BASE . DS . 'cursus' . DS . 'new' ?>"
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
          <col width="70%">
          <col width="25%">
        </colgroup>
        <thead>
          <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($variables['cursus'] as $cursus): ?>
            <tr>
              <th scope="row">
                <?= $i++; ?>
              </th>
              <td>
                <?= $cursus['libelle'] ?>
              </td>
              <td>
                <center>
                  <a href="<?= URL_BASE . DS . 'cursus' . DS . 'associate' . DS . $cursus['idCursus'] ?>"
                    data-toggle="tooltip" title="Associer des matières à ce cursus"
                    class="btn btn-sm btn-outline-info" "><i class=" fa fa-link"></i> Associer des matières</a>
                  <a href="<?= URL_BASE . DS . 'cursus' . DS . $cursus['idCursus'] ?>" data-toggle="tooltip" title="Voir"
                    class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i> Détail</a>
                  <form method="POST" style="display: inline-block;"
                    action="<?= URL_BASE . DS . 'cursus' . DS . 'delete' . DS . $cursus['idCursus'] ?>">
                    <input type="hidden" name="idCursus" value="<?= $cursus['idCursus'] ?>">
                    <input type="hidden" name="libelle" value="<?= $cursus['libelle'] ?>">
                    <button type="submit" data-toggle="tooltip" title="Supprimer" class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('Voulez-vous vraiment supprimer ce cursus ?')">
                      <i class="fa fa-trash"></i> Supprimer
                    </button>
                  </form>
                  <center>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>