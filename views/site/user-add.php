<div class="form-container">
    <?php if (!empty($_SESSION['errors'])): ?>
        <div class="error-list">
            <?php foreach ($_SESSION['errors'] as $field => $errors): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <h1>Добавление бухгалтера</h1>

    <form method="POST" action="<?= app()->route->getUrl('/admin/user/store') ?>">
        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" name="login" id="login" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Сохранить</button>
            <a href="/pop-it-mvc/dashboard" class="btn btn-cancel">Отменить</a>
        </div>
    </form>
</div>