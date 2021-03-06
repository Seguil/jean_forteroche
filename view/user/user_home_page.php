<!-- $main homePage-->
<aside id="bibliography">
    <h2>Jean Forteroche</h2>
    <p>Né en 1962 dans les Hautes Alpes, ce passioné de grands espaces a décidé de partir à la conquête de l'Alaska. <br/>
    Entre découverte de communautés aborigènes, prise de conscience de l'éphémère nature et rétrospective de sa propre vie,
    Jean Forteroche a décidé de publier le récit de ses expériences.<br/>
    C'est sous la forme de ce roman initiatique en ligne qu'il a souhaité toucher ses lecteurs.<br/>
    Bon voyage dans l'inconnu de l'Alaska...</p>
</aside>

<!-- Liste des chapitres -->

<div id="container">
    <div id="container_pagination">
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



    <nav>
        <ul>
            <?php foreach($billets as $bil):?>
                <li class="billet">
                    <a href="<?php echo HOST;?>user-billet-page.html/number/<?php echo $bil->getNumber(); ?>">
                        <h2>Chapitre n°<?php echo $bil->getNumber();?></h2>
                        <h3><?php echo htmlspecialchars_decode($bil->getTitle());?></h3>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</div>