<?php
set_time_limit ( 3 );
require_once(__DIR__.'/../db.php');
require_once(__DIR__.'/view_top.php');

if( ! isset($_SESSION['user_email'])){
    header('Location: /');
}
$q = $db->prepare("SELECT * FROM view_article WHERE article_id = $id");
$q->execute();
$articles = $q->fetchAll(); 


?>
<main class="content_wrapper">
    <?php


 foreach($articles as $article){
    ?>
    <div class="article"
        data-id=<?= $article['article_id'] ?>>
        <div class="button_wrapper"
            onclick="history.back()"> <button>◁</button>
            <p>go back</p>
        </div>
        <?= $article['resource'] ?>
        <div class="info_container">
            <div class="wrapper">
                <p class="article_info"><span class="bold">Author:</span> <?= $article['author'] ?></p>
            </div>
            <div class="wrapper">
                <p class="article_info"><span class="bold">Contact:</span> <?= $article['author_email'] ?></p>
            </div>
            <div class="wrapper">
                <p class="article_info"><span class="bold">Views:</span>
                    <?= $article['views']; ?></p>
            </div>
            <div class="wrapper">
                <p class="article_info"><span class="bold">Topic:</span> <?= $article['topic'] ?></p>
            </div>
        </div>
        <p class="article_info"><?= $article['content'] ?></p>
        <div class="button_wrapper"
            onclick="history.back()"> <button>◁</button>
            <p>go back</p>
        </div>
    </div>

    <?php
};  




?>
    <form class="sent_comment">
        <p class="email hide"><?=$_SESSION['user_email']?></span></p>
        <p> Logged in and commenting as: <span class="user_name"><?=$_SESSION['user_name']?></span></p>
        <p class="article_id hide"><?=$article['article_id']?></p>
        <textarea name="text"
            placeholder="Write your comment here"
            class="message"></textarea>
        <button onclick="sendMessage()">Send</button>
    </form>

    <article class="comments"></article>
</main>
<script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-firestore.js"></script>

<script src="/firestore.js"></script>
<script src="/js/comments.js"></script>
<?php
require_once(__DIR__.'/view_bottom.php');