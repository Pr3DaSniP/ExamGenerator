<br />
<div>
  <h1 style="display: inline-block" class="mt-5">
    <?= $variables['professeur'][0]['nom'] . ' ' . $variables['professeur'][0]['prenom'] ?>
  </h1>
  <a href="<?= URL_BASE . DS . 'professeurs' ?>"
    style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<form method="post" action="
    <?= URL_BASE . DS . 'professeurs' . DS . 'update' . DS . $variables['professeur'][0]['id'] ?>
">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Matiere de référence actuelle</th>
        <th scope="col">Nouvelle Matiere de référence</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($variables['professeur'] as $professeur): ?>
        <tr>
          <th scope="row">
            <input type="hidden" readonly name="idProf" readonly value="<?= $professeur['id'] ?>">
          </th>
          <td><input class="form-control" type="text" name="nom" disabled readonly value="<?= $professeur['nom'] ?>">
          </td>
          <td><input class="form-control" type="text" name="prenom" disabled value="<?= $professeur['prenom'] ?>"> </td>
          <td><input class="form-control" type="text" name="matiere" disabled value="<?= $professeur['matiere'] ?>"> </td>
          <td>
            <select class="form-control" name="matieres">
              <?php foreach ($variables['matieres'] as $matiere): ?>
                <option value="<?= $matiere['idMatiere'] ?>"><?= $matiere['intitule'] ?></option>
              <?php endforeach; ?>
            </select>
          </td>
          <td><input type="submit" name="action" class="btn btn-primary form-control" value="Update"></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </from>