<?php

 require_once(__DIR__.'/../db.php');
$q = $db->prepare("UPDATE article SET article_views=$views + 1 WHERE article_id = $id");
$q->execute();