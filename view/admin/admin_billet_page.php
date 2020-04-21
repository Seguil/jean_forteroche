<aside>
    <a href="<?php echo HOST;?>admin-home-page.html">Page d'accueil</a>

    <div class="pagination">
        <?php
            if($pageCourante == $pagesTotales || ($pageCourante>1 && $pageCourante<$pagesTotales)) { ?>
                <a href="<?= HOST;?>admin-home-page.html/id/<?=$billet->getId();?>/page/<?php echo $pageCourante - 1; ?>">Chapitres suivants</a>
            <?php };?>
    </div>

    <nav>
        <ul>
            <?php foreach($billets as $bil):?>
                <div class="billet">
                    <a href="<?php echo HOST;?>admin-billet-page.html/id/<?php echo $bil->getId(); ?>">
                        <h2>Chapitre n°<?php echo $bil->getNumber();?></h2>
                        <h3><?php echo $bil->getTitle();?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="pagination">
        <?php
            if($pageCourante === 1 || ($pageCourante>1 && $pageCourante<$pagesTotales-1)) { ?>
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

        <div id="read_comments">
            <h4>Commentaires</h4>
            <!-- Publication des commentaires -->
            <?php if(isset($comments)) {
                foreach($comments as $com):?>
                    <div class="comment">
                        <div class="header_comment">
                            <div class="pseudo_comment"><?php echo $com->getPseudo();?></div>
                            <form class="form_report_comment" action="<?php echo HOST;?>user-report-comment.html" method="post">
                                <input name="idComment" type="hidden" value="<?php echo $com->getIdComment();?>"/>
                                <input name="idBillet" type="hidden" value="<?php echo $com->getIdBillet();?>"/>
                                <input name="report" type="hidden" value="on"/>
                                <!-- <input type="submit" value="Signaler" /> -->
                                <button type="submit" title="Signaler"><i class="fas fa-flag"></i></button>
                            </form>
                        </div>
                        <div class="comment_date"><?php echo $com->getCommentDate()->format('d/m/Y');?></div>
                        <div class="comment_content"><?php echo $com->getComment();?></div>
                        <div class="answer"><?php echo $com->getAnswer();?></div>
                    </div>
                <?php endforeach; 
            }?>
        </div>



        <div id="add_comment">
            <h4>Ajouter un commentaire</h4>
            <form action="<?php echo HOST;?>create-comment.html" method="post">
                <label for="pseudo">Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" required/>
                <label for="message">Message :</label>
                    <input type="text" name="message" id="message" required maxlength="250" rows="5"/>
                <input name="billet" type="hidden" value="<?php echo $billet->getId();?>"/><br/>
                <input name="commentDate" type="hidden"/><br/>
                <input name="status" type="hidden" value="non lu"/><br />
                <input name="report" type="hidden" value="off"/><br />
                <input type="submit" value="Envoyer" />
            </form>
        </div>

    </div>
</div>