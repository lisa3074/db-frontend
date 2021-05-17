<?php
require_once(__DIR__.'/../db.php');
require_once(__DIR__.'/view_top.php');

if( ! isset($_SESSION) ){ session_start(); }

if( ! isset( $_SESSION['user_email'] ) ){
  header('Location: /');
  exit();  
} 


try{
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 $q = $db->prepare('SELECT * FROM view_profile WHERE email = :user_email');
 $q->bindValue(':user_email', $_SESSION['user_email']);
  $q->execute();
  $user = $q->fetch();
  if( ! $user ){
    header('Location: /login');
    exit();
  }
  if( !$user['user_active']){
    header('Location: /login');
    exit();
  } 


  ?>
<main class="content_wrapper profile">
    <h1 class='logged_in_user'>Hi <?=$user['name']?> </h1>
    <p class="subheader">This is your profile, where you can see all the info we have about you in the system:</p>
    <div class="user_profile"
        data-id="<?= $user['email'] ?>">
        <p>Name: <?= $user['name'] ?> <?= $user['lastname'] ?></p>
        <p>Email: <?= $user['email'] ?></p>
        <p>Passsword: <?= $user['password'] ?></p>
        <p>Age: <?= $user['age'] ?></p>
        <p>Role: <?= $user['role'] ?></p>
    </div>
    <?php
    
    require_once(__DIR__.'/view_history.php');
    ?>
</main>


<?php
}catch(PDOException $ex){
  echo $ex;
}

require_once(__DIR__.'/view_bottom.php');