<?php
class HomeController extends Controller
{
    public function home()
    {
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            header('Location: ./');
        }
        $user = $_SESSION['user'];

        switch ($user['Role_idRole']) {
            case 1: // Enseignant
                $this->enseignant($user);
                break;
            case 2: // Administrateur
                $this->admin($user);
                break;
            case 3: // Etudiant
                $this->etudiant($user);
                break;
        }
    }

    private function enseignant($user)
    {
        $title = "Mon accès enseignant";
        $this->loadModel('Data');
        $questions_per_subject = $this->Data->getQuestionsPerSubject();
        $total_questions = $this->Data->getNbQuestion();
        $this->render('Enseignant', true, compact('title', 'user', 'questions_per_subject', 'total_questions'));
    }

    private function admin($user)
    {
        $title = "Mon accès administrateur";
        $this->render('Admin', true, compact('title', 'user'));
    }

    private function etudiant($user)
    {
        $title = "Mon accès étudiant";
        $this->loadModel('Data');
        $data = $this->Data->getAverageStudent($user['id']);
        $nbNote = $this->Data->getNbNoteStudent($user['id']);
        $data1 = $this->Data->getGradeStudent($user['id']);
        $this->render('Etudiant', true, compact('title', 'user', 'data', 'data1', 'nbNote'));
    }
}