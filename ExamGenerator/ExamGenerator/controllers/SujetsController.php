<?php

class SujetsController extends Controller
{
    public function getSujetsList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Sujet');
        $sujets = $this->Sujet->getAllSubjects();
        $title = "Les sujets";
        $this->render('SujetsList', true, compact('title', 'user', 'sujets'));
    }

    public function getSujetDetails($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Sujet');
        $sujet = $this->Sujet->getSubjectById($id);
        $questions = $this->Sujet->getQuestionsFromSubject($id);
        $questionsLibelle = [];
        foreach ($questions as $question) {
            $questionsLibelle[] = [
                'idQuestion' => $question['id'],
                'libelle' => $question['question']
            ];
        }
        $title = "Détails du sujet";
        $this->render('SujetDetails', true, compact('title', 'user', 'sujet', 'questionsLibelle'));
    }

    public function SujetUpdate($id)
    {
        $this->isUserConnected();
        $idSujet = $_POST['idSujet'];
        $sujet = $_POST['sujet'];
        $this->loadModel('Sujet');
        $this->Sujet->updateSubject($idSujet, $sujet);
        $this->redirect(URL_BASE . DS . 'sujets');
    }

    public function SujetDelete($id)
    {
        $this->isUserConnected();
        $this->loadModel('Sujet');
        $questions = $this->Sujet->getQuestionsFromSubject($id);
        foreach ($questions as $question) {
            $this->Sujet->removeSubjetFromQuestion($question['id']);
        }
        $this->Sujet->deleteSubject($id);
        $this->redirect(URL_BASE . DS . 'sujets');
    }

    public function newSujet()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Les sujets";
        $this->render('newSujet', true, compact('title', 'user'));
    }

    public function addSujet()
    {
        $this->isUserConnected();
        $sujet = htmlspecialchars($_POST['sujet']);
        $this->loadModel('Sujet');
        $this->Sujet->addSubject($sujet);
        $this->redirect(URL_BASE . DS . 'sujets');
    }

    public function QuestionToSujet($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Question');
        $tmpQuestions = $this->Question->getAllQuestions();
        $questions = [];
        foreach ($tmpQuestions as $question) {
            $questions[] = [
                'id' => $question['id'],
                'question' => $question['question'],
                'idSujet' => $question['Sujet_idSujet']
            ];
        }
        $idSujet = $id;
        $title = "Détails du sujet";
        $this->render('addQuestionToSujet', true, compact('title', 'user', 'questions', 'idSujet'));
    }

    public function addQuestionToSujet($id)
    {
        $idSujet = $_POST['idSujet'];
        $idsQuestion = $_POST['questions'] ?? [];
        $this->loadModel('Sujet');
        $questions = $this->Sujet->getQuestionsFromSubject($idSujet);

        if($idsQuestion == []) {
            $this->Sujet->removeAllSubjectsFromQuestion($idSujet);
        } else {
            foreach ($questions as $question) {
                $this->Sujet->removeSubjetFromQuestion($question['id']);
            }
            foreach ($idsQuestion as $idQuestion) {
                $this->Sujet->addQuestionToSujet($idQuestion, $idSujet);
            }
        }
        $_SESSION['success'] = "Les questions ont bien été ajoutées au sujet";
        $this->redirect(URL_BASE . DS . 'sujets');
    }
}