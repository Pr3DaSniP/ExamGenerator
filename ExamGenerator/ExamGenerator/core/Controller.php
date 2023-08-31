<?php

class Controller
{
    protected $viewPath;
    protected $template;

    public function __construct()
    {
        $this->viewPath = ROOT . DS . VIEWS;
        $this->template = $this->viewPath . DS . 'template.php';
    }

    protected function render($view, $withTemplate = false, $variables = [])
    {
        if ($withTemplate) {
            ob_start();
            extract($variables);
            require($this->viewPath . DS . get_class($this) . DS . $view . '.php');
            $contentfile = ob_get_clean();
            require_once($this->template);
        } else {
            extract($variables);
            require($this->viewPath . DS . get_class($this) . DS . $view . '.php');
        }
    }

    protected function loadModel($model)
    {
        require_once ROOT . DS . MODEL . DS . $model . '.php';
        $this->$model = new $model();
    }

    protected function redirect($route)
    {
        header('Location: ' . $route);
    }

    protected function isUserConnected()
    {
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            header('Location: ./');
        }
    }
}