<?php

use PHPUnit\Framework\TestCase;
use Model\User;

class SiteTest extends TestCase
{
    /**
     * @dataProvider loginProvider
     * @runInSeparateProcess
     */
    public function testLogin(string $httpMethod, array $credentials, string $expectedType, string $expectedValue): void
    {
        if (isset($credentials['login']) && $credentials['login'] === 'login is busy') {
            $user = User::first();
            if (!$user) {
                $this->markTestSkipped('Нет пользователей в базе данных');
                return;
            }
            $credentials['login'] = $user->login;
        }

        $request = $this->createMock(\Src\Request::class);
        $request->expects($this->any())
            ->method('all')
            ->willReturn($credentials);
        $request->method = $httpMethod;

        $result = (new \Controller\UserController())->login($request);

        if ($expectedType === 'redirect') {
            $this->assertContains($expectedValue, xdebug_get_headers());
            $this->assertTrue(\Src\Auth\Auth::check());
        } elseif ($expectedType === 'html') {
            $this->assertStringContainsString($expectedValue, $result);
        }
    }

    public static function loginProvider(): array
    {
        return [
            'GET form' => [
                'GET',
                [],
                'html',
                '<h1>Авторизация</h1>'
            ],
            'wrong credentials' => [
                'POST',
                ['login' => 'wrong_login_123', 'password' => 'any_password'],
                'html',
                'Неправильные логин или пароль'
            ],
            'wrong password' => [
                'POST',
                ['login' => 'login is busy', 'password' => 'wrong_password'],
                'html',
                'Неправильные логин или пароль'
            ],
            'success login' => [
                'POST',
                ['login' => 'login is busy', 'password' => 'admin'],
                'redirect',
                'Location: /pop-it-mvc/dashboard'
            ],
        ];
    }

    protected function setUp(): void
    {
        $_SERVER['DOCUMENT_ROOT'] = 'C:/xampp/htdocs';

        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/path.php',
        ]));

        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }
}