<?php
include_once('config.php');

MyAutoload::start();

/**redéfinition d'url */
//index.php?r=user-home-page.html
if (isset($_GET['r']))
  {
    $request  =$_GET['r'];
  } else {
    $request = 'user-home-page.html'; //ou homepage.html?
  }
$routeur = new Routeur($request);
$routeur->renderController();




// url saisie http://localhost/jean_forteroche/user-home-page.html


// htaccess > override Apache (server web qui écoute locahlhost:80 http)

// nouvelle url : index.php?r=user-home-page.html


// index.php