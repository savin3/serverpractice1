<div class="payslip-page">
    <h1>Расчётный лист и отчёт по зарплате</h1>

    <div class="form-card">
        <h2>Расчётный лист сотрудника</h2>
        <form method="POST" action="<?= app()->route->getUrl('/payslip') ?>">
            <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

            <div class="form-group">
                <label for="employee_id">Сотрудник</label>
                <select name="employee_id" id="employee_id" required>
                    <option value="" disabled selected>Выберите сотрудника</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee->id ?>"><?= htmlspecialchars($employee->last_name . ' ' . $employee->first_name . ' ' . $employee->patronymic) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Начало периода</label>
                <input type="date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">Конец периода</label>
                <input type="date" name="end_date" required>
            </div>

            <button type="submit" name="action" value="payslip" class="btn">Сформировать расчётный лист</button>
        </form>
    </div>

    <div class="form-card">
        <h2>Среднемесячная зарплата по подразделениям</h2>
        <form method="POST" action="<?= app()->route->getUrl('/payslip') ?>">
            <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

            <div class="form-group">
                <label for="report_department">Подразделение</label>
                <select name="report_department" required>
                    <option value="" disabled selected>Выберите подразделение</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= $dept ?>"><?= $dept ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="report_month">Месяц</label>
                <select name="report_month" required>
                    <option value="" disabled selected>Выберите месяц</option>
                    <?php foreach ($months as $num => $name): ?>
                        <option value="<?= $num ?>"><?= $name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="report_year">Год</label>
                <select name="report_year" required>
                    <?php for ($y = 2020; $y <= date('Y'); $y++): ?>
                        <option value="<?= $y ?>"><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <button type="submit" name="action" value="report" class="btn">Сформировать отчёт</button>
        </form>
    </div>

    <?php if (isset($payslip) && $payslip): ?>
        <div class="result-block">
            <h2>Расчётный лист</h2>
            <p><strong>Сотрудник:</strong> <?= htmlspecialchars($payslip['employee']->last_name . ' ' . $payslip['employee']->first_name . ' ' . $payslip['employee']->patronymic) ?></p>
            <p><strong>Период:</strong> <?= $payslip['start_date'] ?> — <?= $payslip['end_date'] ?></p>
            <p><strong>Начислено:</strong> <?= number_format($payslip['total_accruals'], 2) ?> ₽</p>
            <p><strong>Удержано:</strong> <?= number_format($payslip['total_deductions'], 2) ?> ₽</p>
            <p><strong>К выплате:</strong> <?= number_format($payslip['amount_to_pay'], 2) ?> ₽</p>
            <p><strong>Сформировал:</strong> <?= htmlspecialchars(app()->auth->user()->login) ?></p>
            <p><strong>Дата формирования:</strong> <?= date('d.m.Y H:i:s') ?></p>

        </div>
    <?php endif; ?>

    <?php if (isset($report) && $report): ?>
        <div class="result-block">
            <h2>Среднемесячная зарплата по подразделениям</h2>
            <p><strong>Период:</strong> <?= $months[$report['month']] ?> <?= $report['year'] ?></p>
            <p><strong>Подразделение:</strong> <?= $report['department'] ?: 'Все' ?></p>
            <table class="data-table">
                <thead>
                <tr>
                    <th>Подразделение</th>
                    <th>Средняя зарплата</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($report['data'] as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row->department) ?></td>
                        <td><?= number_format($row->avg_salary, 2) ?> ₽</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>