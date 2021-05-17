 <?php
require_once(__DIR__.'/../db.php');

$q = $db->prepare('SELECT * FROM topic_list');
$q->execute();
$topics = $q->fetchAll(); 

 ?>
 <select onchange="location = this.value;">
     <option>
         Choose topic
     </option>
     <option value="/articles">
         View all
     </option>

     <?php
 foreach($topics as $topic){
     ?>

     <option value="/topic/<?=$topic['topic_id']?>">
         <?=$topic['topic_title']?>
     </option>

     <?php
 };
 ?>
 </select>