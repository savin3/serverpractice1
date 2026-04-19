<div class="dashboard">
    <h1>Список сотрудников</h1>

    <div class="employees-grid">
        <div class="employee-card">
            <div class="card-body">
                <p><strong>Фамилия:</strong> <span class="placeholder"></span></p>
                <p><strong>Имя:</strong> <span class="placeholder"></span></p>
                <p><strong>Отчество:</strong> <span class="placeholder"></span></p>
                <p><strong>Табельный номер:</strong> <span class="placeholder"></span></p>
                <p><strong>СНИЛС:</strong> <span class="placeholder"></span></p>
                <p><strong>ИНН:</strong> <span class="placeholder"></span></p>
            </div>
            <div class="card-actions">
                <button class="btn-add">Добавить начисление</button>
                <button class="btn-add">Добавить вычет</button>
                <button class="btn-add">Формирование расчета</button>
            </div>
        </div>

        <div class="employee-card">
            <div class="card-body">
                <p><strong>Фамилия:</strong> <span class="placeholder"></span></p>
                <p><strong>Имя:</strong> <span class="placeholder"></span></p>
                <p><strong>Отчество:</strong> <span class="placeholder"></span></p>
                <p><strong>Табельный номер:</strong> <span class="placeholder"></span></p>
                <p><strong>СНИЛС:</strong> <span class="placeholder"></span></p>
                <p><strong>ИНН:</strong> <span class="placeholder"></span></p>
            </div>
            <div class="card-actions">
                <button class="btn-add">Добавить начисление</button>
                <button class="btn-add">Добавить вычет</button>
                <button class="btn-add">Формирование расчета</button>
            </div>
        </div>

        <div class="employee-card">
            <div class="card-body">
                <p><strong>Фамилия:</strong> <span class="placeholder"></span></p>
                <p><strong>Имя:</strong> <span class="placeholder"></span></p>
                <p><strong>Отчество:</strong> <span class="placeholder"></span></p>
                <p><strong>Табельный номер:</strong> <span class="placeholder"></span></p>
                <p><strong>СНИЛС:</strong> <span class="placeholder"></span></p>
                <p><strong>ИНН:</strong> <span class="placeholder"></span></p>
            </div>
            <div class="card-actions">
                <button class="btn-add">Добавить начисление</button>
                <button class="btn-add">Добавить вычет</button>
                <button class="btn-add">Формирование расчета</button>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .dashboard h1 {
        margin-bottom: 25px;
        color: #333;
    }

    .employees-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
    }

    .employee-card {
        border: 1px dashed #000;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    .employee-card:hover {
        transform: translateY(-3px);
    }

    .card-header {
        background: #4CAF50;
        color: white;
        padding: 12px 15px;
    }

    .card-header h3 {
        margin: 0;
        font-size: 18px;
    }

    .card-body {
        padding: 15px;
    }

    .card-body p {
        margin: 8px 0;
        font-size: 14px;
    }

    .placeholder {
        color: #888;
        font-weight: normal;
    }

    .card-actions {
        display: flex;
        gap: 8px;
        padding: 12px 15px;
        background: #f9f9f9;
        border-top: 1px solid #eee;
        flex-wrap: wrap;
    }

    .btn-add {
        background: #2196F3;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        flex: 1;
        min-width: 100px;
    }

    .btn-add:hover {
        background: #1976D2;
    }
</style>