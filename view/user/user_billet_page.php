<div id="responsive_menu_icon">
    <a href="#"><i class="fas fa-bars"></i></a>
</div>


<aside id="nav_aside">
    <a href="<?php echo HOST;?>user-home-page.html" title="Page d'accueil" class="home_link"><i class="fas fa-home"></i></a>


    <nav>
        <ul>
            <?php foreach($billets as $bil):?>
                <div class="billet">

                    <a href="<?php echo HOST;?>user-billet-page.html/number/<?php echo $bil->getNumber(); ?>">
                        <h2>Chapitre n°<?php echo $bil->getNumber();?></h2>
                        <h3><?php echo htmlspecialchars_decode($bil->getTitle());?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </ul>
    </nav>


    <div id="aside_pagination">
        <div class="pagination">
            <?php
                if($pageCourante == $pagesTotales || ($pageCourante>1 && $pageCourante<$pagesTotales)) { ?>
                    <a href="?page=<?php echo $pageCourante - 1; ?>" class="following_chapters">Chapitres suivants</a>
                <?php };
            ?>
        </div>

        <div class="pagination">
            <?php
                if($pageCourante === 1 || ($pageCourante>1 && $pageCourante<$pagesTotales-1)) { ?>
                    <a href="?page=<?php echo $pageCourante + 1; ?>" class="previous_chapters">Chapitres précédents</a>
                <?php };
            ?>
        </div>
    </div>
</aside>



<div id="container">
    <article id="chapter_choiced">
        <h2 id="display_number">Chapitre n°<?php echo $billet->getNumber();?></h2>
        <h3 id="display_title"><?php echo htmlspecialchars_decode($billet->getTitle());?></h3>
        <p id="display_content"><?php echo htmlspecialchars_decode($billet->getContent());?></p>
        <p id="display_date">Publié le <?php echo $billet->getPublicationDate()->format('d/m/Y');?></p>
    </article>

    <div id="comments">

        <div id="read_comments">
            <h4>Commentaires</h4>
            <!-- Publication des commentaires -->
            <?php if(isset($comments)) {
                foreach($comments as $com):?>
                    <div class="comment">
                        <div class="header_comment">
                            <div class="pseudo_comment"><?php echo htmlspecialchars_decode($com->getPseudo());?></div>
                            <a  href="#"
                                data-href="<?php echo HOST;?>user-report-comment.html/id/<?php echo $com->getIdComment();?>/report/on"
                                class="buttonReportComment"
                                title="Signaler">
                                <i class="fas fa-flag"></i>
                            </a>
                        </div>
                        <div class="comment_date"><?php echo $com->getCommentDate()->format('d/m/Y');?></div>
                        <div class="comment_content"><?php echo htmlspecialchars_decode($com->getComment());?></div>
                    </div>
                <?php endforeach; 
            }?>
        </div>



        <div id="add_comment">
            <h4>Ajouter un commentaire</h4>
            <form action="<?php echo HOST;?>create-comment.html" method="post">
                <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" required pattern="^[A-Za-z-]+$" minlength="3" maxlength="20"/>
                <label for="message">Message</label>
                    <input type="text" name="message" id="message" required maxlength="250" rows="5"/>
                <input name="billet" type="hidden" value="<?php echo $billet->getNumber();?>"/><br/>
                <input name="commentDate" type="hidden"/><br/>
                <input name="status" type="hidden" value="non lu"/><br />
                <input name="report" type="hidden" value="off"/><br />
                <input type="submit" value="Envoyer" />
            </form>
        </div>

    </div>
</div>
