<?php
try{
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 //$q = $db->prepare('SELECT * FROM user_list WHERE user_email = :user_email');
 $q = $db->prepare('SELECT * FROM view_history WHERE user_email = :user_email');
 $q->bindValue(':user_email', $_SESSION['user_email']);
  $q->execute();
  $history = $q->fetchAll();
?>
<div class="history">
    <h2>Wondering if you already read the article?</h2>
    <h3>Take a look at your viewing history below.</h3>

    <?php
foreach($history as $entry){
?>
    <div class="history_entry">
        <a href="/article/<?= $entry['article_id'] ?>/<?= $entry['article_views'] ?>">
            <?= $entry['article'] ?></a>
        <p>Last viewed: <?= $entry['last_viewed'] ?></p>
    </div>
    <?php
    }
    ?>
</div>

<?php
}catch(PDOException $ex){
  echo $ex;
}