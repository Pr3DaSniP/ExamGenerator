<br />
<div>
  <h1 style="display: inline-block" class="mt-5">
    <?= $variables['question'][0]['question']; ?>
  </h1>
  <a href="<?= URL_BASE . DS . 'questions' ?>"
    style="display: inline-block; float: right; margin-top: 3.5rem!important;" class="btn btn-primary">Retour</a>
</div>
<form method="post" action="
  <?= URL_BASE . DS . 'questions' . DS . 'update' . DS . $variables['question'][0]['id'] ?>
">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Sujet</th>
        <th>Question</th>
        <th>Réponse</th>
        <th>Nombre de points</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($variables['question'] as $question): ?>
        <tr>
          <th scope="row">
          </th>
          <td>
            <select class="form-control" name="sujet">
              <option value="">Aucun sujet</option>
              <?php foreach ($variables['sujets'] as $sujet): ?>
                <option value="<?= $sujet['idSujet'] ?>" <?= $sujet['idSujet'] == $question['Sujet_idSujet'] ? 'selected' : '' ?>>
                  <?= $sujet['intitule'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </td>
          <td>
            <input class="form-control" type="text" name="question" value="<?= $question['question'] ?>">
          </td>
          <td>
            <input class="form-control" type="text" name="reponse" value="<?= $question['reponse'] ?>">
          </td>
          <td>
            <input class="form-control" type="number" min="0" name="nbPoints" value="<?= $question['nbPointsDefaut'] ?>">
          </td>
          <td>
            <center>
              <input type="submit" name="action" class="btn btn-primary form-control" value="Update">
            </center>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </from>