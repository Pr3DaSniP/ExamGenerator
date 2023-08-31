<?php

class Exam
{
    public function getAllExams()
    {
        $db = new Database();
        $sql = "SELECT * FROM Examen";
        return $db->select($sql);
    }

    public function getExamById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM Examen WHERE idExamen = $id";
        return $db->select($sql);
    }

    public function getExamByStudent($id)
    {
        $db = new Database();
        $sql = "SELECT *, Examen.intitule as Titre, TypeEval.intitule as TypeEval FROM Examen
                INNER JOIN TypeEval on Examen.TypeEval_idTypeEval = TypeEval.idTypeEval
                INNER JOIN qestiondansexamen on Examen.idExamen = qestiondansexamen.Examen_idExamen 
                INNER JOIN question on qestiondansexamen.Question_id = question.id
                INNER JOIN reponseutilisateur on question.id = reponseutilisateur.Question_id 
                INNER JOIN utilisateur on reponseutilisateur.Utilisateur_id = utilisateur.id 
                WHERE utilisateur.id = $id  
                GROUP BY Examen.intitule";
        return $db->select($sql);
    }

    public function getAnswerFromExamByStudent($id, $idExam)
    {
        $db = new Database();
        $sql = "SELECT * FROM Examen
                INNER JOIN TypeEval on Examen.TypeEval_idTypeEval = TypeEval.idTypeEval
                INNER JOIN qestiondansexamen on Examen.idExamen = qestiondansexamen.Examen_idExamen 
                INNER JOIN question on qestiondansexamen.Question_id = question.id
                INNER JOIN reponseutilisateur on question.id = reponseutilisateur.Question_id 
                INNER JOIN utilisateur on reponseutilisateur.Utilisateur_id = utilisateur.id 
                WHERE utilisateur.id = $id AND examen.idExamen = $idExam";
        return $db->select($sql);
    }

    public function getTypeEval()
    {
        $db = new Database();
        $sql = "SELECT * FROM TypeEval";
        return $db->select($sql);
    }

    public function getTypeEvalById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM TypeEval WHERE idTypeEval = $id";
        return $db->select($sql);
    }

    public function getLastExamId()
    {
        $db = new Database();
        $sql = "SELECT idExamen FROM Examen ORDER BY idExamen DESC";
        $res = $db->select($sql);
        return count($res);
    }

    public function createExam($intitule, $coef, $typeEvalId)
    {
        $lastId = $this->getLastExamId() + 1;
        $db = new Database();
        $sql = "INSERT INTO Examen (idExamen, intitule, coefficient, TypeEval_idTypeEval) 
                VALUES (:lastId, :intitule, :coef, :typeEvalId)";
        $params = array(
            ':lastId' => $lastId,
            ':intitule' => $intitule,
            ':coef' => $coef,
            ':typeEvalId' => $typeEvalId
        );
        $db->queryWithParams($sql, $params);
        return $lastId;
    }

    public function addQuestionToExam($questionId, $examId, $customPoint)
    {
        $db = new Database();
        $sql = "INSERT INTO qestiondansexamen (Question_id, Examen_idExamen, nbPointsPersonnalise) 
                VALUES (:questionId, :examId, :customPoint)";
        $params = array(
            ':questionId' => $questionId,
            ':examId' => $examId,
            ':customPoint' => $customPoint
        );
        $db->queryWithParams($sql, $params);
        return $questionId;
    }

    public function deleteQuestionInExam($id)
    {
        $db = new Database();
        $sql = "DELETE FROM qestiondansexamen WHERE Examen_idExamen = $id";
        return $db->delete($sql);
    }

    public function deleteExam($id)
    {
        $db = new Database();
        $sql = "DELETE FROM Examen WHERE idExamen = $id";
        return $db->delete($sql);
    }

    public function getQuestionByExamId($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM qestiondansexamen WHERE Examen_idExamen = $id";
        return $db->select($sql);
    }
}

?>