<div id="responsive_menu_icon">
    <a href="#"><i class="fas fa-bars"></i></a>
</div>

<aside id="nav_aside">
    <nav>
        <ul>
            <?php foreach($billets as $bil):?>
                <li class="billet">
                    <a href="<?php echo HOST;?>admin-billet-page.html/number/<?php echo $bil->getNumber(); ?>">
                        <h2>Chapitre n°<?php echo $bil->getNumber();?></h2>
                        <h3><?php echo htmlspecialchars_decode($bil->getTitle());?></h3>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div id="aside_pagination">
        <div class="pagination">
            <?php
                if($pageCourante>1) { ?>
                    <a href="?page=<?php echo $pageCourante - 1; ?>" class="following_chapters">Chapitres suivants</a>
                <?php };
            ?>
        </div>

        <div class="pagination">
            <?php
                if($pageCourante<$pagesTotales) { ?>
                    <a href="?page=<?php echo $pageCourante + 1; ?>" class="previous_chapters">Chapitres précédents</a>
                <?php };
            ?>
        </div>
    </div>
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
                        <input type="text" name="content" class="mytextarea" id="content" />                
                    <div class="tdbutton submitform billet_only">
                        <!-- Enregistrer en tant que brouillon -->
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
                        <h3><?php echo htmlspecialchars_decode($npb->getTitle());?></h2>
                        <div class="tdbutton">
                            <a  href="<?php echo HOST;?>read-non-published-billet.html/number/<?php echo $npb->getNumber();?>"
                                class="buttonReadBillet"
                                title="Lire">
                                <i class="fas fa-book-open"></i>
                            </a>

                            <a  href="<?php echo HOST;?>change-billet.html/number/<?php echo $npb->getNumber();?>"
                                class="buttonChangeBillet"
                                title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a  href="#"
                                data-href="<?php echo HOST;?>update-billet.html/number/<?php echo $npb->getNumber();?>/status/published"
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