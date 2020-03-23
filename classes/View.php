<?php

class View {
    private $page;

    public function __construct($page = null) { //passage ) null car pas d'obligation de passer une page en paramètre s'il y a un redirect
        $this->page = $page;
    }

    public function render($params = array()) {
        extract($params); //parcourt params , crée une extraction de params et lui attribue dynamiquement 'un nom' => et sa valeur

        $page = $this->page;
        
        ob_start();
        include(VIEW.$page.'.php');
        $main = ob_get_clean();

        include_once(VIEW.'template.php');
    }

    public function renderAdmin($params = array()) {
        extract($params); //parcourt params , crée une extraction de params et lui attribue dynamiquement 'un nom' => et sa valeur

        $page = $this->page;
        
        ob_start();
        include(ADMIN.$page.'.php');
        $main = ob_get_clean();

        include_once(ADMIN.'template_admin.php');
    }

    public function redirect($route) {
        header('Location: '.HOST.$route);
        exit;
    }
}