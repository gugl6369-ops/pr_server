<h1>Список помещений</h1>
<table>
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
            <td> <?= $buildings->where('id', $room->building_id)->first()->name ?? '' ?></td>
            <td> <?= $views->where('id', $room->view_id)->first()->name ?? '' ?> </td>
            <td>
                <a href="<?= app()->route->getUrl('/delete-room?id=' . $room->id) ?>">
                    Удалить
                </a>
            </td>
            <td>
                <a href="<?= app()->route->getUrl('/edit-room?id=' . $room->id) ?>">
                    Редактировать
                </a>
            </td>
            <td>
                <a  href="<?= app()->route->getUrl('/attach-room?id=' . $room->id) ?>">
                    Занять
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="<?= app()->route->getUrl('/create-room') ?>" >Создать комнату +</a>
