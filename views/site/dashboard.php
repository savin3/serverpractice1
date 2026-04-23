<div class="dashboard">
    <h1>Список сотрудников</h1>

    <?php if (empty($employees)): ?>
        <p>Нет сотрудников</p>
    <?php else: ?>
        <div class="employees-grid">
            <?php foreach ($employees as $employee): ?>
                <div class="employee-card">
                    <div class="card-body">
                        <p><strong>Фамилия:</strong> <?= htmlspecialchars($employee->last_name) ?></p>
                        <p><strong>Имя:</strong> <?= htmlspecialchars($employee->first_name) ?></p>
                        <p><strong>Отчество:</strong> <?= htmlspecialchars($employee->patronymic) ?></p>
                        <p><strong>Табельный номер:</strong> <?= htmlspecialchars($employee->employee_number) ?></p>
                        <p><strong>СНИЛС:</strong> <?= htmlspecialchars($employee->insurance_number) ?></p>
                        <p><strong>ИНН:</strong> <?= htmlspecialchars($employee->payer_number) ?></p>
                    </div>
                    <div class="card-actions">
                        <a href="<?= app()->route->getUrl('/employee/' . $employee->id) ?>" class="btn-add">Подробнее</a>
                        <?php if (app()->auth->user()->isAccountant()): ?>
                            <a href="/pop-it-mvc/transactions" class="btn-add">Добавить начисление</a>
                            <a href="/pop-it-mvc/transactions" class="btn-add">Добавить вычет</a>
                            <a href="/pop-it-mvc/payslip" class="btn-add">Формирование расчета</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>