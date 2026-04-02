<div class="container_form">
    <form method="POST" class="form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="hidden" name="id" value="<?= $user->id ?>">

        <input class="input" type="text" name="name" value="<?= $user->name ?>" placeholder="Имя">
        <input class="input" type="text" name="surname" value="<?= $user->surname ?>" placeholder="Фамилия">
        <input class="input" type="text" name="patronymic" value="<?= $user->patronymic ?>" placeholder="Отчество">
        <input class="input" type="text" name="login" value="<?= $user->login ?>" placeholder="Логин">

        <select name="role_id">
            <option value="1" <?= $user->role_id == 1 ? 'selected' : '' ?>>Admin</option>
            <option value="2" <?= $user->role_id == 2 ? 'selected' : '' ?>>Нищета</option>
        </select>
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