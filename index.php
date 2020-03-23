<?php
include_once('config.php');

MyAutoload::start();

/**redéfinition d'url */
$request = $_GET['r'];//index.php?r=
(isset($_GET['r']))
    ? $request = $_GET['r']
    : $request = 'user_home_page.html'; //ou homepage.html?

$routeur = new Routeur($request);
$routeur->renderController();