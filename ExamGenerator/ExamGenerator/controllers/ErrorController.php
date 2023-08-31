<?php

class ErrorController extends Controller
{
    public function error404()
    {
        $user = $_SESSION['user'];
        $title = "Erreur 404";
        $this->render('error404', true, compact('title', 'user'));
    }
}