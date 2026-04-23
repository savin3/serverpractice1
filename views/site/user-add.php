<div class="form-container">
    <h1>Добавление бухгалтера</h1>

    <form method="POST" action="<?= app()->route->getUrl('/admin/user/store') ?>">
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