<h2>Регистрация нового пользователя</h2>
<div class="container_form">
<h3><?= $message ?? ''; ?></h3>
    <form method="post" class="form">
        <label class="label"><input class="input" type="text" name="login" placeholder="Логин"></label>
        <label class="label"><input class="input" type="text" name="name" placeholder="Имя"></label>
        <label class="label"><input class="input" type="text" name="surname" placeholder="Фамилия"></label>
        <label class="label"><input class="input" type="text" name="patronymic" placeholder="Отчество"></label>
        <label class="label"><input class="input" type="password" name="password" placeholder="Пароль"></label>
        <button class="auth_button">Зарегистрироваться</button>
    </form>
</div>
