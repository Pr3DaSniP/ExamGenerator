<br />
<div>
  <h1 style="display: inline-block" class="mt-5">Liste des professeurs</h1>
</div>

<div class="container-fluid admin">
  <br>
  <br>
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered" id='dataTable'>
        <colgroup>
          <col width="5%">
          <col width="20%">
          <col width="20%">
          <col width="20%">
          <col width="40%">
        </colgroup>
        <thead>
          <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Matière de référence</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($variables['professeurs'] as $professeur): ?>
            <tr>
              <th scope="row">
                <?= $i++; ?>
              </th>
              <td>
                <?= $professeur['nom'] ?>
              </td>
              <td>
                <?= $professeur['prenom'] ?>
              </td>
              <td>
                <?= $professeur['matiere'] ?>
              </td>
              <td>
                <center>
                  <?php if ($professeur['matiere'] == "Aucune matière"): ?>
                    <form method="POST" style="display: inline-block"
                      action="<?= URL_BASE . DS . 'professeurs' . DS . 'associate' . DS . $professeur['id'] ?>">
                      <input type="hidden" name="idProf" value="<?= $professeur['id'] ?>">
                      <input type="hidden" name="matiere" value="<?= $professeur['matiere'] ?>">
                      <button class="btn btn-sm btn-primary" title="Associer" type="submit"><i
                          class="fa fa-link"></i> Associer Matière/Professeur</button>
                    </form>
                  <?php else: ?>
                    <form method="POST" style="display: inline-block"
                      action="<?= URL_BASE . DS . 'professeurs' . DS . 'disassociate' . DS . $professeur['id'] ?>">
                      <input type="hidden" name="idProf" value="<?= $professeur['id'] ?>">
                      <input type="hidden" name="matiere" value="<?= $professeur['matiere'] ?>">
                      <button class="btn btn-sm btn-outline-primary" title="Dissocier" type="submit"><i
                          class="fa fa-unlink"></i> Dissocier Matière/Professeur</button>
                    </form>
                  <?php endif; ?>
                  <center>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>