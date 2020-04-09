<!-- $main adminhomePage-->

<!-- Liste des chapitres -->
<aside>
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


<!-- Liste des chapitres -->


<div id="container">
    <article>
        <div id="writing_billet">
            <form action="<?php echo HOST;?>create-billet.html" method="post">
                <label for="number">Chapitre n°</label>
                    <input type="text" name="number" id="number" />
                <label for="title">Titre</label>
                    <input type="text" name="title" id="title" />
                <label for="content">Contenu</label>
                    <input type="text" name="content" class="mytextarea" />
                <!-- Enregistrer en tant que brouillon -->
                <button type="submit" value="Enregistré"><i class="fas fa-save"></i></button>
                <!-- Publier -->
                <button type="submit" value="Publié"><i class="fas fa-file-export"></i></button>
            </form>

            <div id="admin_buttons">
                <a href="<?php echo HOST;?>read-billet-saved.html" title="Chapitres non publiés" class="tooltip"><i class="fas fa-plus-square"></i></a>
                <a href="<?php echo HOST;?>delete-billet.html" title="Supprimer" class="tooltip"><i class="fas fa-trash-alt"></i></a>
                <a href="<?php echo HOST;?>update-billet.html" title="Modifier" class="tooltip"><i class="fas fa-pencil-alt"></i></a>
            </div>

            <!-- Affiche les articles enregistrés et non publié -->
            <div id="non_published_billets">
                <h3>Chapitres non publiés</h3>
                <table>
                    <thead>
                        <tr>
                            <td>Chapitre n°</td>
                            <td>Titre</td>
                            <!-- <td>Pseudo</td> -->
                            <td>Date d'enregistrement</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($billet)) {
                            foreach($billet as $bil):?>
                                <tr>
                                    <td><?php echo $bil->getId(); ?></td>
                                    <td><?php echo $bil->getTitle(); ?></td>
                                    <td><?php echo $com->getPublicationDate()->format('d/m/Y'); ?></td>
                                    <td><a href="<?php echo HOST;?>delete-non-published-billet.html" title="Supprimer" class="tooltip"><i class="fas fa-trash-alt"></i></a></td>
                                    <td><a href="<?php echo HOST;?>update-non-published-billet" title="Modifier" class="tooltip"><i class="fas fa-pencil-alt"></i></a></td>
                                    <td><a href="<?php echo HOST;?>read-non-published-billet.html" title="Lire plus" class="tooltip"><i class="fas fa-plus-square"></i></a></td>
                                </tr>
                            <?php endforeach ;
                        };?>
                    </tbody>
                </table>
            </div>
        </div>

        

        <!-- Récupère les commentaires signalés-->
        <div id="report_comments">
            <div class="admin_comments">
                <h4>Commentaires signalés</h3>
                <table>
                    <thead>
                        <tr>
                            <th class="td1">Chapitre n°</td>
                            <th class="td2">Pseudo</td>
                            <th class="td3">Commentaire signalé</td>
                            <th class="td4">Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($reportComment)) {
                            foreach($reportComment as $repCom):?>
                                <tr>
                                    <td class="td1"><?php echo $repCom->getIdBillet(); ?></td>
                                    <td class="td2"><?php echo $repCom->getPseudo(); ?></td>
                                    <td class="td3"><?php echo $repCom->getComment(); ?></td>
                                    <td class="td4"><?php echo $repCom->getCommentDate()->format('d/m/Y'); ?></td>
                                </tr>
                                <tr>
                                    <td class="tdbutton" colspan="4">
                                        <!-- <a href="<?php echo HOST;?>update-report-comment.html" title="Modifier" class="tooltip"><i class="fas fa-pencil-alt"></i></a> -->
                                        <a href="<?php echo HOST;?>answer-report-comment.html" title="Répondre" class="tooltip"><i class="fas fa-edit"></i></a>
                                        <a id="drc" href="<?php echo HOST;?>delete-report-comment.html/id/<?php echo $repCom->getIdComment();?>" name="idComment" title="Supprimer" class="tooltip"><i class="fas fa-trash-alt"></i></i></a>
                                        <!-- <a id="drc" href="#" value="<?php echo $repCom->getIdComment();?>" name="idComment" title="Supprimer" class="tooltip"><i class="fas fa-trash-alt"></i></i></a> -->
                                    </td>
                                </tr>
                            <?php endforeach ;
                        };?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Récupère les commentaires non lus-->
        <div id="last_comments">
            <div class="admin_comments">
                <h4>Derniers commentaires</h3>
                <table>
                    <thead>
                        <tr>
                            <th class="td1">Chapitre n°</td>
                            <th class="td2">Pseudo</td>
                            <th class="td3">Commentaire</td>
                            <th class="td4">Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($nonReadComment)) {
                            foreach($nonReadComment as $nrd):?>
                                <tr>
                                    <td class="td1"><?php echo $nrd->getIdBillet(); ?></td>
                                    <td class="td2"><?php echo $nrd->getPseudo(); ?></td>
                                    <td class="td3"><?php echo $nrd->getComment(); ?></td>
                                    <td class="td4"><?php echo $nrd->getCommentDate()->format('d/m/Y'); ?></td>
                                </tr>
                                <tr>
                                    <td class="tdbutton" colspan="4">
                                        <a href="<?php echo HOST;?>read-comment.html" title="Marquer comme lu" class="tooltip"><i class="fas fa-envelope-open"></i></a>
                                        <a href="<?php echo HOST;?>answer-comment.html" title="Répondre" class="tooltip"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo HOST;?>update-comment.html" title="Modifier" class="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?php echo HOST;?>delete-comment.html" title="Supprimer" class="tooltip"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ;
                        };?>
                    </tbody>
                </table>
            </div>
        </div>


    </article>

</div>