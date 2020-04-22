<div id="responsive_menu_icon">
    <a href="#"><i class="fas fa-bars"></i></a>
</div>

<aside id="nav_aside">
    <!-- <div class="pagination">
        <?php
            if($pageCourante == $pagesTotales || ($pageCourante>1 && $pageCourante<$pagesTotales)) { ?>
                <a href="?page=<?php echo $pageCourante - 1; ?>">Chapitres suivants</a>
            <?php };?>
    </div> -->

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


    <!-- <div class="pagination">
        <?php
            if($pageCourante === 1 || ($pageCourante>1 && $pageCourante<$pagesTotales-1)) { ?>
                <a href="?page=<?php echo $pageCourante + 1; ?>">Chapitres précédents</a>
            <?php };?>
    </div> -->

</aside>


<!-- Liste des chapitres -->


<div id="container">
    <article>
        <div id="writing_billet">
            <div class="admin_billets">
                <form action="<?php echo HOST;?>create-billet.html" method="post">
                    <label for="number">Chapitre n°</label>
                        <input type="text" name="number" id="number" />
                    <label for="title">Titre</label>
                        <input type="text" name="title" id="title" />
                    <label for="content">Contenu</label>
                        <input type="text" name="content" class="mytextarea" />                
                    <!-- Enregistrer en tant que brouillon -->
                    <div class="tdbutton submitform">
                        <button type="submit" name="status" value="non published" title="Enregistrer"><i class="fas fa-save"></i></button>
                        <!-- Publier -->
                        <button type="submit" name="status" value="published" title="Publier"><i class="fas fa-share-alt"></i></button>
                    </div>
                </form>
            </div>
        </div>

            <!-- Affiche les articles enregistrés et non publié -->
        <div id="non_published_billets">
            <div class="admin_billets">
                <h4>Chapitres non publiés</h4>
                
                <div class="list_billets">
                    <?php if(isset($nonPublishedBillets)) {
                        foreach($nonPublishedBillets as $npb):
                    ?>
                    <div class="one_billet non_published">
                        <h2>Chapitre n° <?php echo $npb->getNumber();?></h2>
                        <h3><?php echo $npb->getTitle();?></h2>
                        <div class="tdbutton">
                            <a  href="<?php echo HOST;?>read-non-published-billet.html/id/<?php echo $npb->getId();?>"
                                class="buttonReadBillet"
                                title="Lire">
                                <i class="fas fa-book-open"></i>
                            </a>

                            <a  href="<?php echo HOST;?>change-billet.html/id/<?php echo $npb->getId();?>"
                                class="buttonChangeBillet"
                                title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a  href="#"
                                data-href="<?php echo HOST;?>update-billet.html/id/<?php echo $npb->getId();?>/status/published"
                                class="buttonPublishedBillet"
                                title="Publier">
                                <i class="fas fa-share-alt"></i>
                            </a>

                            <a href="#"
                                data-href="<?php echo HOST;?>delete-billet.html/id/<?php echo $npb->getId();?>"
                                class="buttonDeleteBillet"
                                title="Supprimer">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach;};?>
                </div>
            </div>
        </div>
        

        

        <!-- Récupère les commentaires signalés-->
        <div class="report_comments">
            <div class="admin_comments">
                <h4>Commentaires signalés</h4>
                
                <div class="list_comments">
                    <?php if(isset($reportComment)) {
                        foreach($reportComment as $repCom):
                    ?>
                    <div class="one_comment report">
                        <h5>Chapitre n° <?php echo $repCom->getIdBillet();?></h5>
                        <div class="pseudo_date">
                            <p class="pseudo_comment"><?php echo $repCom->getPseudo();?></p>
                            <p class="comment_date"><?php echo $repCom->getCommentDate()->format('d/m/Y');?></p>
                        </div>
                        <p class="content_comment"><?php echo $repCom->getComment();?></p>
                        <div class="tdbutton">
                            <a  href="#"
                                data-href="<?php echo HOST;?>answer-comment.html/id/<?php echo $repCom->getIdComment();?>/status/lu/report/off"
                                class="buttonAnswerComment"
                                title="Répondre">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a  href="#"
                                data-href="<?php echo HOST;?>update-report-comment.html/id/<?php echo $repCom->getIdComment();?>/status/lu/report/off"
                                class="buttonIgnoredReport"
                                title="Annuler le signalement">
                                <i class="fas fa-ban"></i>
                            </a>

                            <a href="#"
                                data-href="<?php echo HOST;?>delete-comment.html/id/<?php echo $repCom->getIdComment();?>"
                                class="buttonDeleteComment"
                                title="Supprimer">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach;};?>
                </div>
            </div>
        </div>


        <!-- Récupère les commentaires non lus-->
        <div id="last_comments">
            <div class="admin_comments">
                <h4>Derniers commentaires</h4>
                
                <div class="list_comments">
                    <?php if(isset($nonReadComment)) {
                        foreach($nonReadComment as $nrd):
                    ?>
                    <div class="one_comment last">
                        
                        <h5>Chapitre n° <?php echo $nrd->getIdBillet();?></h5>
                        
                        <div class="pseudo_date">
                            <p class="pseudo_comment"><?php echo $nrd->getPseudo();?></p>
                            <p class="comment_date"><?php echo $nrd->getCommentDate()->format('d/m/Y');?></p>
                        </div>
                        
                        <p class="content_comment"><?php echo $nrd->getComment();?></p>
                        
                        <div class="tdbutton">
                            <a  href="#"
                                data-href="<?php echo HOST;?>update-status-comment.html/id/<?php echo $nrd->getIdComment();?>/status/lu"
                                class="buttonStatusComment"
                                title="Marquer comme lu">
                                <i class="fas fa-envelope-open"></i>
                            </a>

                            <a  href="#"
                                class="buttonAnswerComment"
                                title="Répondre">
                                <i class="fas fa-edit"></i>
                                <form class="response_comment" action="<?php echo HOST;?>answer-comment.html" method="post">                                        
                                    <input type="hidden" name="pseudo" id="pseudo" value="Jean Forteroche" required/>
                                    <input type="text" name="answer" placeholder="Réponse" required maxlength="250" rows="5"/>
                                    <input name="status" type="hidden" value="lu"/><br />
                                    <input name="idComment" type="hidden" value="<?php echo $nrd->getIdComment();?>"/><br />
                                    <input name="report" type="hidden" value="off"/><br />
                                    <input type="submit" value="Répondre"/>
                                </form>
                            </a>

                            <a  href="#"
                                data-href="<?php echo HOST;?>delete-comment.html/id/<?php echo $nrd->getIdComment();?>"
                                class="buttonDeleteComment"
                                title="Supprimer">
                                <i class="fas fa-trash-alt"></i>
                            </a>

                        </div>
                    </div>
                    <?php endforeach;};?>
                </div>
            </div>
        </div>

    </article>

</div>