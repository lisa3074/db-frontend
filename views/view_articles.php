<?php
require_once(__DIR__.'/../db.php');
require_once(__DIR__.'/view_top.php');
if( ! isset($_SESSION['user_email'])){
    header('Location: /');
}
if($id){
    $q = $db->prepare("SELECT * FROM view_articles WHERE $id = topic_id");
    
}else{
    
    $q = $db->prepare("SELECT * FROM view_articles");
}
$q->execute();
$articles = $q->fetchAll(); 


?>
<main class="content_wrapper article_list">

    <?php
    require_once(__DIR__.'/view_topics.php');

    ?>


    <section class="grid_wrapper">

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