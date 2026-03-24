<h2>Авторизация</h2>
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <form method="post">
        <label class="label">Логин <input class="input" type="text" name="login"></label>
        <label class="label">Пароль <input class="input" type="password" name="password"></label>
        <button class="auth_button">Войти</button>
    </form>
<?php endif;

