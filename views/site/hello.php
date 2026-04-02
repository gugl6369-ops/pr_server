<h2 class="title_message"><?= $message ?? ''; ?></h2>
<?php if (app()->auth->user()->isAdmin()): ?>
    <table>
        <thead>
        <tr>
            <th>Имя</th>
            <th>Роль</th>
            <th>Фамилия</th>
            <th>Пароль</th>
        </tr>
        </thead>
        <tbody>
     <?php forEach ($users as $user): ?>
        <tr>
            <td><?= $user->name?></td>
            <td><?= $user->getRole()?></td>
            <td><?= $user->surname?></td>
            <td><?= $user->password?></td>
            <td>
                <a href="<?= app()->route->getUrl('/delete-user?id=' . $user->id) ?>">
                    Удалить
                </a>
            </td>
            <td>
                <a href="<?= app()->route->getUrl('/edit-user?id=' . $user->id) ?>">
                    Редактировать
                </a>
            </td>
        </tr>
     <?php endforeach; ?>
        </tbody>
    </table>
 <?php endif; ?>
<?php if (!app()->auth->user()->isAdmin()): ?>
<h2>Мои комнаты</h2>

<table border="1">
    <tr>
        <th>Номер</th>
        <th>Площадь</th>
        <th>Места</th>
        <th>Действие</th>
    </tr>

    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= $room->number ?></td>
            <td><?= $room->square ?></td>
            <td><?= $room->seating ?></td>

            <td>
                <a href="<?= app()->route->getUrl('/detach-room?id=' . $room->id) ?>">
                    ❌ Удалить
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
