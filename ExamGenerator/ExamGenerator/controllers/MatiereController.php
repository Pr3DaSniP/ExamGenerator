<?php

class MatiereController extends Controller
{

    public function getMatieresList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Matiere');
        $matieres = $this->Matiere->getAllMatieres();
        $title = "Les matieres";
        $this->render('MatieresList', true, compact('title', 'user', 'matieres'));
    }

    public function newMatiere()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Les matières";
        $this->render('newMatiere', true, compact('title', 'user'));
    }

    public function addMatiere()
    {
        $this->isUserConnected();
        $libelle = $_POST['intitule'];
        $this->loadModel('Matiere');
        $this->Matiere->addMatiere($libelle);
        $this->redirect(URL_BASE . DS . 'matieres');
    }

    public function getMatiereDetails($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Matiere');
        $matiere = $this->Matiere->getMatiereById($id);
        $title = "Les matières";
        $this->render('MatieresDetails', true, compact('title', 'user', 'matiere'));
    }

    public function MatiereUpdate($id)
    {
        $this->isUserConnected();
        $libelle = $_POST['libelle'];
        $this->loadModel('Matiere');
        $this->Matiere->updateMatiere($id, $libelle);
        $this->redirect(URL_BASE . DS . 'matieres');
    }

    public function MatiereDelete($id)
    {
        $this->isUserConnected();
        $this->loadModel('Matiere');

        // Si la matière est utilisée par un professeur, on ne peut pas la supprimer
        if ($this->Matiere->ifMatiereIsBindToProf($id)) {
            $_SESSION['error'] = "Impossible de supprimer cette matière car elle est enseignée par un professeur";
            $this->redirect(URL_BASE . DS . 'matieres');
        }

        $this->Matiere->removeSujetsToMatiere($id);
        $this->Matiere->deleteMatiereFromCursus($id);
        $this->Matiere->deleteMatiere($id);
        $this->redirect(URL_BASE . DS . 'matieres');
    }

    public function SujetToMatiere($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Sujet');
        $sujets = $this->Sujet->getAllSubjects();
        $sujetsAlreadyLinked = $this->Sujet->getSubjectsByMatiere($id);
        $idMatiere = $id;
        $title = "Les matières";
        $this->render('addSujetToMatiere', true, compact('title', 'user', 'sujets', 'idMatiere', 'sujetsAlreadyLinked'));
    }

    public function addSujetToMatiere($id)
    {
        $idMatiere = $_POST['idMatiere'];
        $idSujets = $_POST['sujets'];
        $this->loadModel('Matiere');
        $this->Matiere->removeSujetsToMatiere($idMatiere);
        foreach ($idSujets as $idSujet) {
            $this->Matiere->addSujetToMatiere($idMatiere, $idSujet);
        }
        $_SESSION['success'] = "Les sujets ont bien été ajoutés à la matière";
        $this->redirect(URL_BASE . DS . 'matieres');
    }

}