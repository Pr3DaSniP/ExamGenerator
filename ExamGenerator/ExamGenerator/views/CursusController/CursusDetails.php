<br />
<div>
  <h1 style="display: inline-block" class="mt-5">
    <?= $variables['cursus'][0]['libelle']; ?>
  </h1>
  <a href="<?= URL_BASE . DS . 'cursus' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
    class="btn btn-primary">Retour</a>
</div>

<form method="post" action="
  <?= URL_BASE . DS . 'cursus' . DS . 'update' . DS . $variables['cursus'][0]['idCursus'] ?>
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
      <?php foreach ($variables['cursus'] as $cursus): ?>
        <tr>
          <th scope="row">
            <?= $cursus['idCursus'] ?>
          </th>
          <td>
            <input class="form-control" type="text" name="libelle" value="<?= $cursus['libelle'] ?>">
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
    Matières associées
  </h1>
</div>
<table class="table">
  <tbody>
    <?php foreach ($variables['matieres'] as $matiere): ?>
      <tr>
        <td class="align-middle">
          <?= $matiere['libelle'] ?>
        </td>
        <td class="align-middle text-right">
          <form method="POST" action="<?= URL_BASE . DS . 'cursus' . DS . 'disassociate' ?>">
            <input type="hidden" name="idCursus" value="<?= $variables['cursus'][0]['idCursus'] ?>">
            <input type="hidden" name="idMatiere" value="<?= $matiere['idMatiere'] ?>">
            <input type="submit" name="action" class="btn btn-outline-danger" value="Dissocier">
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>