<?php

class Niveau
{
    public function getAllNiveaux()
    {
        $db = new Database();
        $sql = "SELECT * FROM Niveau ORDER BY 'intitule'";
        return $db->select($sql);
    }

    public function getNiveauById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM Niveau WHERE idNiveau = $id";
        return $db->select($sql);
    }

    public function updateNiveau($id, $intitule)
    {
        $db = new Database();
        $sql = "UPDATE Niveau 
                SET 
                    intitule = :intitule
                WHERE idNiveau= :id";
        $params = array(
            ':intitule' => $intitule,
            ':id' => $id
        );
        return $db->queryWithParams($sql, $params);
    }

    public function deleteNiveau($id)
    {
        $db = new Database();
        $sql = "DELETE FROM Niveau WHERE idNiveau = $id";
        return $db->update($sql);
    }

    public function addNiveau($intitule)
    {
        $db = new Database();
        $sql = "INSERT INTO Niveau 
                VALUES (LAST_INSERT_ID(), :intitule)";
        $params = array(
            ':intitule' => $intitule
        );
        return $db->queryWithParams($sql, $params);
    }

    public function getNiveauByIntitule($intitule)
    {
        $db = new Database();
        $intitule = $db->pdo->quote($intitule);
        $sql = "SELECT * FROM Niveau WHERE Intitule = $intitule";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function ifAssociateCursusExist($idNiveau, $idCursus) {
        $db = new Database();
        $sql = "SELECT * FROM NiveauCursus WHERE Niveau_idNiveau = $idNiveau AND Cursus_idCursus = $idCursus";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function associateCursus($idNiveau, $idCursus)
    {
        $db = new Database();
        $sql = "INSERT INTO NiveauCursus 
                VALUES (:idNiveau, :idCursus)";
        $params = array(
            ':idNiveau' => $idNiveau,
            ':idCursus' => $idCursus
        );
        return $db->queryWithParams($sql, $params);
    }

    public function disassociateCursus($idNiveau, $idCursus) {
        $db = new Database();
        $sql = "DELETE FROM NiveauCursus WHERE Niveau_idNiveau = $idNiveau AND Cursus_idCursus = $idCursus";
        return $db->update($sql);
    }

    public function getAssociateCursus($idNiveau)
    {
        $db = new Database();
        $sql = "SELECT * FROM NiveauCursus WHERE Niveau_idNiveau = $idNiveau";
        return $db->select($sql);
    }

    public function deleteAssociationCursusNiveau($idNiveau)
    {
        $db = new Database();
        $sql = "DELETE FROM NiveauCursus WHERE Niveau_idNiveau = $idNiveau";
        return $db->update($sql);
    }

    public function export($csv)
    {
        $db = new Database();
        $sql = "SELECT * FROM Niveau";
        $result = $db->select($sql);

        $temp_file = tempnam(sys_get_temp_dir(), 'prefix_');
        $file = fopen($temp_file, 'w');
        $csv ? fputcsv($file, ['Niveaux']) : fwrite($file, 'Niveaux' . PHP_EOL);
        foreach ($result as $fields) {
            $niveau = iconv('UTF-8', 'UTF-8', $fields['intitule']);
            $csv ? fputcsv($file, [$niveau]) : fwrite($file, $niveau . PHP_EOL);
        }
        fclose($file);
        return $temp_file;
    }
}

?>