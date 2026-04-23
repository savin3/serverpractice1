<div class="transactions-page">
    <h1>Операции</h1>

    <div class="forms-row">
        <div class="form-card">
            <h2>Добавить начисление</h2>
            <form method="POST" action="/pop-it-mvc/transactions/add-accrual">
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
                    <label for="accrual_type">Тип начисления</label>
                    <select name="accrual_type" required>
                        <option value="" disabled selected>Выберите тип</option>
                        <?php foreach ($accrualTypes as $type): ?>
                            <option value="<?= $type ?>"><?= $type ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Сумма (₽)</label>
                    <input type="number" name="amount" id="amount" required>
                </div>

                <div class="form-group">
                    <label for="month">Месяц</label>
                    <select name="month" required>
                        <option value="" disabled selected>Выберите месяц</option>
                        <?php foreach ($months as $num => $name): ?>
                            <option value="<?= $num ?>"><?= $name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_of_accrual">Дата начисления</label>
                    <input type="date" name="date_of_accrual" id="date_of_accrual" required>
                </div>

                <button type="submit" class="btn">Добавить начисление</button>
            </form>
        </div>

        <div class="form-card">
            <h2>Добавить вычет</h2>
            <form method="POST" action="/pop-it-mvc/transactions/add-deduction">
                <div class="form-group">
                    <label for="accrual_id">Начисление</label>
                    <select name="accrual_id" id="accrual_id" required>
                        <option value="" disabled selected>Выберите начисление</option>
                        <?php foreach ($accruals as $accrual): ?>
                            <option value="<?= $accrual->id ?>">
                                <?= htmlspecialchars($accrual->employee->last_name . ' ' . $accrual->employee->first_name . ' ' . $accrual->employee->patronymic . ' — ' . $accrual->type . ' (' . $accrual->amount . ' ₽)') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="deduction_type">Тип вычета</label>
                    <select name="deduction_type" required>
                        <option value="" disabled selected>Выберите тип</option>
                        <?php foreach ($deductionTypes as $type): ?>
                            <option value="<?= $type ?>"><?= $type ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Сумма (₽)</label>
                    <input type="number" name="amount" id="amount" required>
                </div>

                <div class="form-group">
                    <label for="month">Месяц</label>
                    <select name="month" required>
                        <option value="" disabled selected>Выберите месяц</option>
                        <?php foreach ($months as $num => $name): ?>
                            <option value="<?= $num ?>"><?= $name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_of_deduction">Дата вычета</label>
                    <input type="date" name="date_of_deduction" id="date_of_deduction" required>
                </div>

                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea name="comment" id="comment" rows="2"></textarea>
                </div>

                <button type="submit" class="btn">Добавить вычет</button>
            </form>
        </div>
    </div>

    <div class="transactions-list">
        <h2>Список операций</h2>
        <table>
            <thead>
            <tr>
                <th>Тип</th>
                <th>Сотрудник</th>
                <th>Сумма</th>
                <th>Месяц</th>
                <th>Дата операции</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td>
                        <?php if ($transaction->accrual_id && !$transaction->deduction_id): ?>
                            Начисление
                        <?php elseif ($transaction->deduction_id && $transaction->accrual_id): ?>
                            Вычет
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($transaction->accrual && $transaction->accrual->employee): ?>
                            <?= htmlspecialchars($transaction->accrual->employee->last_name . ' ' . $transaction->accrual->employee->first_name . ' ' . $transaction->accrual->employee->patronymic) ?>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                    <td><?= number_format($transaction->amount, 2) ?> ₽</td>
                    <td>
                        <?php
                        $monthNum = $transaction->accrual->month ?? $transaction->deduction->month ?? null;
                        echo $months[$monthNum] ?? '—';
                        ?>
                    </td>
                    <td><?= $transaction->date_transaction ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>