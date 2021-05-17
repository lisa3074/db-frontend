<?php
require_once(__DIR__ . '/router.php');

##########################################
#################  GET  ##################
##########################################

get('/', function(){
  require_once(__DIR__ . '/views/view_login.php');
  exit();
});
get('/home', function(){
  require_once(__DIR__ . '/views/view_index.php');
  exit();
});
get('/users', function(){
  $role = false;
  require_once(__DIR__ . '/views/view_users.php');
  exit();
});
get('/signup', function(){
  require_once(__DIR__ . '/views/view_signup.php');
  exit();
});
get('/login', function(){
  require_once(__DIR__ . '/views/view_login.php');
  exit();
});
/* get('/profile/:email', function($email){
  $email = $email;
  require_once(__DIR__ . '/views/view_profile.php');
  exit();
}); */
get('/profile', function(){
  require_once(__DIR__ . '/views/view_profile.php');
  exit();
});
get('/articles', function(){
  $id = false;
  require_once(__DIR__ . '/views/view_articles.php');
  exit();
});
/* get('/display_article', function(){
  require_once(__DIR__ . '/views/view_display_article.php');
  exit();
}); */
get('/logout', function(){
  require_once(__DIR__ . '/bridges/bridge_logout.php');
  exit();
});

get('/users/:role', function($role){
  session_start();
  $page_title = 'USERS';
  require_once(__DIR__ . '/views/view_users.php');
  exit();
});
get('/article/:id/:views', function($id, $views){
  session_start();
  $page_title = 'ARTICLE';
  require_once(__DIR__ . '/views/view_single_article.php');
  require_once(__DIR__ . '/apis/api_count_views.php');
  require_once(__DIR__ . '/apis/api_user_history.php');
  exit();
});
get('/topic/:id', function($id){
  //session_start();
  require_once(__DIR__ . '/views/view_articles.php');
  require_once(__DIR__ . '/views/view_topics.php');
  exit();
});

###########################################
#################  POST  ##################
###########################################

post('/login', function(){
  require_once(__DIR__ . '/bridges/bridge_login.php');
  exit();
});

post('/signup', function(){
  require_once(__DIR__ . '/bridges/bridge_signup.php');
  exit();
});

any('/404', function(){
  echo 'Not found';
  exit();
});