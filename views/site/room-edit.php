<h2>Редактирование комнаты</h2>

<div class="container_form">
    <form method="POST" class="form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input class="input" type="hidden" name="id" value="<?= $room->id ?>">
        <label> Номер <input class="input" type="text" name="number" value="<?= $room->number ?>" placeholder="Номер"></label>
        <label>Площадь <input class="input" type="text" name="square" value="<?= $room->square ?>" placeholder="Площадь"></label>
        <label>Места <input class="input" type="text" name="seating" value="<?= $room->seating ?>" placeholder="Места"></label>
        <select name="building_id">
            <?php foreach ($buildings as $b): ?>
                <option value="<?= $b->id ?>"
                    <?= $room->building_id == $b->id ? 'selected' : '' ?>>
                    <?= $b->name ?> (<?= $b->address ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <select name="view_id">
            <?php foreach ($views as $v): ?>
                <option value="<?= $v->id ?>"
                    <?= $room->view_id == $v->id ? 'selected' : '' ?>>
                    <?= $v->name ?>
                </option>
            <?php endforeach; ?>
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
