<?php

class ConfigController extends Controller
{
    public function utilisateurs()
    {
        $this->isUserConnected();
        $user = $_SESSION['user'];

        $title = "Les Utilisateurs";
        $this->render('UtilisateursList', true, compact('title', 'user'));
    }

    public function getUtilisateurs()
    {

        $this->loadModel('Utilisateur');
        $utilisateurs = $this->Utilisateur->getAllUtilisateurs();


        function modifier_intitule_champ($champ) {
            switch($champ)
            {
                case 'id':
                    return ('Identifiant');
                    break;
                case 'nom':
                    return ('Nom');
                    break;
                case 'prenom':
                    return ('Prenom');
                    break;
                case 'dateCreation':
                    return ('Date Creation');
                    break;
                case 'dateNaissance':
                    return ('Date Naissance');
                    break;
                case 'email':
                    return ('Email');
                    break;
                case 'role':
                    return ('Role');
                    break;
                default:
                    return $champ;
                    break;
            }
        }

        // Modification des intitulés des champs associatifs
        $utilisateurs_modifies = array_map(function($utilisateurs) {
            // Ajout du champ pour les boutons d'action pour chaque ligne
            $utilisateurs['Actions'] = '<i class="fa fa-pencil-square m-3" ></i> <i class="fas fa-trash-alt" ></i>';
            return array_combine(array_map('modifier_intitule_champ', array_keys($utilisateurs)), $utilisateurs);
        }, $utilisateurs);


        $json = json_encode($utilisateurs_modifies);
        header('Content-Type: application/json');
        echo $json;
    }

    public function insertUtilisateur() {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $this->loadModel('Utilisateur');
        $datas = $_POST;
        $this->Utilisateur->insert($datas);
    }

    public function updateUtilisateur() {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $this->loadModel('Utilisateur');
        $json_data = file_get_contents('php://input');
        $datas = json_decode($json_data, true);
        $this->Utilisateur->updateUser($datas);
    }

    public function deleteUtilisateur() {
        $this->isUserConnected();
        $user = $_SESSION['user'];
        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $this->loadModel('Utilisateur');
        $datas = $_POST;
        $this->Utilisateur->delete($datas);
    }

}
