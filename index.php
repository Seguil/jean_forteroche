<?php
include_once('config.php');

MyAutoload::start();

/**redéfinition d'url */
if (isset($_GET['r'])) {
    $request = $_GET['r'];
} else {
    $request = 'user-home-page.html';
}
$routeur = new Routeur($request);
$routeur->renderController();