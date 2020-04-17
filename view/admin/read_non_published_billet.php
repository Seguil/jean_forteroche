<aside>
    <a href="<?php echo HOST;?>admin-home-page.html">Page d'accueil</a>
</aside>

<div id="container">
    <article>
        <h4>Chapitres non publiés</h4>

        <!-- Récupère le chapitre choisi -->
        <h2>Chapitre n°<?php echo $billet->getNumber();?></h2>
        <h3><?php echo $billet->getTitle();?></h3>
        <p><?php echo $billet->getContent();?></p>

        <div class="tdbutton">
            <a  href="<?php echo HOST;?>change-billet.html/id/<?php echo $billet->getId();?>"
                class="buttonChangeBillet"
                title="Modifier">
                <i class="fas fa-edit"></i>
            </a>

            <a  href="#"
                data-href="<?php echo HOST;?>update-billet.html/id/<?php echo $billet->getId();?>/status/published"
                class="buttonPublishedBillet"
                title="Publier">
                <i class="fas fa-share-alt"></i>
            </a>

            <a href="#"
                data-href="<?php echo HOST;?>delete-billet.html/id/<?php echo $billet->getId();?>"
                class="buttonDeleteBillet"
                title="Supprimer">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

    </article>
</div>