<br />
<div>
  <h1 style="display: inline-block" class="mt-5">
    <?= $variables['niveau'][0]['intitule']; ?>
  </h1>
  <a href="<?= URL_BASE . DS . 'niveaux' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
    class="btn btn-primary">Retour</a>
</div>
<form method="post" action="
  <?= URL_BASE . DS . 'niveaux' . DS . 'update' . DS . $variables['niveau'][0]['idNiveau'] ?>
">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($variables['niveau'] as $niveau): ?>
        <tr>
          <th scope="row">
            <?= $niveau['idNiveau'] ?>
          </th>
          <td>
            <input class="form-control" type="text" name="libelle" value="<?= $niveau['intitule'] ?>">
          </td>
          <td>
            <input type="submit" name="action" class="btn btn-primary form-control" value="Update">
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</form>
<div>
  <h1 style="display: inline-block" class="mt-5">
    Cursus associés
  </h1>
</div>
<table class="table">
  <tbody>
    <?php foreach ($variables['cursus'] as $cursus): ?>
      <tr>
        <td class="align-middle">
          <?= $cursus['libelle'] ?>
        </td>
        <td class="align-middle text-right">
          <form method="POST" action="<?= URL_BASE . DS . 'niveaux' . DS . 'disassociate' ?>">
            <input type="hidden" name="idNiveau" value="<?= $variables['niveau'][0]['idNiveau'] ?>">
            <input type="hidden" name="idCursus" value="<?= $cursus['idCursus'] ?>">
            <input type="submit" name="action" class="btn btn-outline-danger" value="Dissocier">
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>