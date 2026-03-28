<h2>Редактирование здания</h2>

<div class="container_form">
    <form method="POST" class="form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input class="input" type="text" name="name" value="<?= $building->name ?>">
        <input class="input" type="text" name="address" value="<?= $building->address ?>">
        <button class="auth_button" type="submit">Сохранить</button>
</form>
</div>

