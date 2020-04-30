<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jean Forteroche</title>
    <link rel="stylesheet" href="<?php echo ASSETS;?>style.css"/>
    <link rel="stylesheet" href="<?php echo ASSETS;?>style_media.css"/>
    <link href="https://fonts.googleapis.com/css?family=Sacramento&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/968601638e.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="<?php echo ASSETS;?>img/logo.png"/>

    <!--Référencement-->
    <meta name="author" content="GUILLEMIN Séverine"/>
    <meta name="keywords" content="Jean Forteroche, Un billet simple pour l'Alaska, blog, livre en ligne"/>
    <meta name="description" content="Jean Forteroche publie pour vous son dernier roman en live: Billet simple pour l'Alaska"/>
    <meta name="google-site-verification" content="" />

    <!--Facebook-->
    <meta property="og:title" content="Jean Forteroche - Billet simple pour l'Alaska"/>
    <meta property="og:description" content="Jean Forteroche publie pour vous son dernier roman en live: Billet simple pour l'Alaska"/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content="http://jean-forteroche.guillemin.fr"/>

    <!--Twitter-->
    <meta name = "twitter:card" content="summary"/>
    <meta name="twitter:site" content="@JeanForteroche"/>
    <meta name="twitter:title" content="Jean Forteroche - Billet simple pour l'Alaska"/>
    <meta name="twitter:image:src" content=""/>
    <meta name="twitter:description" content="Jean Forteroche publie pour vous son dernier roman en live: Billet simple pour l'Alaska"/>


    <!-- CDN TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector: '.mytextarea'});</script>
</head>

<body>

    <!-- Header -->
    <header>
            <div id="photoJF">
                <img src="<?php echo ASSETS?>img/portrait.jpg" alt="Portrait de Jean Forteroche"/>
            </div>
            <h1>Billet simple pour l' Alaska</h1>
    </header>


    <!-- Main -->
    <main>
        <?php echo $main;?>
    </main>

    <!-- Footer -->
    <footer>
        <div id="mentions_legales">Mentions légales</div>
        
        <div id="connect_button">
            <button>Espace administrateur</button>
        </div>
        <div id="form">             
            <form id="form_connection" action="<?php echo HOST ;?>connection-admin.html" method="post">
                <label for="username_connect">Pseudo</label>
                    <input id="username_connect" type="text" name="username_connect" required/>
                <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password_connect" required/>
                <input type="submit" value="Se connecter"/>
                <button id="annulation_connect">Annuler</button>
            </form>
        </div>
    </footer>



<!-- Fichiers js -->
<script src="<?php echo JS;?>ajax.js"></script>
<script src="<?php echo JS;?>button.js"></script>
<script src="<?php echo JS;?>main.js"></script>
<script src="<?php echo JS;?>userGlobalListener.js"></script>
<script src="<?php echo JS;?>globalListener.js"></script>


</body>
</html>