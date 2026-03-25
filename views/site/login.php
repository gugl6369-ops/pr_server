<h2>Авторизация</h2>
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <div class="container_form">
        <form method="post" class="form">
            <label class="label"><input class="input" type="text" name="id" placeholder="login"></label>
            <label class="label"><input class="input" type="password" name="password" placeholder="password"></label>
            <button class="auth_button">Войти</button>
        </form>
    </div>
<?php endif;

