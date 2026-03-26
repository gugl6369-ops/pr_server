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