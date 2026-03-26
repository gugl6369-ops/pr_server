<h1>Список помещений</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Номер</th>
        <th>Площадь</th>
        <th>Мест</th>
        <th>Здание</th>
        <th>Тип вида</th>
    </tr>

    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= $room->id ?></td>
            <td><?= $room->number ?></td>
            <td><?= $room->square ?></td>
            <td><?= $room->seating ?></td>
            <td><?= $room->building_id ?></td>
            <td><?= $room->view_id ?></td>
            <td>
                <a href="<?= app()->route->getUrl('/delete-room?id=' . $room->id) ?>">
                    Удалить
                </a>
            </td>
            <td>
                <a href="<?= app()->route->getUrl('/edit-user?id=' . $user->id) ?>">
                    Редактировать
                </a>
            </td>
            <td>
                <a href="<?= app()->route->getUrl('/edit-user?id=' . $user->id) ?>">
                    Занять
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table><?php
