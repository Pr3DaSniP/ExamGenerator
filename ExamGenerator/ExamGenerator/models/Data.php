<?php

class Data
{
    public function getAverageStudent($id)
    {
        $db = new Database();
        $sql = "SELECT SUM(SommeNoteAttribuee * coeff) / SUM(coeff) as Moyenne 
        FROM ( 
            SELECT Examen.*, utilisateur.*, SUM(reponseutilisateur.noteAttribuee) as SommeNoteAttribuee, examen.coefficient as coeff FROM Examen 
            INNER JOIN qestiondansexamen ON Examen.idExamen = qestiondansexamen.Examen_idExamen 
            INNER JOIN question ON qestiondansexamen.Question_id = question.id 
            INNER JOIN reponseutilisateur ON question.id = reponseutilisateur.Question_id 
            INNER JOIN utilisateur ON reponseutilisateur.Utilisateur_id = utilisateur.id 
            WHERE utilisateur.id =" . $id . " 
            GROUP BY examen.idExamen ) 
            AS Note";
        return $db->select($sql);
    }

    public function getGradeStudent($id)
    {
        $db = new Database();
        $sql = "SELECT Examen.*, utilisateur.*, SUM(reponseutilisateur.noteAttribuee) as SommeNoteAttribuee FROM Examen 
        INNER JOIN qestiondansexamen ON Examen.idExamen = qestiondansexamen.Examen_idExamen 
        INNER JOIN question ON qestiondansexamen.Question_id = question.id 
        INNER JOIN reponseutilisateur ON question.id = reponseutilisateur.Question_id 
        INNER JOIN utilisateur ON reponseutilisateur.Utilisateur_id = utilisateur.id 
        WHERE utilisateur.id =" . $id . "
        GROUP BY examen.idExamen";
        return $db->select($sql);
    }

    public function getAverageGradeOnStudy($id)
    {
        $db = new Database();
        $sql = "SELECT titre, AVG(SommeNoteAttribuee) as Moyenne from (        
            SELECT matiere.intitule as titre, Examen.*, utilisateur.*, SUM(reponseutilisateur.noteAttribuee) as SommeNoteAttribuee FROM Examen 
            INNER JOIN qestiondansexamen ON Examen.idExamen = qestiondansexamen.Examen_idExamen 
            INNER JOIN question ON qestiondansexamen.Question_id = question.id 
            INNER JOIN sujet on question.Sujet_idSujet = sujet.idSujet
            INNER JOIN matieresujet on sujet.idSujet = matieresujet.Sujet_idSujet
            INNER JOIN matiere on matieresujet.Matiere_idMatiere = matiere.idMatiere
            INNER JOIN reponseutilisateur ON question.id = reponseutilisateur.Question_id 
            INNER JOIN utilisateur ON reponseutilisateur.Utilisateur_id = utilisateur.id 
            WHERE matiere.intitule = (SELECT matiere.intitule FROM matiere INNER JOIN utilisateurrespannee on matiere.idMatiere = utilisateurrespannee.Matiere_idMatiere INNER JOIN utilisateur on utilisateurrespannee.Utilisateur_id = utilisateur.id WHERE Utilisateur.id =" . $id . ")
            GROUP BY matiere.intitule, utilisateur.id ) as Note";
        return $db->select($sql);
    }

    public function getNbNoteStudent($id)
    {
        return count($this->getGradeStudent($id));
    }

    public function getQuestionsPerSubject()
    {
        $db = new Database();
        $sql = "SELECT sujet.intitule as Sujet, COUNT(question.id) as NombreQuestions FROM question 
                INNER JOIN sujet on question.Sujet_idSujet = sujet.idSujet
                GROUP BY Sujet_idSujet";
        return $db->select($sql);
    }

    public function getNbQuestion() {
        $db = new Database();
        $sql = "SELECT COUNT(*) as NombreQuestions FROM question";
        return $db->select($sql);
    }
}

?>