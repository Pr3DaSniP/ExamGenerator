<br />
<div>
    <h1 style="display: inline-block" class="mt-5">Exporter des données</h1>
    <a href="<?= URL_BASE . DS . 'home' ?>" style="display: inline-block; float: right; margin-top: 3.5rem!important;"
        class="btn btn-primary">Retour</a>
</div>
<br />
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Exporter des données</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= URL_BASE . DS . 'export_data/export' ?>">
            <div class="form-group">
                <label for="format">Format :</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="csv" name="format" value="csv" checked>
                    <label class="form-check-label" for="csv">CSV</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="txt" name="format" value="txt">
                    <label class="form-check-label" for="txt">TXT</label>
                </div>
            </div>
            <!-- ALLDATA -->
            <div class="form-group">
                <label for="export">Exporter :</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="allData" name="allData" value="allData">
                    <label class="form-check-label" for="allData">Toutes les données</label>
                </div>
            </div>

            <!-- SCOLARITE -->
            <div class="form-group">
                <label for="export">Scolarité :</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="cursus" name="export[]" value="Cursus">
                    <label class="form-check-label" for="cursus">Cursus</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="matiere" name="export[]" value="Matiere">
                    <label class="form-check-label" for="matiere">Matières</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="niveaux" name="export[]" value="Niveau">
                    <label class="form-check-label" for="niveaux">Niveaux</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="professeurs" name="export[]" value="Professeur">
                    <label class="form-check-label" for="professeurs">Professeurs ayant une matière de
                        références</label>
                </div>
            </div>

            <!-- ETUDIANT -->
            <div class="form-group">
                <label for="export">Étudiant :</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="eleve" name="export[]" value="Eleve" disabled>
                    <label class="form-check-label" for="eleve">Élèves</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="classe" name="export[]" value="Classe" disabled>
                    <label class="form-check-label" for="classe">Classes</label>
                </div>
            </div>

            <!-- EXAMEN -->
            <div class="form-group">
                <label for="export">Annales :</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="question" name="export[]" value="Question">
                    <label class="form-check-label" for="question">Questions</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sujet" name="export[]" value="Sujet">
                    <label class="form-check-label" for="sujet">Sujets (Thèmes)</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Exporter</button>
        </form>
    </div>
</div>
<script>
    const checkbox = document.getElementsByName('export[]');
    const allData = document.getElementById('allData');
    allData.addEventListener('change', (event) => {
        if (event.target.checked) {
            checkbox.forEach((box) => {
                box.checked = true;
            });
        } else {
            checkbox.forEach((box) => {
                box.checked = false;
            });
        }
    });
</script>