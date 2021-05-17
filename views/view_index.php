<?php

require_once(__DIR__.'/view_top.php');
require_once(__DIR__.'/../db.php');
require_once(__DIR__.'/view_top.php');
if( ! isset($_SESSION['user_email'])){
    header('Location: /');
}

    $q = $db->prepare("SELECT * FROM most_read");

$q->execute();
$articles = $q->fetchAll(); 


?>
<main class="content_wrapper article_list">

    <h1>We are happy to see you again <?=$_SESSION['user_name']?>!</h1>
    <p class="welcome_text">We hope you are eager to learn, so here we give you our most popular articles right now!</p>



    <section class="grid_wrapper most_read">

        <?php
 foreach($articles as $article){
     ?>
        <a href="/article/<?= $article['article_id'] ?>/<?= $article['views'] ?>">
            <div class="article">
                <img src=<?= $article['illustration']?>>
                <div class="views"><?=$article['views']?> views</div>
                <?= $article['resource'] ?>
            </div>
        </a>
        <?php
};  
?>
    </section>
</main>
<?php


require_once(__DIR__.'/view_bottom.php');