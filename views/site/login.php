<div class="login-container">
    <h1>Авторизация</h1>

    <?php if (!empty($message)): ?>
        <div class="error-message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
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

<style>
    .login-container {
        max-width: 400px;
        margin: 100px auto;
        padding: 30px;
        background: #97C2B6;
        border-radius: 10px;
    }
    .login-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 15px;
        box-sizing: border-box;
    }
    .button {
        width: 50%;
        padding: 15px 30px;
        background: #4CAF50;
        color: #fff;
        display: block;
        margin: 0 auto;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        font-size: 16px;
    }
    .button:hover {
        background: #45a049;
    }
    .error-message {
        background: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>