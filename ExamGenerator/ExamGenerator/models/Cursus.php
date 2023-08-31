<?php

class Cursus
{
    public function getAllCursus()
    {
        $db = new Database();
        $sql = "SELECT * FROM Cursus ORDER BY 'libelle'";
        return $db->select($sql);
    }

    public function getCursusById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM Cursus WHERE idCursus = $id";
        return $db->select($sql);
    }

    public function updateCursus($id, $libelle)
    {
        $db = new Database();
        $sql = "UPDATE Cursus 
                SET 
                    libelle = :libelle
                WHERE idCursus= $id";
        $params = array(
            ':libelle' => $libelle,
            ':id' => $id
        );
        return $db->queryWithParams($sql, $params);
    }

    public function deleteCursus($id)
    {
        $db = new Database();
        $sql = "DELETE FROM Cursus WHERE idCursus = $id";
        return $db->update($sql);
    }

    public function deleteAssociationCursusNiveau($idCursus)
    {
        $db = new Database();
        $sql = "DELETE FROM NiveauCursus WHERE Cursus_idCursus = $idCursus";
        return $db->update($sql);
    }

    public function deleteAssociationCursusMatiere($idCursus)
    {
        $db = new Database();
        $sql = "DELETE FROM CursusMatiere WHERE Cursus_idCursus = $idCursus";
        return $db->update($sql);
    }

    public function addCursus($libelle)
    {
        $db = new Database();
        $sql = "INSERT INTO Cursus 
                VALUES (LAST_INSERT_ID(), :libelle)";
        $params = array(
            ':libelle' => $libelle
        );
        return $db->queryWithParams($sql, $params);
    }

    public function getCursusByLibelle($libelle)
    {
        $db = new Database();
        $sql = "SELECT * FROM Cursus WHERE libelle = $libelle";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function ifAssociateMatiereExist($idCursus, $idMatiere)
    {
        $db = new Database();
        $sql = "SELECT * FROM CursusMatiere WHERE Cursus_idCursus = $idCursus AND Matiere_idMatiere = $idMatiere";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function associateMatiere($idCursus, $idMatiere)
    {
        $db = new Database();
        $sql = "INSERT INTO CursusMatiere 
                VALUES (:idCursus, :idMatiere)";
        $params = array(
            ':idCursus' => $idCursus,
            ':idMatiere' => $idMatiere
        );
        return $db->queryWithParams($sql, $params);
    }

    public function disassociateMatiere($idCursus, $idMatiere)
    {
        $db = new Database();
        $sql = "DELETE FROM CursusMatiere WHERE Cursus_idCursus = $idCursus AND Matiere_idMatiere = $idMatiere";
        return $db->update($sql);
    }

    public function getAssociateMatiere($idCursus)
    {
        $db = new Database();
        $sql = "SELECT * FROM CursusMatiere WHERE Cursus_idCursus = $idCursus";
        return $db->select($sql);
    }

    public function export($csv)
    {
        $db = new Database();
        $sql = "SELECT * FROM Cursus";
        $result = $db->select($sql);

        $temp_file = tempnam(sys_get_temp_dir(), 'prefix_');
        $file = fopen($temp_file, 'w');
        $csv ? fputcsv($file, ['Cursus']) : fwrite($file, 'Cursus' . PHP_EOL);
        foreach ($result as $fields) {
            $cursus = iconv('UTF-8', 'UTF-8', $fields['libelle']);
            $csv ? fputcsv($file, [$cursus]) : fwrite($file, $cursus . PHP_EOL);
        }
        fclose($file);
        return $temp_file;
    }
}

?>