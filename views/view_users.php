<?php
require_once(__DIR__ . '/../db.php');
require_once(__DIR__ . '/view_top.php');
if( ! isset($_SESSION['user_email'])){
    header('Location: /');
}
$role;
if (!$role) {
    $q = $db->prepare('SELECT * FROM view_users');
} else {
    $q = $db->prepare("SELECT * FROM view_users WHERE role_id = $role");
}
$q->execute();
$users = $q->fetchAll();
?>
<main class="content_wrapper">
    <nav class="sort">
        <a href="/users">
            <button>All</button>
        </a>
        <a href="/users/1">
            <button>Student</button>
        </a>
        <a href="/users/2">
            <button>Teacher</button>
        </a>
        <a href="/users/3">

            <button>Administrator</button>
        </a>
        <a href="/users/4">
            <button>Author</button>
        </a>
    </nav>
    <?php
foreach ($users as $user) {
?>


    <div class="user"
        data-id="<?= $user['email'] ?>">
        <p>Name: <?= $user['name'] ?> <?= $user['lastname'] ?></p>
        <p>Email: <?= $user['email'] ?></p>
        <p>Role: <?= $user['role'] ?></p>
        <p>Active user: <?php 
        if($user['user_active']){
           echo 'Yes';
            }else{
               echo 'No';
                };
                
                ?></p>
    </div>

    <?php
};

?>
</main>
<?php
require_once(__DIR__ . '/view_bottom.php');