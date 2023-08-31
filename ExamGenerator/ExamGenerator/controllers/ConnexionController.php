<?php

class ConnexionController extends Controller
{

    // GET
    // --------------------------------------------

    public function login()
    {
        $title = "Connexion";
        $this->render('login', false, compact('title'));
    }

    public function register()
    {
        $title = "Créer un compte";
        $this->render('register', false, compact('title'));
    }

    public function password_reset()
    {
        $title = "Récupération de mot de passe";
        $this->render('password_reset', false, compact('title'));
    }

    public function logout()
    {
        session_destroy();
        header('Location: ./');
    }

    // POST
    // --------------------------------------------

    public function checkUser()
    {
        $this->loadModel('Utilisateur');
        if ($this->Utilisateur->checkUser($_POST['email'], $_POST['password'])) {
            $this->redirect(URL_BASE . DS . 'home');
        } else {
            $_SESSION['error'] = "Identifiants incorrects";
            $this->redirect(URL_BASE . DS);
        }
    }

    public function registerUser()
    {
        $this->loadModel('Utilisateur');
        $datas = $_POST;
        if ($this->Utilisateur->registerUser($datas)) {
            $success = "Votre compte a bien été créé";
            $title = "Connexion";
            $this->render('login', false, compact('title', 'success'));
        } else {
            $errors = "Une utilisateur existe déjà avec cette adresse e-mail";
            $title = "Créer un compte";
            $this->render('register', false, compact('title', 'errors'));
        }
    }

    public function recoveryPassUser()
    {
        $this->loadModel('Utilisateur');
        if ($this->Utilisateur->recoveryPassUser($_POST['email'])) {
            $_SESSION['success'] = "Un email vous a été envoyé (Pas encore implémenté)";
            $this->redirect(URL_BASE . DS);
        } else {
            $_SESSION['error'] = "Une erreur est survenue";
            $this->redirect(URL_BASE . DS . 'password_reset');
        }
    }
}