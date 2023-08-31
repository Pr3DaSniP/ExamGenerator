<?php

class QuestionsController extends Controller
{
    public function QuestionsList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Question');
        $questions = $this->Question->getAllQuestions();

        $questions = [...$questions];

        for ($i = 0; $i < count($questions); $i++) {
            $id = $questions[$i]['Sujet_idSujet'];
            $sujet = $this->Question->getSubjectByQuestionId($id)[0]['intitule'];
            $questions[$i]['sujet'] = $sujet;
        }
        
        $title = "Les questions";
        $this->render('QuestionsList', true, compact('title', 'user', 'questions'));
    }

    public function QuestionDetail($id)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Question');
        $this->loadModel('Sujet');
        $question = $this->Question->getQuestionById($id);
        $sujet = $this->Question->getSubjectByQuestionId($question[0]['Sujet_idSujet']);
        $question[0]['sujet'] = $sujet[0]['intitule'];
        $sujets = $this->Sujet->getAllSubjects();
        $title = "Détail de la question";
        $this->render('QuestionDetail', true, compact('title', 'user', 'question', 'sujets'));
    }

    public function newQuestion()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Créer une question";
        $this->loadModel('Sujet');
        $subjects = $this->Sujet->getAllSubjects();
        $this->render('newQuestion', true, compact('title', 'user', 'subjects'));
    }

    public function addQuestion()
    {
        $this->isUserConnected();
        $intitule = $_POST['intitule'];
        $idSujet = $_POST['sujet'];
        $nbPoints = $_POST['nbPoints'];
        $reponse = $_POST['reponse'];
        $this->loadModel('Question');
        $this->Question->insertQuestion($intitule, $idSujet, $nbPoints, $reponse);
        $this->redirect(URL_BASE . DS . 'questions');
    }

    public function deleteQuestion($id)
    {
        $this->isUserConnected();
        $this->loadModel('Question');
        $this->Question->deleteQuestionExam($id);
        $this->Question->deleteQuestion($id);
        $this->redirect(URL_BASE . DS . 'questions');
    }

    public function QuestionUpdate($id)
    {
        $this->isUserConnected();
        $intitule = $_POST['question'];
        $idSujet = $_POST['sujet'];
        $nbPoints = $_POST['nbPoints'];
        $reponse = $_POST['reponse'];
        $this->loadModel('Question');
        $this->Question->updateQuestion($id, $intitule, $idSujet, $nbPoints, $reponse);
        $this->redirect(URL_BASE . DS . 'questions');
    }
}