<?php
session_start();
require_once '_defines.php';
require_once 'core/router/Router.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';


spl_autoload_register(function ($class) {
    // Contient le mot Controller
    if (preg_match('/Controller/', $class)) {
        $file = 'controllers/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

$router = new Router($_GET['url']);

// CURSUS
// --------------------------------------------

$router->post('/cursus/update/:id', 'CursusController#CursusUpdate'); // ✔

$router->post('/cursus/delete/:id', 'CursusController#CursusDelete'); // ✔

$router->post('/cursus/add', 'CursusController#addCursus'); // ✔

$router->post('/cursus/associate', 'CursusController#associate'); // ✔

$router->post('/cursus/disassociate', 'CursusController#disassociate'); // ✔

$router->get('/cursus/associate/:id', 'CursusController#associateMatiere'); // ✔

$router->get('/cursus/new', 'CursusController#newCursus'); // ✔

$router->get('/cursus/:id', 'CursusController#getCursusDetails'); // ✔

$router->get('/cursus', 'CursusController#getCursusList'); // ✔



// NIVEAUX
// --------------------------------------------

$router->post('/niveaux/update/:id', 'NiveauxController#NiveauUpdate'); // ✔

$router->post('/niveaux/delete/:id', 'NiveauxController#NiveauDelete'); // ✔

$router->post('/niveaux/add', 'NiveauxController#addNiveau'); // ✔

$router->post('/niveaux/associate', 'NiveauxController#associate'); // ✔

$router->post('/niveaux/disassociate', 'NiveauxController#disassociate'); // ✔

$router->get('/niveaux/associate/:id', 'NiveauxController#associateCursus'); // ✔

$router->get('/niveaux/new', 'NiveauxController#newNiveau'); // ✔

$router->get('/niveaux/:id', 'NiveauxController#getNiveauDetails'); // ✔

$router->get('/niveaux', 'NiveauxController#getNiveauxList'); // ✔


// MATIERES
// --------------------------------------------

$router->post('/matieres/addSujetToMatiere/:id', 'MatiereController#addSujetToMatiere'); // ✔

$router->get('/matieres/sujets/add/:id', 'MatiereController#SujetToMatiere'); // ✔

$router->post('/matieres/update/:id', 'MatiereController#MatiereUpdate'); // ✔

$router->post('/matieres/delete/:id', 'MatiereController#MatiereDelete'); // ✔

$router->post('/matieres/add', 'MatiereController#addMatiere'); // ✔

$router->get('/matieres/new', 'MatiereController#newMatiere'); // ✔

$router->get('/matieres/:id', 'MatiereController#getMatiereDetails'); // ✔

$router->get('/matieres', 'MatiereController#getMatieresList'); // ✔


// CLASSES
// --------------------------------------------

$router->get('/mesClasses', 'ClasseController#getClassesList'); // ✔
$router->get('/getClasses', 'ClasseController#getClasses'); // ✔

// ELEVES
// --------------------------------------------

$router->get('/mesEleves', 'EleveController#getElevesList'); // ✔
$router->get('/getEleves', 'EleveController#getEleves'); // ✔

// PROFESSEURS
// --------------------------------------------

$router->post('/professeurs/update/:id', 'ProfesseurController#ProfesseurUpdate'); // ✔

$router->post('/professeurs/disassociate/:id', 'ProfesseurController#ProfesseurDisassociate'); // ✔

$router->post('/professeurs/add', 'ProfesseurController#associateProfesseur'); // ✔

$router->post('/professeurs/associate/:id', 'ProfesseurController#newProfesseur'); // ✔

$router->get('/professeurs/:id', 'ProfesseurController#getProfesseursDetails'); // ✔

$router->get('/professeurs', 'ProfesseurController#getProfesseursList'); // ✔


// PROFIL
// --------------------------------------------

$router->post('/profil/password/save', 'ProfileController#profileMdpUpdate'); // ✔

$router->post('/profil/save', 'ProfileController#profilUpdateSave'); // ✔

$router->get('/profil', 'ProfileController#profil'); // ✔


// IMPORT DATA
// --------------------------------------------

$router->post('/import_data/import', 'ImportDataController#importDataImport'); // ✔

$router->get('/import_data', 'ImportDataController#importData'); // ✔

// EXPORT DATA
// --------------------------------------------

$router->post('/export_data/export', 'ExportDataController#export'); // ✔

$router->get('/export_data', 'ExportDataController#exportData'); // ✔

// ERROR
// --------------------------------------------

$router->get('/error', 'ErrorController#error404'); // ✔

//EXAMENS
// --------------------------------------------

$router->post('/examens/imprimer/:id', 'ExamController#printExam'); // ✔

$router->post('/examens/delete/:id', 'ExamController#deleteExam'); // ✔

$router->post('/examens/finaliser', 'ExamController#finalise'); // ✔

$router->post('/examens/new/5', 'ExamController#newExamStep5'); // ✔

$router->post('/examens/new/4', 'ExamController#newExamStep4'); // ✔

$router->post('/examens/new/3', 'ExamController#newExamStep3'); // ✔

$router->post('/examens/new/2', 'ExamController#newExamStep2'); // ✔

$router->get('/examens/new/1', 'ExamController#newExamStep1'); // ✔

$router->get('/examens/:id', 'ExamController#getExamDetails'); // ✔

$router->get('/examens', 'ExamController#getExamList'); // ✔

// QUESTIONS
// --------------------------------------------

$router->post('/questions/update/:id', 'QuestionsController#QuestionUpdate'); // ✔

$router->post('/questions/delete/:id', 'QuestionsController#deleteQuestion'); // ✔

$router->post('/questions/add', 'QuestionsController#addQuestion'); // ✔

$router->get('/questions/new', 'QuestionsController#newQuestion'); // ✔

$router->get('/questions/:id', 'QuestionsController#QuestionDetail'); // ✔

$router->get('/questions', 'QuestionsController#QuestionsList'); // ✔   

// SUJETS
// --------------------------------------------

$router->get('/sujets/questions/add/:id', 'SujetsController#QuestionToSujet'); // ✔

$router->post('/sujets/addQuestionToSujet/:id', 'SujetsController#addQuestionToSujet'); // ✔

$router->post('/sujets/delete/:id', 'SujetsController#SujetDelete'); // ✔

$router->post('/sujets/update/:id', 'SujetsController#SujetUpdate'); // ✔

$router->post('/sujets/add', 'SujetsController#addSujet'); // ✔

$router->get('/sujets/new', 'SujetsController#newSujet'); // ✔

$router->get('/sujets/:id', 'SujetsController#getSujetDetails'); // ✔

$router->get('/sujets', 'SujetsController#getSujetsList'); // ✔



// CONFIG UTILISATEURS
// --------------------------------------------

$router->post('/insertUtilisateur', 'ConfigController#insertUtilisateur'); // ✔

$router->post("/deleteUtilisateur", "ConfigController#deleteUtilisateur"); // ✔

$router->post("/updateUtilisateur", "ConfigController#updateUtilisateur"); // ✔

$router->get('/utilisateurs', 'ConfigController#utilisateurs'); // ✔

$router->get('/getUtilisateurs', 'ConfigController#getUtilisateurs'); // ✔

// CONNEXION
// --------------------------------------------

$router->post('/checkUser', 'ConnexionController#checkUser'); // ✔

$router->post('/registerUser', 'ConnexionController#registerUser'); // ✔

$router->post("/recoveryPassUser", "ConnexionController#recoveryPassUser"); // ✔

$router->get('/register', 'ConnexionController#register'); // ✔

$router->get('/password_reset', 'ConnexionController#password_reset'); // ✔

$router->get('/logout', 'ConnexionController#logout'); // ✔            

$router->get('/home', 'HomeController#home'); // ✔

$router->get('/', 'ConnexionController#login'); // ✔


try {
    $router->run();
} catch (Exception $e) {
    if (DEBUG)
        throw $e;
    else
        header('Location: ' . URL_BASE . '/error');
}