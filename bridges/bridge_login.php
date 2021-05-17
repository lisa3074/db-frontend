<?php
require_once(__DIR__.'/../db.php');
session_start();


if( ! isset($_POST['login_user_email']) ){
  header('Location: /login');
  exit();  
}

if( ! isset($_POST['login_user_password']) ){
  header('Location: /login');
  exit();  
}

if( ! filter_var($_POST['login_user_email'], FILTER_VALIDATE_EMAIL) ){
  header('Location: /login');
  exit();  
}
if( strlen($_POST['login_user_password']) < 2 || 
    strlen($_POST['login_user_password']) > 50 ){
  header('Location: /login');
  exit();  
}

 try {
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 $q = $db->prepare('SELECT * FROM user_list WHERE user_email = :user_email AND user_password = :user_password LIMIT 1');
  $q->bindValue(':user_email', $_POST['login_user_email']);
  $q->bindValue(':user_password', $_POST['login_user_password']);
  $q->execute();

  $user = $q->fetch();
  if(!$user){
    header('Location: /login');
    exit();
  } 

  $_SESSION['user_email'] = $user['user_email'];
  $_SESSION['user_name'] = $user['user_name'];
  $_SESSION['user_log_id'] = $user['user_log_id'];
  
   header("Location: /home");
    exit();

} catch (PDOException $ex) {
  echo $ex;
} 