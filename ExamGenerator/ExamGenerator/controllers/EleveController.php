<?php

class EleveController extends Controller
{
    public function getElevesList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];

        $title = "Mes élèves";
        $this->render('ElevesList', true, compact('title', 'user'));
    }

    public function getEleves()
    {

        $this->loadModel('Professeur');
        $eleves = $this->Professeur->getEleves($_SESSION['user']['id']);
        $result = array($eleves);
        $json = json_encode($result);
        header('Content-Type: application/json');
        echo $json;
    }

}
