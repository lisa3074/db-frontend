<?php

  require_once(__DIR__.'/../db.php');

$date = date("Y-m-d H:i:s"); 

$q = $db->prepare("DELETE FROM history 
WHERE history.user_log_id = :user_log_id 
AND history.article_id = $id;");

$q2 = $db->prepare("INSERT INTO history (last_viewed, article_id, user_log_id, article_views)
VALUES ('$date', $id, :user_log_id, $views);");
 $q->bindValue(':user_log_id', $_SESSION['user_log_id']);
 $q2->bindValue(':user_log_id', $_SESSION['user_log_id']);


$q->execute();
$q2->execute(); 