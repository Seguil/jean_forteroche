<aside>
    <a href="<?php echo HOST;?>admin-home-page.html">Page d'accueil</a>
</aside>

<div id="container">
    <article>
        <div id="writing_billet">
            <form action="<?php echo HOST;?>create-billet.html" method="post">
                <input type="hidden" name="id" value="<?php echo $billet->getId();?>"/>
                <label for="number">Chapitre n°</label>
                    <input type="text" name="number" id="number" value="<?php echo $billet->getNumber();?>"/>
                <label for="title">Titre</label>
                    <input type="text" name="title" id="title" value="<?php echo $billet->getTitle();?>"/>
                <label for="content">Contenu</label>
                    <input type="text" name="content" class="mytextarea" value="<?php echo $billet->getContent();?>"/>
                <!-- Enregistrer en tant que brouillon -->
                <button type="submit" name="status" value="non published"><i class="fas fa-save"></i></button>
                <!-- Publier -->
                <button type="submit" name="status" value="published"><i class="fas fa-file-export"></i></button>
            </form>
        </div>
    </article>
</div>
