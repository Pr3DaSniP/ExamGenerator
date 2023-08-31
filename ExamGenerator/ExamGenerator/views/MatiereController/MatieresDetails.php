<br />
<div>
  <h1 style="display: inline-block" class="mt-5">
    <?= $variables['matiere'][0]['intitule']; ?>
  </h1>
  <a href="<?= URL_BASE . DS . 'matieres' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
    class="btn btn-primary">Retour</a>
</div>

<form method="post" action="
  <?= URL_BASE . DS . 'matieres' . DS . 'update' . DS . $variables['matiere'][0]['idMatiere'] ?>
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
      <?php foreach ($variables['matiere'] as $matiere): ?>
        <tr>
          <th scope="row">
            <?= $matiere['idMatiere'] ?>
          </th>
          <td>
            <input class="form-control" type="text" name="libelle" value="<?= $matiere['intitule'] ?>">
          </td>
          <td>
            <input type="submit" name="action" class="btn btn-primary form-control" value="Update">
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</form>