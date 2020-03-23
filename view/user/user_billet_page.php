<aside>
    <a href="<?php echo HOST;?>user-home-page.html">Page d'accueil</a>
<!-- <div class="nav_chapters">
    <h2 class="number">3</h2>
    <h3 class="title">aze</h3>
</div> -->

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
                    <a href="<?php echo HOST;?>user-billet-page.html/id/<?php echo $bil->getId(); ?>">
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


<?php
    for($i=1; $i<=$pagesTotales;$i++) {
        if($i==$pageCourante) {
            echo $i.' ';
        } else {
            echo '<a href="?page='.$i.'">'.$i. '</a>';
        }
    };
?>

</aside>

<div id="container">
    <article>
        <!-- Récupère le chapitre choisi -->
        <h2>Chapitre n°<?php echo $billet->getNumber();?></h2>
        <h3><?php echo $billet->getTitle();?></h3>
        <p><?php echo $billet->getContent();?></p>
        <p>Publié le <?php echo $billet->getPublicationDate()->format('d/m/Y');?></p>
    </article>

    <div id="comments">
        <h4>Commentaires</h4>
        <button>Ajouter un commentaire</button>
        <form action="<?php echo HOST;?>create-comment.html" method="post">
            <label for="message">Message :</label>
            <input type="text" name="message" id="message" />
            <input name="billet" type="hidden" value="<?php echo $billet->getId();?>"/><br />
            <input name="report" type="hidden" value="off"/><br />
            <input type="submit" value="Envoyer" />
        </form>

        <!-- PUblication des commentaires -->
        <?php if(isset($comments)) {
            foreach($comments as $com):?>
                <div class="comment">
                    <?php echo $com->getComment(); ?><br/>
                    <?php echo $com->getCommentDate()->format('d/m/Y'); ?><br/>
                    <form action="<?php echo HOST;?>report-comment.html" method="post">
                        <input name="idComment" type="hidden" value="<?php echo $com->getIdComment();?>"/>
                        <p><?php echo $com->getIdComment();?></p>
                        <input name="idBillet" type="hidden" value="<?php echo $com->getIdBillet();?>"/>
                        <label for="report"><i class="fas fa-exclamation-triangle"></i></label>
                        <input type="checkbox" name="report" value="on"/>
                        <input type="submit" value="Signaler" />
                    </form>
                </div>
            <?php endforeach; 
        }?>
    </div>
</div>
