<div class="login-container">
    <h1>Авторизация</h1>

    <?php if (!empty($message)): ?>
        <div class="error-message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="button">Войти</button>
    </form>
</div>