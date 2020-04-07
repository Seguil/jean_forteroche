<aside>
    <a href="<?php echo HOST;?>admin-home-page.html">Page d'accueil</a>

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
        <form action="<?php echo HOST;?>create-comment.html" method="post">
            <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo"/>
            <label for="message">Message :</label>
                <input type="text" name="message" id="message" />
            <input name="billet" type="hidden" value="<?php echo $billet->getId();?>"/><br/>
            <input name="commentDate" type="hidden"/><br/>
            <input name="status" type="hidden" value="lu"/><br />
            <input name="report" type="hidden" value="off"/><br />
            <input type="submit" value="Envoyer" />
        </form>

        <!-- Publication des commentaires -->
        <?php if(isset($comments)) {
            foreach($comments as $com):?>
                <div class="comment">
                    <?php echo $com->getPseudo();?><br/>
                    <?php echo $com->getComment();?><br/>
                    <?php echo $com->getCommentDate()->format('d/m/Y');?><br/>
                    <?php echo $com->getAnswer();?><br/>

                    <!-- Signaler un commentaire -->
                    <form action="<?php echo HOST;?>report-comment.html" method="post">
                        <input name="idComment" type="hidden" value="<?php echo $com->getIdComment();?>"/>
                        <input name="idBillet" type="hidden" value="<?php echo $com->getIdBillet();?>"/>
                        <input name="report" type="hidden" value="on"/>
                        <!-- <input type="submit" value="Signaler" /> -->
                        <button type="submit" name="report" value="on" title="Signaler"><i class="fas fa-exclamation-triangle"></i></button>
                    </form>

                    <!-- Répondre à un commentaire -->
                    <button type="submit" name="answer_button" title="Répondre"><i class="fas fa-share"></i></button>
                    
                    <form action="<?php echo HOST;?>answer-comment.html" method="post">
                        <label for="answer">Réponse :</label>
                            <input type="text" name="answerComment" id="answer" value="<?php echo $com->getAnswer();?>"/>
                        <input name="idComment" type="hidden" value="<?php echo $com->getIdComment();?>"/>
                        <input name="idBillet" type="hidden" value="<?php echo $com->getIdBillet();?>"/>
                        <input type="submit" value="Envoyer" />
                    </form>
                </div>
            <?php endforeach; 
        }?>
    </div></div>
