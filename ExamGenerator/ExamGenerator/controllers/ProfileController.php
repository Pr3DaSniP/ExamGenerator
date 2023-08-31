<?php

class ProfileController extends Controller
{

    public function profil()
    {
        $user = $_SESSION['user'];
        $title = 'Mon compte';
        $this->render('profile', true, compact('title', 'user'));
    }

    public function profilUpdate()
    {
        $user = $_SESSION['user'];
        $title = 'Modifier mon compte';
        $this->render('profileUpdate', true, compact('title', 'user'));
    }

    public function profilUpdateSave()
    {
        $user = $_SESSION['user'];
        $user['email'] = $_POST['email'];
        $user['dateNaissance'] = $_POST['dateNaissance'] >= date('Y-m-d') ? date('Y-m-d') : $_POST['dateNaissance'];
        $user['dateLastUpdated'] = date('Y-m-d H:i:s');
        $this->loadModel('Utilisateur');
        if ($this->Utilisateur->updateUser($user)) {
            $_SESSION['user'] = $user;
            $_SESSION['success'] = "Vos informations ont été mises à jour";
            $this->redirect(URL_BASE . DS . 'profil');
        } else {
            $_SESSION['error'] = "Une erreur est survenue";
            $this->redirect(URL_BASE . DS . 'profil');
        }
    }

    public function profileMdp()
    {
        $user = $_SESSION['user'];
        $title = 'Modifier mon mot de passe';
        $this->render('profileMdp', true, compact('title', 'user'));
    }

    public function profileMdpUpdate()
    {
        $user = $_SESSION['user'];
        $currentPassword = $_POST['mdpActuel'];
        $this->loadModel('Utilisateur');
        if ($this->Utilisateur->checkPassword($user['id'], $currentPassword)) {
            $newpass1 = sha1(htmlspecialchars($_POST['mdpNouveau']));
            $newpass2 = sha1(htmlspecialchars($_POST['mdpNouveauConfirm']));
            if ($newpass1 == $newpass2) {
                $user['mdp'] = $newpass1;
                $this->Utilisateur->updateUser($user);
                $_SESSION['success'] = "Votre mot de passe a été mis à jour";
                $this->redirect(URL_BASE . DS . 'profil');
            } else {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas";
                $this->redirect(URL_BASE . DS . 'profil');
            }
        } else {
            $_SESSION['error'] = "Le mot de passe actuel est incorrect";
            $this->redirect(URL_BASE . DS . 'profil');
        }
    }
}