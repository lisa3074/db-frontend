<?php
require_once(__DIR__.'/../db.php');
echo $user_email;

try{
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('UPDATE user_list SET user_active=FALSE WHERE user_email == :user_email');
  $q->bindValue(':user_email', $user_email);
  $q->execute();



  session_start();
  session_destroy();
  header('Location: /login');
  exit();
  
}catch(PDOException $ex){
    echo $ex;
}