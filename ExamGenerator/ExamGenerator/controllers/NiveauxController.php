<?php

class NiveauxController extends Controller
{

    public function getNiveauxList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Niveau');
        $niveaux = $this->Niveau->getAllNiveaux();
        $title = "Les niveaux";
        $this->render('NiveauxList', true, compact('title', 'user', 'niveaux'));
    }

    public function newNiveau()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Les niveaux";
        $this->render('newNiveau', true, compact('title', 'user'));
    }

    public function addNiveau()
    {
        $this->isUserConnected();
        $libelle = $_POST['intitule'];
        $this->loadModel('Niveau');
        $this->Niveau->addNiveau($libelle);
        $this->redirect(URL_BASE . DS . 'niveaux');
    }

    public function getNiveauDetails($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Niveau');
        $niveau = $this->Niveau->getNiveauById($id);
        $idsCursus = $this->Niveau->getAssociateCursus($id);
        $this->loadModel('Cursus');
        $cursus = [];
        foreach ($idsCursus as $idCursus) {
            $cursus[] = [
                'idCursus' => $idCursus['Cursus_idCursus'],
                'libelle' => $this->Cursus->getCursusById($idCursus['Cursus_idCursus'])[0]['libelle']
            ];
        }
        $title = "Les niveaux";
        $this->render('NiveauxDetails', true, compact('title', 'user', 'id', 'niveau', 'cursus'));
    }

    public function NiveauDelete($id)
    {
        $this->isUserConnected();
        $this->loadModel('Niveau');
        $this->Niveau->deleteAssociationCursusNiveau($id);
        $this->Niveau->deleteNiveau($id);
        $this->redirect(URL_BASE . DS . 'niveaux');
    }

    public function NiveauUpdate($id)
    {
        $this->isUserConnected();
        $libelle = $_POST['libelle'];
        $this->loadModel('Niveau');
        $this->Niveau->updateNiveau($id, $libelle);
        $this->redirect(URL_BASE . DS . 'niveaux');
    }

    public function associateCursus($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Niveau');
        $niveau = $this->Niveau->getNiveauById($id);
        $this->loadModel('Cursus');
        $cursus = $this->Cursus->getAllCursus();
        $title = "Association de cursus au niveau";
        $this->render('associateCursus', true, compact('title', 'user', 'niveau', 'cursus'));
    }

    public function associate()
    {
        $idNiveau = $_POST['idNiveau'];
        $idsCursus = $_POST['cursus'];
        $error = "";
        $this->loadModel('Niveau');
        foreach ($idsCursus as $idCursus) {
            if (!$this->Niveau->ifAssociateCursusExist($idNiveau, $idCursus)) {
                $this->Niveau->associateCursus($idNiveau, $idCursus);
            } else {
                $error .= "Le cursus " . $idCursus . " est déjà associé au niveau " . $idNiveau . ". <br>";
            }
        }
        if ($error != "") {
            $_SESSION['error'] = $error;
        } else {
            $_SESSION['success'] = "Association effectuée";
        }
        $this->redirect(URL_BASE . DS . 'niveaux');
    }

    public function disassociate()
    {
        $idNiveau = $_POST['idNiveau'];
        $idCursus = $_POST['idCursus'];
        $this->loadModel('Niveau');
        $this->Niveau->disassociateCursus($idNiveau, $idCursus);
        $_SESSION['success'] = "Dissociation effectuée";
        $this->redirect(URL_BASE . DS . 'niveaux' . DS . $idNiveau);
    }
}