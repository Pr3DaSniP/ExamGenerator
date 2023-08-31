<br />
<div>
  <h1 style="display: inline-block" class="mt-5">Nouvelle matière</h1>
  <a href="<?= URL_BASE . DS . 'matieres' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
    class="btn btn-primary">Retour</a>
</div>
<form method="post" action="<?= URL_BASE . DS . 'matieres' . DS . 'add' ?>">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">
          <input type="hidden" name="idMatiere" value="">
        </th>
        <td>
          <input class="form-control" type="text" name="intitule" value="">
        </td>
        <td>
          <input type="submit" name="action" class="btn btn-primary form-control" value="Add">
        </td>
      </tr>
    </tbody>
  </table>
</form>