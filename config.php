<?php

class MyAutoload {
    
    public static function start() { //je la place en static car je ne l'utiliserai qu'une seule fois dans l'appli
        
        /**gestion des erreurs */
        ini_set('display_erros', 'on'); //Affiche les erreurs d'analyse
        error_reporting(E_ALL); //Reporte toutes les erreurs PHP

        //lancer la session
        session_start();

        //je déclare la fonction autoload qui est située dans la class en cours avec la méthode autoLoad
        spl_autoload_register(array(__CLASS__, 'autoload'));
        
        /**je crée les liens absolus */
        $host = $_SERVER['HTTP_HOST'];
        $root = $_SERVER['DOCUMENT_ROOT'];

        define('ROOT', $root.'/jean_forteroche/'); //chemin par dossier
        define('HOST', 'http://'.$host.'/jean_forteroche/'); //chemin d'url

        /**je définis où est mon controller... */
        define('CONTROLLER', ROOT.'controller/');
        define('VIEW', ROOT.'view/');
        define('USER', VIEW.'user/');
        define('ADMIN', VIEW.'admin/');
        define('MODEL', ROOT.'model/');
        define('CLASSES', ROOT.'classes/');
        define('ASSETS', HOST.'assets/');
        define('JS', ASSETS.'js/');
    }

    public static function autoload($class) {
        if(file_exists(MODEL.$class.'.php')) {
            include_once(MODEL.$class.'.php');
        } else if(file_exists(CLASSES.$class.'.php')) {
            include_once(CLASSES.$class.'.php');
        } else if(file_exists(CONTROLLER.$class.'.php')) {
            include_once(CONTROLLER.$class.'.php');
        } else if(file_exists(JS.$class.'.js')) {
            include_once(JS.$class.'.js');
        }
    }
}

