<aside>
    <a href="<?php echo HOST;?>admin-home-page.html" title="Page d'accueil" class="home_link"><i class="fas fa-home"></i></a>
</aside>

<div id="container">
    <article>
        <h4>Modifier un chapitre</h4>

        <div id="writing_billet">
            <form action="<?php echo HOST;?>update-change-billet.html" method="post">
                <input type="hidden" name="id" value="<?php echo $billet->getId();?>"/>
                <label for="number">Chapitre n°</label>
                    <input type="text" name="number" id="number" value="<?php echo $billet->getNumber();?>"/>
                <label for="title">Titre</label>
                    <input type="text" name="title" id="title" value="<?php echo $billet->getTitle();?>"/>
                <label for="content">Contenu</label>
                    <input type="text" name="content" id="content" class="mytextarea" value="<?php echo $billet->getContent();?>"/>
                <!-- Enregistrer en tant que brouillon -->
                <div class="tdbutton submitform">
                    <button type="submit" name="status" value="non published"><i class="fas fa-save"></i></button>
                    <!-- Publier -->
                    <button type="submit" name="status" value="published"><i class="fas fa-share-alt"></i></button>
                </div>
            </form>
        </div>
    </article>
</div>
