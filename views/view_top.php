<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
        content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title><?= $page_title ?? 'OUR PAGE' ?></title>
</head>

<body>
    <nav class="main_nav">
        <ul>

            <?php if( ! isset($_SESSION) ){ session_start(); } if( ! isset( $_SESSION['user_email'] ) ){
  echo '    <li>
                <a href="/login">
                    LOGIN / SIGN UP
                </a>
            </li>
      

        ';

        }
   if( ! isset($_SESSION) ){ session_start(); } if( isset( $_SESSION['user_email'] ) ){ 
  echo '
     <li>
                <a href="/home">
                    HOME
                </a>
            </li>
              <li>
                <a href="/articles">
                    ARTICLES
                </a>
            </li>
            <li>
                <a href="/users">
                    USERS
                </a>
            </li>   
               <li>
                <a href="/profile">
                    PROFILE
                </a>
            </li>     
            <li>
                <a href="/logout">
                    LOGOUT
                </a>
            </li>';
 } 
 ?>
        </ul>
    </nav>