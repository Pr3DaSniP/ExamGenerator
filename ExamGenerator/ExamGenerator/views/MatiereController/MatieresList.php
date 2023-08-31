<br />
<div>
  <h1 style="display: inline-block" class="mt-5">Liste des matières</h1>
  <a href="<?= URL_BASE . DS . 'matieres' . DS . 'new' ?>"
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
          <?php foreach ($variables['matieres'] as $matiere): ?>
            <tr>
              <th scope="row">
                <?= $i++; ?>
              </th>
              <td>
                <?= $matiere['intitule'] ?>
              </td>
              <td>
                <center>
                  <a href="<?= URL_BASE . DS . 'matieres' . DS . 'sujets' . DS . 'add' . DS . $matiere['idMatiere'] ?>"
                    data-toggle="tooltip" title="Ajouter des sujets" class="btn btn-sm btn-outline-info"><i
                      class="fa fa-plus"></i> Ajouter des sujets</a>
                  <a href="<?= URL_BASE . DS . 'matieres' . DS . $matiere['idMatiere'] ?>" data-toggle="tooltip"
                    title="Voir" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i> Détail</a>
                  <form method="POST" style="display: inline-block"
                    action="<?= URL_BASE . DS . 'matieres' . DS . 'delete' . DS . $matiere['idMatiere'] ?>">
                    <input type="hidden" name="idMatiere" value="<?= $matiere['idMatiere'] ?>">
                    <input type="hidden" name="libelle" value="<?= $matiere['intitule'] ?>">
                    <button type="submit" data-toggle="tooltip" title="Supprimer" class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('Voulez-vous vraiment supprimer cette matière ?')">
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