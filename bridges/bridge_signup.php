<?php

require_once(__DIR__.'/../db.php');
session_start();

try{

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare(' INSERT INTO user_list
                      VALUES(:user_email, :user_password, :user_name,
                       :user_age, :role_id, :user_log_id, :user_active, :user_last_name)');
$q->bindValue(':user_email', $_POST['email'].'@stud.kea.dk');
  $q->bindValue(':user_name', $_POST['name']);
  $q->bindValue(':user_last_name', $_POST['last_name']);
  $q->bindValue(':user_age', $_POST['age']);
  $q->bindValue(':user_password', $_POST['password']);
  $q->bindValue(':role_id', 1);
  $q->bindValue(':user_log_id', rand());
  $q->bindValue(':user_active', 1);
  $q->execute();
if(!$q->rowCount()){
header('Location: /signup');
exit();
}
if(!isset($_SESSION)){
  session_start();
}

  header('Location: /login');
?>


<?php
}catch(PDOException $ex){
  echo $ex;
}