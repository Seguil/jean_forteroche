<?php

class View {
    private $page;

    public function __construct($page = null) {
        $this->page = $page;
    }

    public function render($params = array()) {
        extract($params); 

        $page = $this->page;
        ob_start();
        include(USER.trim($page.'.php'));
        $main = ob_get_clean();

        include_once(USER.trim('user_template.php'));
    }

    public function renderAdmin($params = array()) {
        extract($params);

        $page = $this->page;
     
        ob_start();
        include(ADMIN.trim($page.'.php'));
        $main = ob_get_clean();

        include_once(ADMIN.trim('admin_template.php'));
    }

    public function redirect($route) {
        header('Location: '.HOST.$route);
        exit;
    }
}