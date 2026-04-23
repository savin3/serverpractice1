<div class="permanent-deductions-page">
    <h1>Постоянные вычеты сотрудников</h1>

    <div class="form-card">
        <h2>Добавить постоянный вычет</h2>
        <form method="POST" action="<?= app()->route->getUrl('/permanent-deductions/store') ?>">
            <div class="form-group">
                <label for="employee_id">Сотрудник</label>
                <select name="employee_id" id="employee_id" required>
                    <option value="">Выберите сотрудника</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee->id ?>"><?= htmlspecialchars($employee->last_name . ' ' . $employee->first_name . ' ' . $employee->patronymic) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="deduction_type">Тип вычета</label>
                <select name="deduction_type" id="deduction_type" required>
                    <option value="" disabled selected>Выберите тип</option>
                    <?php foreach ($deductionTypes as $type): ?>
                        <option value="<?= $type ?>"><?= $type ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Сумма (₽)</label>
                <input type="number" name="amount" required>
            </div>

            <div class="form-group">
                <label for="month">Месяц (первое применение)</label>
                <select name="month" required>
                    <option value="">Выберите месяц</option>
                    <?php foreach ($months as $num => $name): ?>
                        <option value="<?= $num ?>"><?= $name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Дата начала</label>
                <input type="date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">Дата окончания (оставьте пустым, если бессрочно)</label>
                <input type="date" name="end_date">
            </div>

            <div class="form-group">
                <label for="date_of_deduction">Дата вычета</label>
                <input type="date" name="date_of_deduction" required>
            </div>

            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea name="comment" rows="2"></textarea>
            </div>

            <button type="submit" class="btn">Добавить постоянный вычет</button>
        </form>
    </div>

    <div class="transactions-list">
        <h2>Список постоянных вычетов</h2>
        <table>
            <thead>
            <tr>
                <th>Сотрудник</th>
                <th>Тип</th>
                <th>Сумма</th>
                <th>Месяц</th>
                <th>Период действия</th>
                <th>Комментарий</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($permanentTransactions as $transaction): ?>
                <?php if ($transaction->deduction): ?>
                    <tr>
                        <td><?= htmlspecialchars($transaction->accrual->employee->last_name . ' ' . $transaction->accrual->employee->first_name . ' ' . $transaction->accrual->employee->patronymic) ?></td>
                        <td><?= $transaction->deduction->deduction_type ?></td>
                        <td><?= number_format($transaction->amount, 2) ?> ₽</td>
                        <td><?= $months[$transaction->deduction->month] ?? $transaction->deduction->month ?></td>
                        <td><?= $transaction->start_date ?> — <?= $transaction->end_date ?? 'бессрочно' ?></td>
                        <td><?= htmlspecialchars($transaction->deduction->comment) ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>