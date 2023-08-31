<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Nouveau sujet</h1>
    <a href="<?= URL_BASE . DS . 'sujets' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
        class="btn btn-primary">Retour</a>
</div>
<form method="post" action="<?= URL_BASE . DS . 'sujets' . DS . 'add' ?>">
    <table class="table">
        <colgroup>
            <col width="5%">
            <col width="70%">
            <col width="25%">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Sujet</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    <input type="hidden" name="idSujet" value="">
                </th>
                <td><input class="form-control" type="text" name="sujet" value=""></td>
                <td>
                    <input type="submit" name="action" class="btn btn-primary form-control" value="Add">
                </td>
            </tr>
        </tbody>
    </table>
</form>