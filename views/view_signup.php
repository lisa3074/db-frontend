<?php

require_once(__DIR__.'/view_top.php');

?>
<form action="/signup"
    method="POST"
    onsubmit="return validate()">
    <h4>Or sign up for an account.</h4>

    <p class="subnote">NOTE: you can only sign up using a kea email.</p>
    <div class="form_wrapper">
        <div class="signup_email_wrapper">
            <input type="text"
                name="email"
                placeholder="test1234">
            <p>@stud.kea.dk</p>
        </div>
        <input type="text"
            placeholder="first name"
            name="name">
        <input type="text"
            placeholder="last name"
            name="last_name">
        <input type="number"
            name="age"
            placeholder="age">

        <input name="password"
            placeholder="password"
            type="text">

        <button>Sign up</button>
    </div>
</form>

<?php
require_once(__DIR__.'/view_bottom.php');