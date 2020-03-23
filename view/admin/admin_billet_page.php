<aside>
    <a href="<?php echo HOST;?>admin_home_page.html">Page d'accueil</a>

    <div class="pagination">
        <?php
            if($pageCourante == $pagesTotales || ($pageCourante>1 && $pageCourante<$pagesTotales)) { ?>
                <a href="?page=<?php echo $pageCourante - 1; ?>">Chapitres suivants</a>
            <?php };?>
    </div>

    <nav>
        <ul>
            <?php foreach($billets as $bil):?>
                <div class="billet">
                    <a href="<?php echo HOST;?>admin_billet_page.html/id/<?php echo $bil->getId(); ?>">
                        <h2>Chapitre n°<?php echo $bil->getNumber();?></h2>
                        <h3><?php echo $bil->getTitle();?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="pagination">
        <?php
            if($pageCourante === 1 || ($pageCourante>1 && $pageCourante<$pagesTotales)) { ?>
                <a href="?page=<?php echo $pageCourante + 1; ?>">Chapitres précédents</a>
            <?php };?>
    </div>

</aside>

<div id="container">
    <article>
        <!-- Récupère le chapitre choisi -->
        <h2>Chapitre n°<?php echo $billet->getNumber();?></h2>
        <h3><?php echo $billet->getTitle();?></h3>
        <p><?php echo $billet->getContent();?></p>
        <p>Publié le <?php echo $billet->getPublicationDate() -> format('d/m/Y');?></p>
    </article>

    <div id="comments">
        <h4>Commentaires</h4>
        <button>Ajouter un commentaire</button>
        <form action="<?php echo HOST;?>create_comment.html" method="post">
            <label for="message">Message :</label>
            <input type="text" name="message" id="message" />
            <input name="billet" type="hidden" value="<?php echo $billet->getId();?>" /><br />
            <input type="submit" value="Envoyer" />
        </form>
        <!-- Publication des commentaires -->
        <?php if(isset($comments)) {
            foreach($comments as $com):?>
                <div class="comment">
                    <?php echo $com->getComment(); ?><br/>
                    <?php echo $com->getCommentDate()->format('d/m/Y'); ?><br/>
                    <button id="answer">Répondre</button>
                </div>
            <?php endforeach;
        } ?>
    </div>
</div>
