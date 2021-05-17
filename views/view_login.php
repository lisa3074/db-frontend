<?php

require_once(__DIR__.'/view_top.php');
?>
<main class="content_wrapper forms">
    <form action="/frontend-kopi/login"
        method="POST">

        <h4>Login to view the e-learning resources</h4>
        <div class="form_wrapper">
            <input name="login_user_email"
                type="text"
                placeholder="email"
                data-validate="email">
            <input name="login_user_password"
                type="password"
                placeholder="password"
                maxlength="50"
                data-validate="str"
                data-min="2"
                data-max="50">
            <button>
                login
            </button>
        </div>
    </form>


    <?php
    require_once(__DIR__.'/view_signup.php')

?>
</main>

<?php

require_once(__DIR__.'/view_bottom.php');