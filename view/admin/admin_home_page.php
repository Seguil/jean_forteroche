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


<!-- Liste des chapitres -->


<div id="container">
    <article>
        <div id="writing_billet">
            <form action="<?php echo HOST;?>create_billet.html" method="post">
                <label for="number">Chapitre n°</label>
                    <input type="text" name="number" id="number" />
                <label for="title">Titre</label>
                    <input type="text" name="title" id="title" />
                <label for="content">Contenu</label>
                    <input type="text" name="content" class="mytextarea" />
                <input type="submit" value="Publier" />
            </form>
        </div>

        <div id="report_comments">
            <!-- Récupère les commentaires signalés-->
            <?php if(isset($comment)) {
                foreach($comment as $com):?>
                    <div class="comment">
                        <?php echo $com->getComment(); ?><br/>
                        <?php echo $com->getCommentDate()->format('d/m/Y'); ?><br/>
                    </div>
                <?php endforeach; 
            }?>
        </div>

        <div id="admin_buttons">
            <button>Modifier</button>
            <button>Supprimer</button>
            <button>Publier</button>
        </div>
    </article>

</div>