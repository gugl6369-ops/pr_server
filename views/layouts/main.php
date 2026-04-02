<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Pop it MVC</title>
</head>

<?php $bg = \Src\Session::get('background'); ?>

<body style="<?= $bg ? "background: url('$bg') no-repeat center/cover;" : '' ?>">
<header>
    <nav class="navigation">
        <div>
            <a href="<?= app()->route->getUrl('/hello') ?>"><h1>Файлы Эпштн</h1></a>
        </div>
        <form method="post" action="/upload-bg" enctype="multipart/form-data">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="file" name="background">
            <button>Загрузить фон</button>
        </form>
        <div class="nav_auth">
            <?php
            if (!app()->auth::check()):
                ?>
                <a href="<?= app()->route->getUrl('/login') ?>" class="nav_title">Вход</a>
            <?php
            else:
                ?>
                <a href="<?= app()->route->getUrl('/logout') ?>" class="nav_title">Выход</a>

                <?php
                    if (app()->auth::user()->isAdmin()):
                    ?>
                    <a href="<?= app()->route->getUrl('/signup') ?>" class="nav_title">Регистрация пользователя</a>
                        <?php
                        else:
                        ?>
                            <a href="<?= app()->route->getUrl('/rooms') ?>" class="nav_title">Все комнаты</a>
                            <a href="<?= app()->route->getUrl('/buildings') ?>" class="nav_title">Все здания</a>
                <?php endif; ?>
                <a href="/" class="nav_title avatar"><?= app()->auth::user()->name ?></a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>
