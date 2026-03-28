<h2>Создание здания</h2>

<div class="container_form">
    <form method="POST" class="form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input class="input" type="text" name="name" placeholder="Название">
        <input class="input" type="text" name="address" placeholder="Адрес">
        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <?php if ($errors): ?>
            <?php foreach ($errors as $error): ?>
                <p><?= $error[0] ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <button class="auth_button" type="submit">Создать</button>
    </form>
</div>