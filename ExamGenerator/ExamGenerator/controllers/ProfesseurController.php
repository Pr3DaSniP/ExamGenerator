<?php

class ProfesseurController extends Controller
{

    public function getProfesseursList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Professeur');
        $professeurs = $this->Professeur->getAllProfesseurs();
        $professeurs = [...$professeurs];
        for ($i = 0; $i < count($professeurs); $i++) {
            $id = $professeurs[$i]['id'];
            $matiere = $this->Professeur->getMatiereFromProfesseur($id);
            if ($matiere != null) {
                $professeurs[$i]['matiere'] = $matiere['0']['intitule'];
            } else {
                $professeurs[$i]['matiere'] = "Aucune matière";
            }
        }
        $title = "Les professeurs";
        $this->render('ProfesseursList', true, compact('title', 'user', 'professeurs'));
    }

    public function getProfesseursDetails($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Professeur');
        $this->loadModel('Matiere');
        $professeur = $this->Professeur->getProfesseurById($id);
        $matiere = $this->Professeur->getMatiereFromProfesseur($id);
        if ($matiere != null) {
            $professeur['0']['matiere'] = $matiere['0']['intitule'];
        } else {
            $professeur['0']['matiere'] = "Aucune matière";
        }
        $matieres = $this->Matiere->getAllMatieres();
        $title = "Les professeurs";
        $this->render('ProfesseursDetails', true, compact('title', 'user', 'professeur', 'matieres'));
    }

    public function ProfesseurUpdate($id)
    {
        $this->isUserConnected();
        $nouvelleMatiere = $_POST['matieres'];
        $this->loadModel('Professeur');
        $this->Professeur->updateProfesseur($id, $nouvelleMatiere);
        $this->redirect(URL_BASE . DS . 'professeurs');
    }

    public function ProfesseurDisassociate($id)
    {
        $this->isUserConnected();
        $this->loadModel('Professeur');
        $this->Professeur->disassociateProfesseur($id);
        $_SESSION['success'] = "La matière a été dissociée du professeur";
        $this->redirect(URL_BASE . DS . 'professeurs');
    }

    public function newProfesseur($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Professeur');
        $professeur = $this->Professeur->getProfesseurById($id);
        $this->loadModel('Matiere');
        $LesMatieres = $this->Matiere->getAllMatieres();
        $title = "Les professeurs";
        $this->render('newProfesseur', true, compact('title', 'user', 'professeur', 'LesMatieres'));
    }

    public function associateProfesseur()
    {
        $this->isUserConnected();
        $professeur = $_POST['idProf'];
        $matiere = $_POST['matiere'];
        $this->loadModel('Professeur');
        if (!$this->Professeur->ifProfesseurHasMatiere($professeur)) {
            $this->Professeur->addProfesseur($professeur, "1" /*Annee scolaire*/, $matiere);
        }
        $_SESSION['success'] = "La matière a été associée au professeur";
        $this->redirect(URL_BASE . DS . 'professeurs');
    }
}