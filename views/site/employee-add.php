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

    <h1>Добавление сотрудника</h1>

    <form method="POST" action="<?= app()->route->getUrl('/admin/employee/store') ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

        <div class="form-group">
            <label for="first_name">Имя</label>
            <input type="text" name="first_name" id="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Фамилия</label>
            <input type="text" name="last_name" id="last_name" required>
        </div>

        <div class="form-group">
            <label for="patronymic">Отчество</label>
            <input type="text" name="patronymic" id="patronymic">
        </div>

        <div class="form-group">
            <label for="payer_number">ИНН</label>
            <input type="text" name="payer_number" id="payer_number" required>
        </div>

        <div class="form-group">
            <label for="employee_number">Табельный номер</label>
            <input type="text" name="employee_number" id="employee_number" required>
        </div>

        <div class="form-group">
            <label for="insurance_number">СНИЛС</label>
            <input type="text" name="insurance_number" id="insurance_number" required>
        </div>

        <div class="form-group">
            <label for="bank_account">Банковский счет</label>
            <input type="text" name="bank_account" id="bank_account" required>
        </div>

        <div class="form-group">
            <label for="date_employment">Дата принятия</label>
            <input type="date" name="date_employment" id="date_employment" required>
        </div>

        <div class="form-group">
            <label for="position">Должность</label>
            <select name="position" id="position" required>
                <option value="" disabled selected>Выберите должность</option>
                <?php foreach ($positions as $position): ?>
                    <option value="<?= $position ?>"><?= $position ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="department">Отдел</label>
            <select name="department" id="department" required>
                <option value="" disabled selected>Выберите отдел</option>
                <?php foreach ($departments as $department): ?>
                    <option value="<?= $department ?>"><?= $department ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="bonus">Надбавка (₽)</label>
            <input type="number" name="bonus" id="bonus" value="0">
        </div>

        <div class="form-group">
            <label for="salary">Оклад (₽)</label>
            <input type="number" name="salary" id="salary" required>
        </div>

        <div class="form-group">
            <label for="photo">Фото сотрудника</label>
            <input type="file" name="photo" id="photo" accept="image/*">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Сохранить</button>
            <a href="/pop-it-mvc/dashboard" class="btn btn-cancel">Отменить</a>
        </div>
    </form>
</div>