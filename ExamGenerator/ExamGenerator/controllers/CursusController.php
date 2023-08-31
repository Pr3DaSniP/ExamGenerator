<?php

class CursusController extends Controller
{

    public function getCursusList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Cursus');
        $cursus = $this->Cursus->getAllCursus();
        $title = "Les cursus";
        $this->render('CursusList', true, compact('title', 'user', 'cursus'));
    }


    public function newCursus()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Les cursus";
        $this->render('newCursus', true, compact('title', 'user'));
    }

    public function addCursus()
    {
        $this->isUserConnected();
        $libelle = htmlspecialchars($_POST['libelle']);
        $this->loadModel('Cursus');
        $this->Cursus->addCursus($libelle);
        $this->redirect(URL_BASE . DS . 'cursus');
    }

    public function getCursusDetails($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Cursus');
        $cursus = $this->Cursus->getCursusById($id);
        $idMatieres = $this->Cursus->getAssociateMatiere($id);
        $this->loadModel('Matiere');
        $matieres = [];
        foreach ($idMatieres as $idMatiere) {
            $matieres[] = [
                'idMatiere' => $idMatiere['Matiere_idMatiere'],
                'libelle' => $this->Matiere->getMatiereById($idMatiere['Matiere_idMatiere'])[0]['intitule']
            ];
        }
        $title = "Les cursus";
        $this->render('CursusDetails', true, compact('title', 'user', 'id', 'cursus', 'matieres'));
    }

    public function CursusDelete($id)
    {
        $this->isUserConnected();
        $this->loadModel('Cursus');
        $this->Cursus->deleteAssociationCursusNiveau($id);
        $this->Cursus->deleteAssociationCursusMatiere($id);
        $this->Cursus->deleteCursus($id);
        $this->redirect(URL_BASE . DS . 'cursus');
    }

    public function CursusUpdate($id)
    {
        $this->isUserConnected();
        $libelle = $_POST['libelle'];
        $this->loadModel('Cursus');
        $this->Cursus->updateCursus($id, $libelle);
        $this->redirect(URL_BASE . DS . 'cursus');
    }

    public function associateMatiere($idCursus)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Cursus');
        $cursus = $this->Cursus->getCursusById($idCursus);
        $this->loadModel('Matiere');
        $matieres = $this->Matiere->getAllMatieres();
        $title = "Association de matières au cursus";
        $this->render('associateMatiere', true, compact('title', 'user', 'cursus', 'matieres'));
    }

    public function associate()
    {
        $idCursus = $_POST['idCursus'];
        $idsMatiere = $_POST['matieres'];
        $error = "";
        $this->loadModel('Cursus');
        foreach ($idsMatiere as $idMatiere) {
            if (!$this->Cursus->ifAssociateMatiereExist($idCursus, $idMatiere)) {
                $this->Cursus->associateMatiere($idCursus, $idMatiere);
            } else {
                $error .= "La matière " . $idMatiere . " est déjà associée a ce cursus. <br>";
            }
        }
        if ($error != "") {
            $_SESSION['error'] = $error;
        } else {
            $_SESSION['success'] = "Association effectuée";
        }
        $this->redirect(URL_BASE . DS . 'cursus');
    }

    public function disassociate() {
        $idMatiere = $_POST['idMatiere'];
        $idCursus = $_POST['idCursus'];
        $this->loadModel('Cursus');
        $this->Cursus->disassociateMatiere($idCursus, $idMatiere);
        $_SESSION['success'] = "Dissociation effectuée";
        $this->redirect(URL_BASE . DS . 'cursus' . DS . $idCursus);
    }

}

?>