<h1>Список зданий</h1>
<table>
    <tr>
        <th>Название</th>
        <th>Адрес</th>
        <th>Комнаты</th>
        <th>Подсчитать площадь</th>
        <th>Подсчитать посадочные места</th>
    </tr>
    <?php foreach ($buildings as $building): ?>
        <tr>
            <td><?= $building->name ?></td>
            <td><?= $building->address ?></td>
            <td>
                <?php foreach ($rooms as $room): ?>
                    <?php if ($room->building_id === $building->id): ?>
                        <?= $room->number ?>,
                    <?php endif ?>
                <?php endforeach; ?>
            </td>
            <td>
                <?php if (isset($building->total_square)): ?>
                    <p><?= $building->total_square ?></p>
                <?php else: ?>
                    <a href="<?= app()->route->getUrl('/buildings?id=' . $building->id) ?>">
                        Посчитать
                    </a>
                <?php endif ?>
            </td>
            <td>
                <?php if (isset($building->total_seating)): ?>
                    <p><?= $building->total_seating ?></p>
                <?php else: ?>
                    <a href="<?= app()->route->getUrl('/buildings?id=' . $building->id) ?>">
                        Посчитать
                    </a>
                <?php endif ?>
            </td>
            <td>
                <?php if ($building->can_delete): ?>
                    <a href="<?= app()->route->getUrl('/delete-building?id=' . $building->id) ?>">
                        Удалить
                    </a>
                <?php else: ?>
                    <button disabled style="opacity:0.5;">
                        Нельзя удалить (есть комнаты)
                    </button>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?= app()->route->getUrl('/building-edit?id=' . $building->id) ?>">
                    Редактировать
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="<?= app()->route->getUrl('/building-create') ?>" >Создать здание +</a>
