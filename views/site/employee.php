<div class="employee-details">
    <h1>Информация о сотруднике</h1>

    <div class="info-block">
        <p><strong>Фамилия:</strong> <?= htmlspecialchars($employee->last_name) ?></p>
        <p><strong>Имя:</strong> <?= htmlspecialchars($employee->first_name) ?></p>
        <p><strong>Отчество:</strong> <?= htmlspecialchars($employee->patronymic) ?></p>
        <p><strong>ИНН:</strong> <?= htmlspecialchars($employee->payer_number) ?></p>
        <p><strong>Табельный номер:</strong> <?= htmlspecialchars($employee->employee_number) ?></p>
        <p><strong>СНИЛС:</strong> <?= htmlspecialchars($employee->insurance_number) ?></p>
        <p><strong>Банковский счет:</strong> <?= htmlspecialchars($employee->bank_account) ?></p>
        <p><strong>Дата принятия:</strong> <?= $employee->date_employment ?></p>
        <p><strong>Должность:</strong> <?= htmlspecialchars($employee->position) ?></p>
        <p><strong>Отдел:</strong> <?= htmlspecialchars($employee->department) ?></p>
        <p><strong>Надбавка:</strong> <?= number_format($employee->bonus, 2) ?> ₽</p>
        <p><strong>Оклад:</strong> <?= number_format($employee->salary, 2) ?> ₽</p>
    </div>

    <div class="tabs">
        <a href="/employee/<?= $employee->id ?>/accruals" class="tab">Начисления</a>
        <a href="/employee/<?= $employee->id ?>/deductions" class="tab">Вычеты</a>
        <a href="/employee/<?= $employee->id ?>/payslips" class="tab">Расчетные листки</a>
    </div>
</div>