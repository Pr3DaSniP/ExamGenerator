<?php

class Matiere
{
    public function getAllMatieres()
    {
        $db = new Database();
        $sql = "SELECT * FROM Matiere ORDER BY 'intitule'";
        return $db->select($sql);
    }

    public function getMatiereById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM Matiere WHERE idMatiere = $id";
        return $db->select($sql);
    }

    public function updateMatiere($id, $intitule)
    {
        $db = new Database();
        $sql = "UPDATE Matiere 
                SET 
                    intitule = :intitule
                WHERE idMatiere= :id";
        $params = array(
            ':intitule' => $intitule,
            ':id' => $id
        );
        return $db->queryWithParams($sql, $params);
    }

    public function deleteMatiere($id)
    {
        $db = new Database();
        $sql = "DELETE FROM Matiere WHERE idMatiere = $id";
        return $db->update($sql);
    }

    public function deleteMatiereFromCursus($id) {
        $db = new Database();
        $sql = "DELETE FROM cursusmatiere WHERE Matiere_idMatiere = $id";
        return $db->update($sql);
    }

    public function addMatiere($intitule)
    {
        $db = new Database();
        $sql = "INSERT INTO Matiere 
                VALUES (LAST_INSERT_ID(), :intitule)";
        $params = array(
            ':intitule' => $intitule
        );
        return $db->queryWithParams($sql, $params);
    }

    public function getMatiereByIntitule($intitule)
    {
        $db = new Database();
        $intitule = $db->pdo->quote($intitule);
        $sql = "SELECT * FROM Matiere WHERE intitule = $intitule";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function getIDFromIntitule($intitule)
    {
        $db = new Database();
        $intitule = $db->pdo->quote($intitule);
        $sql = "SELECT idMatiere FROM Matiere WHERE intitule = $intitule";
        return $db->select($sql);
    }

    public function ifMatiereIsBindToProf($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM utilisateurrespannee WHERE Matiere_idMatiere = $id";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function removeSujetsToMatiere($idMatiere) {
        $db = new Database();
        $sql = "DELETE FROM matieresujet WHERE Matiere_idMatiere = $idMatiere";
        return $db->update($sql);
    }

    public function addSujetToMatiere($idMatiere, $idSujet) {
        $db = new Database();
        $sql = "INSERT INTO matieresujet VALUES (:idMatiere, :idSujet)";
        $params = array(
            ':idMatiere' => $idMatiere,
            ':idSujet' => $idSujet
        );
        return $db->queryWithParams($sql, $params);
    }

    public function getSubjectsFromMatiere($idMatiere) {
        $db = new Database();
        $sql = "SELECT * FROM matieresujet WHERE Matiere_idMatiere = $idMatiere";
        return $db->select($sql);
    }

    public function export($csv)
    {
        $db = new Database();
        $sql = "SELECT * FROM Matiere";
        $result = $db->select($sql);

        $temp_file = tempnam(sys_get_temp_dir(), 'prefix_');
        $file = fopen($temp_file, 'w');
        $csv ? fputcsv($file, ['Matieres']) : fwrite($file, 'Matieres' . PHP_EOL);
        foreach ($result as $fields) {
            $matiere = iconv('UTF-8', 'UTF-8', $fields['intitule']);
            $csv ? fputcsv($file, [$matiere]) : fwrite($file, $matiere . PHP_EOL);
        }
        fclose($file);
        return $temp_file;
    }
}

?>