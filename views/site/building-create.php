<h2>Создание здания</h2>

<div class="container_form">
    <form method="POST" class="form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input class="input" type="text" name="name" placeholder="Название">
        <input class="input" type="text" name="address" placeholder="Адрес">
        <button class="auth_button" type="submit">Создать</button>
    </form>
</div>