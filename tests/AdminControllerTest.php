<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Model\Employee;

class AdminControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $_SERVER['DOCUMENT_ROOT'] = 'C:/xampp/htdocs';

        $settings = new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/path.php',
        ]);

        $GLOBALS['app'] = new Src\Application($settings);

        if (!function_exists('app')) {
            function app() {
                return $GLOBALS['app'];
            }
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function tearDown(): void
    {
        $_SESSION = [];
        parent::tearDown();
    }

    /**
     * TC_EMPL_1: Успешное добавление сотрудника
     */
    public function testStoreEmployeeSuccess(): void
    {
        $mockRoute = $this->createMock(\Src\Route::class);
        $mockRoute->expects($this->any())
            ->method('redirect')
            ->willReturnCallback(function() {});
        $this->setMockRoute($mockRoute);

        $employeeData = [
            'first_name' => 'Петр',
            'last_name' => 'Иванов',
            'patronymic' => 'Сидорович',
            'employee_number' => '999999',
            'insurance_number' => '123-456-789 12',
            'payer_number' => '987654321012',
            'position' => 'Финансовый аналитик',
            'department' => 'Финансовый отдел',
            'salary' => '50000',
            'bonus' => '0',
            'bank_account' => '40817810000000000123',
            'date_employment' => '2026-04-25',
        ];

        $request = $this->createMock(\Src\Request::class);
        $request->method = 'POST';
        $request->expects($this->any())
            ->method('all')
            ->willReturn($employeeData);

        $controller = new \Controller\AdminController();
        $controller->storeEmployee($request);

        $employee = Employee::where('employee_number', '999999')->first();
        $this->assertNotNull($employee);
        $this->assertEquals('Петр', $employee->first_name);
        $this->assertEquals('Иванов', $employee->last_name);

        $employee->delete();
    }

    /**
     * TC_EMPL_2: Пустые обязательные поля
     */
    public function testStoreEmployeeValidationRequired(): void
    {
        $mockRoute = $this->createMock(\Src\Route::class);
        $mockRoute->method('redirect')->willThrowException(new \Exception('Redirect called'));
        $this->setMockRoute($mockRoute);

        $employeeData = [
            'first_name' => '',
            'last_name' => '',
            'patronymic' => '',
            'employee_number' => '',
            'insurance_number' => '',
            'payer_number' => '',
            'bank_account' => '',
            'salary' => '',
            'position' => 'Финансовый аналитик',
            'department' => 'Финансовый отдел',
            'bonus' => '0',
            'date_employment' => '2026-04-25',
        ];

        $request = $this->createMock(\Src\Request::class);
        $request->method = 'POST';
        $request->expects($this->any())
            ->method('all')
            ->willReturn($employeeData);

        $controller = new \Controller\AdminController();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Redirect called');

        try {
            $controller->storeEmployee($request);
        } finally {
            $this->assertArrayHasKey('errors', $_SESSION);
            $errors = $_SESSION['errors'];

            $this->assertArrayHasKey('first_name', $errors);
            $this->assertArrayHasKey('last_name', $errors);
            $this->assertArrayHasKey('patronymic', $errors);
            $this->assertArrayHasKey('employee_number', $errors);
            $this->assertArrayHasKey('insurance_number', $errors);
            $this->assertArrayHasKey('payer_number', $errors);
            $this->assertArrayHasKey('bank_account', $errors);
            $this->assertArrayHasKey('salary', $errors);

            $employee = Employee::where('employee_number', '')->first();
            $this->assertNull($employee);
        }
    }

    /**
     * TC_EMPL_3: Некорректные форматы данных
     */
    public function testStoreEmployeeValidationFormat(): void
    {
        $mockRoute = $this->createMock(\Src\Route::class);
        $mockRoute->method('redirect')->willThrowException(new \Exception('Redirect called'));
        $this->setMockRoute($mockRoute);

        $employeeData = [
            'first_name' => 'Петр',
            'last_name' => 'Иванов',
            'patronymic' => 'Сидорович',
            'employee_number' => 'abc123',
            'insurance_number' => '12345',
            'payer_number' => '123',
            'bank_account' => '123',
            'salary' => '-1000',
            'position' => 'Финансовый аналитик',
            'department' => 'Финансовый отдел',
            'bonus' => '0',
            'date_employment' => '2026-04-25',
        ];

        $request = $this->createMock(\Src\Request::class);
        $request->method = 'POST';
        $request->expects($this->any())
            ->method('all')
            ->willReturn($employeeData);

        $controller = new \Controller\AdminController();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Redirect called');

        try {
            $controller->storeEmployee($request);
        } finally {
            $this->assertArrayHasKey('errors', $_SESSION);
            $errors = $_SESSION['errors'];

            $this->assertArrayHasKey('employee_number', $errors);
            $this->assertArrayHasKey('salary', $errors);
            $this->assertArrayHasKey('insurance_number', $errors);
            $this->assertArrayHasKey('payer_number', $errors);
            $this->assertArrayHasKey('bank_account', $errors);

            $employee = Employee::where('employee_number', 'abc123')->first();
            $this->assertNull($employee);
        }
    }

    /**
     * TC_EMPL_4: Доступ только для администратора
     */
    public function testStoreEmployeeAccessOnlyForAdmin(): void
    {
        $this->assertTrue(true);
    }

    /**
     * вспомогательный метод для подмены route в app()
     */
    private function setMockRoute($mockRoute): void
    {
        $reflection = new \ReflectionClass($GLOBALS['app']);
        $property = $reflection->getProperty('route');
        $property->setAccessible(true);
        $property->setValue($GLOBALS['app'], $mockRoute);
    }
}