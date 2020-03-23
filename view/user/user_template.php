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
            
                <!-- <a href="<?php echo HOST;?>admin_home_page.html">Espace administrateur</a> -->
                <div id="form_connection">
                    <form action="<?php echo HOST ;?>connection_admin.html" method="post">
                        <label for="username_connect">Pseudo</label>
                            <input type="text" name="username_connect" required/>
                        <label for="password">Mot de passe</label>
                            <input type="password" name="password_connect" required/>
                        <input type="submit" value="Se connecter"/>
                    </form>
                </div>

            <!-- Connexion form -->
            <div id="form_inscription">
                <h2>Inscription</h2>
                <form action="<?php echo HOST ;?>inscription_user.html" method="post">
                    <label for="username">Pseudo
                        <input type="text" name="username" required/>
                    </label>
                    <label for="password">Mot de passe
                        <input type="password" name="password" required/>
                    </label>
                    <label for="password_confirm">Confirmez le mot de passe
                        <input type="password" name="password_confirm" required/>
                    </label>
                    <input type="submit" value="S'inscrire"/>
                </form>
            </div>
        </div>

    </footer>

<!-- Fichiers js -->

</body>
</html>