<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jean Forteroche</title>
    <link rel="stylesheet" href="<?php echo ASSETS;?>style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Sacramento&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/968601638e.js" crossorigin="anonymous"></script>


    <!-- CDN TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector: '.mytextarea'});</script>
</head>

<body>

    <!-- Header -->
    <header>
        <div id="photoJF">
            <img src="<?php echo ASSETS?>img/portrait.jpg" alt="Portrait de Jean Forteroche";/>
        </div>

        <h1>Billet simple pour l' Alaska</h1>

        <div>
            <i class="fas fa-user-circle"></i>
            <?php echo $_SESSION['username']; ?>
        </div>

    </header>


    <!-- Main -->
    <main>
        <?php echo $main;?>
    </main>

    <!-- Footer -->
    <footer>
        <div id="mentions_legales">Mentions légales</div>
        
        <div id="forms">
            <!-- Connexion form -->
            
            <form action="<?php echo HOST;?>deconnexion.html" method="post">
                <input type="submit" value="Se déconnecter" />
            </form>
        </div>

    </footer>


    <!-- <script src="<?php echo JS;?>ajax.js"></script>
    <script src="<?php echo JS;?>comment.js"></script> -->
    <!-- <script src="<?php echo JS;?>globallistener.js"></script> -->
    <script src="<?php echo JS;?>deleteAjax.js"></script>
    <script src="<?php echo JS;?>ignored_report_ajax.js"></script>
    <script src="<?php echo JS;?>status_comment.js"></script>


</body>
</html>