<br />
<div>
  <h1 style="display: inline-block" class="mt-5">Liste des niveaux</h1>
  <a href="<?= URL_BASE . DS . 'niveaux' . DS . 'new' ?>"
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
          <?php foreach ($variables['niveaux'] as $niveau): ?>
            <tr>
              <th scope="row">
                <?= $i++; ?>
              </th>
              <td>
                <?= $niveau['intitule'] ?>
              </td>
              <td>
                <center>
                  <a href="<?= URL_BASE . DS . 'niveaux' . DS . 'associate' . DS . $niveau['idNiveau'] ?>"
                    data-toggle="tooltip" title="Associer des cursus à ce niveau"
                    class="btn btn-sm btn-outline-info" "><i class=" fa fa-link"></i> Associer des cursus</a>
                  <a href="<?= URL_BASE . DS . 'niveaux' . DS . $niveau['idNiveau'] ?>" data-toggle="tooltip" title="Voir"
                    class="btn btn-sm btn-outline-success" "><i class=" fa fa-eye"></i> Détail</a>
                  <form method="POST" style="display: inline-block"
                    action="<?= URL_BASE . DS . 'niveaux' . DS . 'delete' . DS . $niveau['idNiveau'] ?>">
                    <input type="hidden" name="idNiveau" value="<?= $niveau['idNiveau'] ?>">
                    <input type="hidden" name="intitule" value="<?= $niveau['intitule'] ?>">
                    <button type="submit" data-toggle="tooltip" title="Supprimer" class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('Voulez-vous vraiment supprimer ce niveau ?')">
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