<?php

class ClasseController extends Controller
{
    public function getClassesList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];

        $title = "Mes Classes";
        $this->render('ClassesList', true, compact('title', 'user'));
    }

    public function getClasses()
    {

        $this->loadModel('Professeur');
        $classes = $this->Professeur->getClasses($_SESSION['user']['id']);

        $result = array($classes);
        $json = json_encode($result);
        header('Content-Type: application/json');
        echo $json;
    }

}

