<?php

class Professeur
{
    public function getAllProfesseurs()
    {
        $db = new Database();
        $sql = "SELECT * FROM Utilisateur 
                INNER JOIN UtilisateurRole on Utilisateur.id = UtilisateurRole.Utilisateur_id WHERE Role_idRole = 1";
        return $db->select($sql);
    }

    public function getAllProfesseursWithReferenceSubject()
    {
        $db = new Database();
        $sql = "SELECT * FROM Utilisateur 
                INNER JOIN UtilisateurRole on Utilisateur.id = UtilisateurRole.Utilisateur_id
                INNER JOIN UtilisateurRespAnnee on Utilisateur.id = UtilisateurRespAnnee.Utilisateur_id
                WHERE Role_idRole = 1";
        return $db->select($sql);
    }

    public function getProfesseurById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM Utilisateur INNER JOIN UtilisateurRole on Utilisateur.id = UtilisateurRole.Utilisateur_id WHERE Role_idRole = 1 AND Utilisateur.id = $id";
        return $db->select($sql);
    }

    public function getMatiereFromProfesseur($id)
    {
        $db = new Database();
        $sql = "SELECT matiere.intitule FROM matiere INNER JOIN utilisateurrespannee on matiere.idMatiere = utilisateurrespannee.Matiere_idMatiere INNER JOIN utilisateur on utilisateurrespannee.Utilisateur_id = utilisateur.id WHERE Utilisateur.id = $id";
        return $db->select($sql);
    }

    public function updateProfesseur($idProf, $idMat)
    {
        $db = new Database();
        $sql = "UPDATE UtilisateurRespAnnee 
                SET 
                    Matiere_idMatiere = :idMat
                WHERE Utilisateur_id = :idProf";
        $params = array(
            ':idMat' => $idMat,
            ':idProf' => $idProf
        );
        return $db->queryWithParams($sql, $params);
    }

    public function disassociateProfesseur($id)
    {
        $db = new Database();
        $sql = "DELETE FROM UtilisateurRespAnnee WHERE Utilisateur_id = $id";
        return $db->delete($sql);
    }

    public function addProfesseur($id, $annee, $idMat)
    {
        $db = new Database();
        $sql = "INSERT INTO UtilisateurRespAnnee (Utilisateur_id, AnneeScolaire_id, Matiere_idMatiere) 
                VALUES (:id, :annee, :idMat)";
        $params = array(
            ':id' => $id,
            ':annee' => $annee,
            ':idMat' => $idMat
        );
        return $db->queryWithParams($sql, $params);
    }

    public function getIDFromNomPrenom($nom, $prenom)
    {
        $db = new Database();
        $sql = "SELECT id 
                FROM utilisateur 
                WHERE nom = :nom AND prenom = :prenom";
        $params = array(
            ':nom' => $nom,
            ':prenom' => $prenom
        );
        return $db->queryWithParams($sql, $params);
    }

    public function ifProfesseurExist($nom, $prenom)
    {
        $db = new Database();
        $sql = "SELECT * FROM Utilisateur 
                INNER JOIN UtilisateurRole on Utilisateur.id = UtilisateurRole.Utilisateur_id WHERE Role_idRole = 1 
                AND nom = '$nom' AND prenom = '$prenom'";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function ifProfesseurHasMatiere($idProf)
    {
        $db = new Database();
        $sql = "SELECT * FROM UtilisateurRespAnnee WHERE Utilisateur_id = $idProf";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function getEleves($idProf)
    {
        $db = new Database();
        $sql = 'SELECT u.id as ID, u.nom as Nom, u.prenom as Prenom, u.email as Email, CONCAT(n.intitule," ",cursus.libelle) as Classe,  AVG(r.noteAttribuee) AS Moyenne
            FROM utilisateur u
            INNER JOIN reponseutilisateur r ON u.id = r.Utilisateur_id
            INNER JOIN question q ON r.Question_id = q.id
            INNER JOIN qestiondansexamen qe ON q.id = qe.Question_id
            INNER JOIN Examen e ON qe.Examen_idExamen = e.idExamen
            INNER JOIN matiereSujet ms ON q.Sujet_idSujet = ms.Sujet_idSujet
            INNER JOIN utilisateurRespAnnee ura ON ms.Matiere_idMatiere = ura.Matiere_idMatiere
            inner join cursusmatiere cm ON ms.Matiere_idMatiere = cm.Matiere_idMatiere
            inner join cursus on cm.Cursus_idCursus = cursus.idCursus
            inner join niveaucursus nc on cursus.idCursus = nc.Cursus_idCursus
            inner join niveau n on nc.Niveau_idNiveau = n.idNiveau
            WHERE ura.Utilisateur_id = '. $idProf .'
            GROUP BY u.id, u.nom, u.prenom, u.email, n.intitule, cursus.libelle
            ';
        $res = $db->select($sql);
        if (count($res) > 0) {
            return $res[0];

        } else {
            return null;

        }
    }

    public function getClasses($idProf)
    {
        $db = new Database();
        $sql = "SELECT cu.libelle as Cursus, n.intitule as Niveau
            FROM cursus cu 
            inner join cursusmatiere cm on cu.idCursus = cm.Cursus_idCursus
            inner join niveaucursus nc on cu.idCursus = nc.Cursus_idCursus
            INNER JOIN niveau n ON nc.Niveau_idNiveau =n.idNiveau
            inner join utilisateurrespannee ursp on cm.Matiere_idMatiere = ursp.Matiere_idMatiere
            WHERE ursp.Utilisateur_id = ". $idProf ."
            GROUP BY cu.libelle, n.intitule;
            ";
        $res = $db->select($sql);
        if (count($res) > 0) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function export($csv)
    {
        $professeurs = $this->getAllProfesseursWithReferenceSubject();
        $professeurs = [...$professeurs];
        for ($i = 0; $i < count($professeurs); $i++) {
            $id = $professeurs[$i]['id'];
            $matiere = $this->getMatiereFromProfesseur($id);
            if ($matiere != null) {
                $professeurs[$i]['matiere'] = $matiere['0']['intitule'];
            } else {
                $professeurs[$i]['matiere'] = "Aucune matière";
            }
        }

        $temp_file = tempnam(sys_get_temp_dir(), 'prefix_');
        $file = fopen($temp_file, 'w');
        $csv ? fputcsv($file, ['Professeurs']) : fwrite($file, 'Professeurs' . PHP_EOL);
        foreach ($professeurs as $fields) {
            $nom = iconv('UTF-8', 'UTF-8', $fields['nom']);
            $prenom = iconv('UTF-8', 'UTF-8', $fields['prenom']);
            $matiere = iconv('UTF-8', 'UTF-8', $fields['matiere']);
            $csv ?
                fputcsv($file, [$nom, $prenom, $matiere]) :
                fwrite($file, $nom . ';' . $prenom . ';' . $matiere . PHP_EOL);
        }
        fclose($file);
        return $temp_file;
    }
}

?>