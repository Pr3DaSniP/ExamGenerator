<?php

class Sujet
{
    public function getAllSubjects()
    {
        $db = new Database();
        $sql = "SELECT * FROM sujet ORDER BY 'intitule'";
        return $db->select($sql);
    }

    public function ifSubjectExist($intitule)
    {
        $db = new Database();
        $intitule = $db->pdo->quote($intitule);
        $sql = "SELECT * FROM sujet WHERE intitule = $intitule";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSubjectById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM sujet WHERE idSujet = $id";
        return $db->select($sql);
    }

    public function getIDFromIntitule($intitule)
    {
        $db = new Database();
        $intitule = $db->pdo->quote($intitule);
        $sql = "SELECT idSujet FROM sujet WHERE intitule = $intitule";
        return $db->select($sql);
    }

    public function updateSubject($idSujet, $intitule)
    {
        $db = new Database();
        $sql = "UPDATE sujet 
                SET 
                    intitule = :intitule
                WHERE idSujet = :idSujet";
        $params = array(
            ':intitule' => $intitule,
            ':idSujet' => $idSujet
        );
        return $db->queryWithParams($sql, $params);
    }

    public function deleteQuestionsFromSubject($id)
    {
        $db = new Database();
        $sql = "DELETE FROM question WHERE Sujet_idSujet = :id";
        $params = array(
            ':id' => $id
        );
        return $db->queryWithParams($sql, $params);
    }

    public function deleteSubject($id)
    {
        $db = new Database();
        $sql = "DELETE FROM sujet WHERE idSujet = :id";
        $params = array(
            ':id' => $id
        );
        return $db->queryWithParams($sql, $params);
    }

    public function addSubject($intitule)
    {
        $db = new Database();
        $sql = "INSERT INTO sujet (intitule) VALUES (:intitule)";
        $params = array(
            ':intitule' => $intitule
        );
        return $db->queryWithParams($sql, $params);
    }

    public function getQuestionsFromSubject($idSujet)
    {
        $db = new Database();
        $sql = "SELECT * FROM question WHERE Sujet_idSujet = $idSujet";
        return $db->select($sql);
    }

    public function removeSubjetFromQuestion($idSujet)
    {
        $db = new Database();
        $sql = "UPDATE question SET Sujet_idSujet = NULL WHERE id = :idSujet";
        $params = array(
            ':idSujet' => $idSujet
        );
        return $db->queryWithParams($sql, $params);
    }

    public function removeAllSubjectsFromQuestion($idSujet)
    {
        $db = new Database();
        $sql = "UPDATE question SET Sujet_idSujet = NULL WHERE Sujet_idSujet = :idSujet";
        $params = array(
            ':idSujet' => $idSujet
        );
        return $db->queryWithParams($sql, $params);
    }

    public function addQuestionToSujet($idQuestion, $idSujet)
    {
        $db = new Database();
        $sql = "UPDATE question SET Sujet_idSujet = :idSujet WHERE id = :idQuestion";
        $params = array(
            ':idSujet' => $idSujet,
            ':idQuestion' => $idQuestion
        );
        return $db->queryWithParams($sql, $params);
    }

    public function getSubjectsByMatiere($idMatiere)
    {
        $db = new Database();
        $sql = "SELECT * FROM matieresujet WHERE Matiere_idMatiere = $idMatiere";
        return $db->select($sql);
    }

    public function getNbQuestionsFromSubject($idSujet)
    {
        $db = new Database();
        $sql = "SELECT COUNT(*) FROM question WHERE Sujet_idSujet = $idSujet";
        return $db->select($sql);
    }

    public function export($csv)
    {
        $db = new Database();
        $sql = "SELECT * FROM sujet ORDER BY 'intitule'";
        $result = $db->select($sql);

        $temp_file = tempnam(sys_get_temp_dir(), 'prefix_');
        $file = fopen($temp_file, 'w');
        $csv ? fputcsv($file, ['Sujets']) : fwrite($file, 'Sujets' . PHP_EOL);
        foreach ($result as $fields) {
            $sujet = iconv('UTF-8', 'UTF-8', $fields['intitule']);
            $csv ? fputcsv($file, [$sujet]) : fwrite($file, $sujet . PHP_EOL);
        }
        fclose($file);
        return $temp_file;
    }
}