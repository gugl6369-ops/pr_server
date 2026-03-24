<h2>Регистрация нового пользователя</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post" class="form">
    <label class="label">Имя <input class="input" type="text" name="name"></label>
    <label class="label">Логин <input class="input" type="text" name="login"></label>
    <label class="label">Пароль <input class="input" type="password" name="password"></label>
    <button class="auth_button">Зарегистрироваться</button>
</form>
