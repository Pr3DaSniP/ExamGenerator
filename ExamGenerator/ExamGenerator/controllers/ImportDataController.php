<?php

class ImportDataController extends Controller
{
    public function importData()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Importation de données";
        $this->render('importData', true, compact('title', 'user'));
    }

    public function importDataImport()
    {
        // Multiple files upload handling
        $files = $_FILES['files'];
        $filesCount = count($files['name']);

        for ($i = 0; $i < $filesCount; $i++) {
            $file = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            ];

            $this->importDataFromFile($file);
        }

    }

    private function importDataFromFile($file)
    {
        try {
            $file = fopen($file['tmp_name'], 'r');
            $type = strtolower(fgetcsv($file, 0, ';')[0]);

            switch ($type) {
                case 'cursus':
                    $cursus = array();
                    while (($col = fgetcsv($file, 0, ';')) !== false) {
                        if ($col[0] !== null) {
                            $cursus[] = [
                                'cursus' => htmlspecialchars($col[0]),
                            ];
                        }
                    }
                    $this->importCursus($cursus);
                    break;

                case 'niveaux':
                    $niveaux = array();
                    while (($col = fgetcsv($file, 0, ';')) !== false) {
                        if ($col[0] !== null) {
                            $niveaux[] = [
                                'niveau' => htmlspecialchars($col[0])
                            ];
                        }
                    }
                    $this->importNiveaux($niveaux);
                    break;

                case 'matieres':
                    $matieres = array();
                    while (($col = fgetcsv($file, 0, ';')) !== false) {
                        if ($col[0] !== null) {
                            $matieres[] = [
                                'matiere' => htmlspecialchars($col[0])
                            ];
                        }
                    }
                    $this->importMatieres($matieres);
                    break;

                case 'professeurs':
                    $professeurs = array();
                    while (($col = fgetcsv($file, 0, ';')) !== false) {
                        if ($col[0] !== null) {
                            $professeurs[] = [
                                'nom' => htmlspecialchars($col[0]),
                                'prenom' => htmlspecialchars($col[1]),
                                'matiere' => htmlspecialchars($col[2]),
                            ];
                        }
                    }
                    $this->importProfesseurs($professeurs);
                    break;

                case 'questions':
                    $questions = array();
                    while (($col = fgetcsv($file, 0, ';')) !== false) {
                        if ($col[0] !== null) {
                            $questions[] = [
                                'question' => htmlspecialchars($col[0]),
                                'reponse' => htmlspecialchars($col[1]),
                                'points' => htmlspecialchars($col[2]),
                                'idSujet' => htmlspecialchars($col[3]),
                            ];
                        }
                    }
                    $this->importQuestions($questions);
                    break;

                case 'sujets':
                    $sujets = array();
                    while (($col = fgetcsv($file, 0, ';')) !== false) {
                        if ($col[0] !== null) {
                            $sujets[] = [
                                'intitule' => htmlspecialchars($col[0]),
                            ];
                        }
                    }
                    $this->importSujets($sujets);
                    break;
            }

            fclose($file);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    private function importCursus($cursus)
    {
        $worked = false;
        $this->loadModel('Cursus');
        foreach ($cursus as $c) {
            if ($this->Cursus->getCursusByLibelle($c['cursus']) === null) {
                $this->Cursus->addCursus($c['cursus']);
                $worked = true;
            }
        }
        if ($worked)
            $_SESSION['success'] = "Les données ont été importées avec succès.";
        $this->redirect(URL_BASE . DS . 'import_data');
    }

    private function importNiveaux($niveaux)
    {
        $worked = false;
        $this->loadModel('Niveau');
        foreach ($niveaux as $n) {
            if ($this->Niveau->getNiveauByIntitule($n['niveau']) === null) {
                $this->Niveau->addNiveau($n['niveau']);
                $worked = true;
            }
        }
        if ($worked)
            $_SESSION['success'] = "Les données ont été importées avec succès.";
        $this->redirect(URL_BASE . DS . 'import_data');
    }

    private function importMatieres($matieres)
    {
        $worked = false;
        $this->loadModel('Matiere');
        foreach ($matieres as $m) {
            if ($this->Matiere->getMatiereByIntitule($m['matiere']) === null) {
                $this->Matiere->addMatiere($m['matiere']);
                $worked = true;
            }
        }
        if ($worked)
            $_SESSION['success'] = "Les données ont été importées avec succès.";
        $this->redirect(URL_BASE . DS . 'import_data');
    }

    private function importProfesseurs($professeurs)
    {
        $worked = false;
        $this->loadModel('Professeur');
        $this->loadModel('Matiere');
        $professeursInexistant = '';
        foreach ($professeurs as $p) {
            if (!$this->Professeur->ifProfesseurExist($p['nom'], $p['prenom'])) {
                $professeursInexistant .= "Le professeur " . $p['nom'] . " " . $p['prenom'] . " n'existe pas." . "<br>";
            } else {
                $idProf = $this->Professeur->getIDFromNomPrenom($p['nom'], $p['prenom'])[0]['id'];
                $idMatiere = $this->Matiere->getIDFromIntitule($p['matiere'])[0]['idMatiere'];
                if (!$this->Professeur->ifProfesseurHasMatiere($idProf)) {
                    $this->Professeur->addProfesseur($idProf, '1' /* Annee */, $idMatiere);
                    $worked = true;
                } else {
                    $matiere = $this->Professeur->getMatiereFromProfesseur($idProf)[0]['intitule'];
                    $professeursInexistant .= "Le professeur " . $p['nom'] . " " . $p['prenom'] . " a déjà la matière " . $matiere . "." . "<br>";
                }
            }
        }
        if ($worked)
            $_SESSION['success'] = "Les données ont été importées avec succès.";
        if ($professeursInexistant !== '')
            $_SESSION['warning'] = $professeursInexistant;
        $this->redirect(URL_BASE . DS . 'import_data');
    }

    private function importQuestions($questions)
    {
        $worked = false;
        $this->loadModel('Question');
        $this->loadModel('Sujet');
        $sujetInexistant = '';
        foreach ($questions as $q) {
            $pasdesujet = false;
            if (!$this->Sujet->ifSubjectExist($q['idSujet'])) {
                $pasdesujet = true;
            }

            if (!$this->Question->ifQuestionAlreadyExists($q['question'])) {
                if ($pasdesujet) {
                    $this->Question->insertQuestion($q['question'], '', $q['points'], $q['reponse']);
                } else {
                    $id = intval($this->Sujet->getIDFromIntitule($q['idSujet'])[0]['idSujet']);
                    $this->Question->insertQuestion($q['question'], $id, $q['points'], $q['reponse']);
                }
                $worked = true;
            } else {
                $sujetInexistant .= "La question \"" . $q['question'] . "\" existe déjà." . "<br>";
            }
        }
        if ($worked)
            $_SESSION['success'] = "Les données ont été importées avec succès.";
        if ($sujetInexistant !== '')
            $_SESSION['warning'] = $sujetInexistant;
        $this->redirect(URL_BASE . DS . 'import_data');
    }

    public function importSujets($sujets)
    {
        $worked = false;
        $this->loadModel('Sujet');
        $sujetDejaExistant = '';
        foreach ($sujets as $s) {
            if (!$this->Sujet->ifSubjectExist($s['intitule'])) {
                $this->Sujet->addSubject($s['intitule']);
                $worked = true;
            } else {
                $sujetDejaExistant .= "Le sujet \"" . $s['intitule'] . "\" existe déjà." . "<br>";
            }
        }
        if ($worked)
            $_SESSION['success'] = "Les données ont été importées avec succès.";
        if ($sujetDejaExistant !== '')
            $_SESSION['warning'] = $sujetDejaExistant;
        $this->redirect(URL_BASE . DS . 'import_data');
    }
}