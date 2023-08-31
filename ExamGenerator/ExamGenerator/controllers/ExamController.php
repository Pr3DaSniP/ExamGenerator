<?php

class ExamController extends Controller
{
    public function getExamList()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Exam');
        $exams = $this->Exam->getAllExams();

        for ($i = 0; $i < count($exams); ++$i) {
            $exams[$i]['TypeEval_idTypeEval'] = $this->Exam->getTypeEvalById($exams[$i]['TypeEval_idTypeEval'])[0]['intitule'];
        }

        $title = "Mes examens";
        $this->render('ExamList', true, compact('title', 'user', 'exams'));
    }

    public function getExamDetails($idExam)
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $this->loadModel('Exam');

        $exams_detail = $this->Exam->getExamById($idExam);

        $exams = [
            'intitule' => $exams_detail[0]['intitule'],
            'TypeEval_idTypeEval' => $this->Exam->getTypeEvalById($exams_detail[0]['TypeEval_idTypeEval'])[0]['intitule'],
            'coefficient' => $exams_detail[0]['coefficient'],
        ];

        $questions_detail = $this->Exam->getQuestionByExamId($idExam);

        $this->loadModel('Question');

        foreach ($questions_detail as $q) {
            $qs = $this->Question->getQuestionById($q['Question_id'])[0];
            $questions[] = [
                'id' => $q['Question_id'],
                'nbPointsPersonnalise' => $q['nbPointsPersonnalise'],
                'intitule' => $qs['question'],
                'sujet' => $this->Question->getSubjectByQuestionId($qs['Sujet_idSujet'])[0]['intitule'],
            ];
        }

        $title = "Mes examens";
        $this->render('ExamDetail', true, compact('title', 'user', 'exams', 'questions'));
    }

    public function newExamStep1()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Nouvel examen";

        $this->loadModel('Exam');
        $typeEval = $this->Exam->getTypeEval();
        $this->render('Step1', true, compact('title', 'user', 'typeEval'));
    }

    public function newExamStep2()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Nouvel examen";
        $this->loadModel('Sujet');
        $this->loadModel('Exam');


        $_SESSION['newExam']['typeEval'] = [
            'id' => $_POST['typeEval'],
            'intitule' => $this->Exam->getTypeEvalById($_POST['typeEval'])[0]['intitule']
        ];

        $sujets = $this->Sujet->getAllSubjects();
        $this->render('Step2', true, compact('title', 'user', 'sujets'));
    }

    public function newExamStep3()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Nouvel examen";

        $sujets = $_POST['sujets'];

        $this->loadModel('Question');
        $this->loadModel('Sujet');
        for ($i = 0; $i < count($sujets); $i++) {
            $tmpQuestions = $this->Question->getQuestionBySubjectId($sujets[$i]);

            $questions[] = [
                'idSujet' => $sujets[$i],
                'intitule' => $this->Sujet->getSubjectById($sujets[$i])[0]['intitule'],
                'questions' => []
            ];

            if (count($tmpQuestions) == 0) {
                $questions[$i]['questions'][] = [
                    'id' => -1,
                    'question' => 'Aucune question pour ce sujet',
                ];
            }

            for ($j = 0; $j < count($tmpQuestions); $j++) {
                $questions[$i]['questions'][] = [
                    'id' => $tmpQuestions[$j]['id'],
                    'question' => $tmpQuestions[$j]['question'],
                ];
            }
            ;
        }

        $_SESSION['newExam']['questions'] = $questions;
        $_SESSION['newExam']['sujetsChoisis'] = $sujets;

        $this->render('Step3', true, compact('title', 'user', 'questions'));
    }

    public function newExamStep4()
    {
        $id_question_point = [];
        for ($i = 0; $i < count($_POST['questions']); $i++) {
            $id_question_point[] = [
                'id' => $_POST['questions'][$i],
                'point' => $_POST['points'][$i]
            ];
        }

        $_SESSION['newExam']['questionsChoisis'] = $id_question_point;

        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Nouvel examen";

        $this->render('Step4', true, compact('title', 'user'));
    }

    public function newExamStep5()
    {
        $intitule = $_POST['intitule'];
        $coef = $_POST['coefficient'];

        $typeEval = $_SESSION['newExam']['typeEval'];
        $sujets = $_SESSION['newExam']['sujetsChoisis'];

        $id_question_point = $_SESSION['newExam']['questionsChoisis'];

        $recap = ['intitule' => $intitule, 'coef' => $coef, 'typeEval' => $typeEval];
        foreach ($sujets as $sujet) {
            $this->loadModel('Sujet');
            $tsujet = $this->Sujet->getSubjectById($sujet)[0];
            $nbQuestions = $this->Sujet->getNbQuestionsFromSubject($sujet);

            if ($nbQuestions !== 0) {
                $questionsFromSujets = $this->Sujet->getQuestionsFromSubject($sujet);

                $idQuestions = array_map(function ($question) {
                    return $question['id'];
                }, $questionsFromSujets);

                foreach ($id_question_point as $question) {
                    if (in_array($question['id'], $idQuestions)) {
                        $this->loadModel('Question');
                        $tquestion = $this->Question->getQuestionById($question['id'])[0];
                        $recap['sujets'][] = [
                            'sujetIntitule' => $tsujet['intitule'],
                            'sujetId' => $sujet,
                            'question' => $tquestion['question'],
                            'idQuestion' => $question['id'],
                            'point' => $question['point']
                        ];
                    }
                }
            }


        }

        $_SESSION['newExam']['recap'] = $recap;

        $this->isUserConnected();
        $user = $_SESSION['user'];
        $title = "Nouvel examen";

        $this->render('Recap', true, compact('title', 'user', 'recap'));
    }

    public function finalise()
    {
        $intitule = $_SESSION['newExam']['recap']['intitule'];
        $coef = $_SESSION['newExam']['recap']['coef'];
        $idTypeEval = $_SESSION['newExam']['recap']['typeEval']['id'];

        $createExamWorked = false;
        $questionsAdded = false;

        $this->loadModel('Exam');
        $idExam = $this->Exam->createExam($intitule, $coef, $idTypeEval);

        if (isset($idExam)) {
            $createExamWorked = true;
        }

        $questions = $_SESSION['newExam']['recap']['sujets'];
        foreach ($questions as $question) {
            $idQuestion = $this->Exam->addQuestionToExam($question['idQuestion'], $idExam, $question['point']);
            if ($idQuestion == $question['idQuestion']) {
                $questionsAdded = true;
            }
        }

        $this->isUserConnected();

        if ($createExamWorked && $questionsAdded)
            $_SESSION['success'] = "L'examen a bien été créé";
        else
            $_SESSION['error'] = "Une erreur est survenue lors de la création de l'examen";

        unset($_SESSION['newExam']);

        $this->redirect(URL_BASE . DS . 'examens');
    }

    public function deleteExam($id)
    {
        $this->isUserConnected();
        $this->loadModel('Exam');
        $this->Exam->deleteQuestionInExam($id);
        $this->Exam->deleteExam($id);
        $this->redirect(URL_BASE . DS . 'examens');
    }

    public function printExam($idExam)
    {
        $this->loadModel('Exam');
        $exams_detail = $this->Exam->getExamById($idExam);
        
        $exams = [
            'intitule' => $exams_detail[0]['intitule'],
            'TypeEval_idTypeEval' => $this->Exam->getTypeEvalById($exams_detail[0]['TypeEval_idTypeEval'])[0]['intitule'],
            'coefficient' => $exams_detail[0]['coefficient'],
        ];

        $questions_detail = $this->Exam->getQuestionByExamId($idExam);

        $this->loadModel('Question');
        
        foreach ($questions_detail as $q) {
            $qs = $this->Question->getQuestionById($q['Question_id'])[0];
            $questions[] = [
                'id' => $q['Question_id'],
                'nbPointsPersonnalise' => $q['nbPointsPersonnalise'],
                'intitule' => $qs['question'],
                'sujet' => $this->Question->getSubjectByQuestionId($qs['Sujet_idSujet'])[0]['intitule'],
            ];
        }
        
        $sujets = [];
        for ($i = 0; $i < count($questions); ++$i) {
            if (!in_array($questions[$i]['sujet'], $sujets)) {
                $sujets[] = $questions[$i]['sujet'];
            }
            $sujets[][] = [
                'intitule' => $questions[$i]['intitule'],
                'point' => $questions[$i]['nbPointsPersonnalise']
            ];
        }
        
        require_once(ROOT . DS . INCLUDES . DS . 'FPDF' . DS . 'pdf.php');
        $pdf = new PDF();
        $pdf->SetTitle('Examen');
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $height = 0;

        for ($i = 0; $i < count($sujets); $i++) {
            $pdf->SetFont('Helvetica', '', 12);

            if ($height > $pdf->GetPageHeight() - 20 || $i == 0) {
                if ($i == 0) {
                    $pdf->SetFont('Helvetica', 'B', 16);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'windows-1252', $exams['intitule']), 0, 1, 'C');
                    $pdf->SetFont('Helvetica', '', 12);
                    $pdf->Cell(0, 12, iconv('UTF-8', 'windows-1252', $exams['TypeEval_idTypeEval']) . ' Coefficient: ' . $exams['coefficient'], 0, 1, 'C');
                    $pdf->Line(12, 30, 200, 30);
                    $height = 50;
                } else {
                    $height = 0;
                    $pdf->AddPage();
                }
            }

            if (is_string($sujets[$i])) {
                $pdf->SetFont('Helvetica', 'B', 16);
                $pdf->SetTextColor(78, 115, 223);
                $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', $sujets[$i]), 0, 1, 'L');
                $pdf->SetTextColor(0, 0, 0);
                $height += 12;
            } else if (is_array($sujets[$i])) {
                foreach ($sujets[$i] as $question) {
                    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', '(' . $question['point']) . 'pts)', 0, 1, 'L');
                    $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $question['intitule']), 0, 'L');
                    $pdf->Ln(3);
                    $height += 12;
                }
            }

        }

        $pdf->Output('D', 'Examen_' . $idExam . '.pdf');
    }
}