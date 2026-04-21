<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop it MVC</title>
    <link rel="stylesheet" href="/pop-it-mvc/public/css/style.css">
</head>
<body>
<header>
    <nav>
        <?php if (app()->auth->check()): ?>
            <?php if (app()->auth->user()->isAccountant()): ?>
                <a href="<?= app()->route->getUrl('/dashboard') ?>">Главная</a>
                <a href="<?= app()->route->getUrl('/accruals') ?>">Начисления</a>
                <a href="<?= app()->route->getUrl('/deductions') ?>">Вычеты</a>
                <a href="<?= app()->route->getUrl('/payslip') ?>">Расчетный листок</a>
            <?php elseif (app()->auth->user()->isAdmin()): ?>
                <a href="<?= app()->route->getUrl('/dashboard') ?>">Главная</a>
                <a href="<?= app()->route->getUrl('/admin/employee/add') ?>">Добавить сотрудника</a>
                <a href="<?= app()->route->getUrl('/admin/user/add') ?>">Добавить бухгалтера</a>
            <?php endif; ?>
            <a href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
        <?php else: ?>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>
</body>
</html>