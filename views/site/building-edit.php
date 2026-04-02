<h2>Редактирование здания</h2>

<div class="container_form">
    <form method="POST" class="form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input class="input" type="text" name="name" value="<?= $building->name ?>">
        <input class="input" type="text" name="address" value="<?= $building->address ?>">
        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <?php if ($errors): ?>
            <?php foreach ($errors as $error): ?>
                <p><?= $error[0] ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <button class="auth_button" type="submit">Сохранить</button>
</form>
</div>

