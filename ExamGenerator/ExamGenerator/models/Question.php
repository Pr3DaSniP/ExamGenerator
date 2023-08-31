<?php

class Question
{
    public function getAllQuestions()
    {
        $db = new Database();
        $sql = "SELECT * FROM question";
        return $db->select($sql);
    }

    public function getSubjectByQuestionId($id)
    {
        if ($id == NULL)
            return array(
                array(
                    'intitule' => 'Aucun sujet'
                )
            );
        $db = new Database();
        $sql = "SELECT * FROM sujet WHERE idSujet = $id";
        return $db->select($sql);
    }

    public function insertQuestion($intitule, $idSujet, $nbPoints, $reponse)
    {
        $db = new Database();
        $idSujet = empty($idSujet) ? NULL : $idSujet;
        $reponse = empty($reponse) ? NULL : $reponse;
        $sql = "INSERT INTO question (nbPointsDefaut, reponse, question, Sujet_idSujet) 
            VALUES (:nbPoints, :reponse, :question, :sujet)";
        $params = array(
            ':nbPoints' => $nbPoints,
            ':reponse' => $reponse,
            ':question' => $intitule,
            ':sujet' => $idSujet
        );
        return $db->queryWithParams($sql, $params);
    }

    public function deleteQuestion($id)
    {
        $db = new Database();
        $sql = "DELETE FROM question WHERE id = $id";
        return $db->delete($sql);
    }

    public function getQuestionById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM question WHERE id = $id";
        return $db->select($sql);
    }

    public function getQuestionByIntitule($intitule)
    {
        $db = new Database();
        $intitule = $db->pdo->quote($intitule);
        $sql = "SELECT * FROM question WHERE question = $intitule";
        return $db->select($sql);
    }

    public function ifQuestionAlreadyExists($intitule)
    {
        $db = new Database();
        $intitule = $db->pdo->quote($intitule);
        $sql = "SELECT * FROM question WHERE question = $intitule";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateQuestion($id, $intitule, $idSujet, $nbPoints, $reponse)
    {
        $db = new Database();
        $idSujet = empty($idSujet) ? NULL : $idSujet;
        $reponse = empty($reponse) ? NULL : $reponse;
        $sql = "UPDATE question 
                SET 
                    nbPointsDefaut = :nbPoints,
                    reponse = :reponse,
                    question = :question,
                    Sujet_idSujet = :sujet
                WHERE id = :id";
        $params = array(
            ':nbPoints' => $nbPoints,
            ':reponse' => $reponse,
            ':question' => $intitule,
            ':sujet' => $idSujet,
            ':id' => $id
        );
        return $db->queryWithParams($sql, $params);
    }

    public function getQuestionBySubjectId($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM question WHERE Sujet_idSujet = $id";
        return $db->select($sql);
    }

    public function deleteQuestionExam($id) {
        $db = new Database();
        $sql = "DELETE FROM qestiondansexamen WHERE Question_id = $id";
        return $db->delete($sql);
    }

    public function export($csv)
    {
        $db = new Database();
        $sql = "SELECT * FROM question";
        $result = $db->select($sql);

        $temp_file = tempnam(sys_get_temp_dir(), 'prefix_');
        $file = fopen($temp_file, 'w');
        $csv ? fputcsv($file, ['Questions']) : fwrite($file, 'Questions' . PHP_EOL);
        foreach ($result as $fields) {
            $question = iconv('UTF-8', 'UTF-8', $fields['question']);
            $reponse = iconv('UTF-8', 'UTF-8', $fields['reponse']);
            $nbPoints = iconv('UTF-8', 'UTF-8', $fields['nbPointsDefaut']);
            $sujet = iconv('UTF-8', 'UTF-8', $this->getSubjectByQuestionId($fields['Sujet_idSujet'])[0]['intitule']);
            $csv ?
                fputcsv($file, [$question, $reponse, $nbPoints, $sujet]) : fwrite($file, $question . ';' . $reponse . ';' . $nbPoints . ';' . $sujet . PHP_EOL);
        }
        return $temp_file;
    }
}