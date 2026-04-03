<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Model\User;
use Src\Auth\Auth;

class SiteTest extends TestCase
{
    #[DataProvider('additionProvider')]
    #[\PHPUnit\Framework\Attributes\RunInSeparateProcess]
    public function testLogin(string $httpMethod, array $userData, string $message): void
    {
        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Site())->login($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }
    }

    #[DataProvider('additionRoomProvider')]
    #[\PHPUnit\Framework\Attributes\RunInSeparateProcess]
    public function testCreateRoom(string $httpMethod, array $userData, string | array $message): void
    {
        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        $user = User::create([
            'login' => 'test'.rand(0, 10000),
            'password' => md5('test'),
            'name' => 'test',
            'role_id' => '2',
            'surname' => 'test',
            'patronymic' => 'test',
        ]);

        Auth::login($user);

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Site())->createRoom($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            if (gettype($message) === 'array') {
                foreach ($message as $mes) {
                    $mes = '/' . preg_quote($mes, '/') . '/';
                    $this->expectOutputRegex($mes);
                    return;
                }
            } else {
                $message = '/' . preg_quote($message, '/') . '/';
                $this->expectOutputRegex($message);
                return;
            }
        }

        $user->delete();
    }

    #[DataProvider('additionBuildingProvider')]
    #[\PHPUnit\Framework\Attributes\RunInSeparateProcess]
    public function testCreateBuilding(string $httpMethod, array $userData, string | array $message): void
    {
        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        $user = User::create([
            'login' => 'test'.rand(10000, 20000),
            'password' => md5('test'),
            'name' => 'test',
            'role_id' => '2',
            'surname' => 'test',
            'patronymic' => 'test',
        ]);

        Auth::login($user);

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Site())->createBuilding($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            if (gettype($message) === 'array') {
                foreach ($message as $mes) {
                    $mes = '/' . preg_quote($mes, '/') . '/';
                    $this->expectOutputRegex($mes);
                    return;
                }
            } else {
                $message = '/' . preg_quote($message, '/') . '/';
                $this->expectOutputRegex($message);
                return;
            }
        }

        $user->delete();
    }

//Метод, возвращающий набор тестовых данных
    public static function additionProvider(): array
    {
        return [
            ['GET', ['login' => '', 'password' => ''],
                '<h3></h3>'
            ],
            ['POST', ['login' => '', 'password' => ''],
                '<h3>{"login":["Поле login пусто"],"password":["Поле password пусто"]}</h3>'
            ],
            ['POST', ['login' => 'admin', 'password' => 'admin'],
                '<p>вы уже вошли(</p>'
            ],
        ];
    }

    public static function additionRoomProvider(): array
    {
        return [
            ['GET',
                [
                    'number' => '',
                    'square' => '',
                    'seating' => '',
                    'building_id' => '',
                    'view_id' => ''
                ],
                '<h2>Редактирование комнаты</h2>'
            ],
            ['POST',
                [
                    'number' => '',
                    'square' => '',
                    'seating' => '',
                    'building_id' => '',
                    'view_id' => ''
                ],
                [
                    '<p>Поле number пусто</p>',
                    '<p>Поле square пусто</p>',
                    '<p>Поле seating пусто</p>',
                    '<p>Поле building_id пусто</p>',
                    '<p>Поле view_id пусто</p>',
                ]
            ],
            ['POST',
                [
                    'number' => 'adsa',
                    'square' => 'выфыфвыфыф',
                    'seating' => 'рпмоитльб',
                    'building_id' => '1',
                    'view_id' => '1'
                ],
                [
                    '<p>Поле number должно быть числом</p>',
                    '<p>Поле square должно быть числом</p>',
                    '<p>Поле seating должно быть целым числом</p>',
                ]
            ],
            ['POST',
                [
                    'number' => '999999',
                    'square' => '100',
                    'seating' => '5',
                    'building_id' => '1',
                    'view_id' => '1'
                ],
                [
                    '<p>Поле number должно быть не больше 5 символов</p>',
                    '<p>Поле square должно быть числом</p>',
                    '<p>Поле seating должно быть целым числом</p>',
                ]
            ],
            ['POST',
                [
                    'number' => '9999',
                    'square' => '100',
                    'seating' => '5',
                    'building_id' => '1',
                    'view_id' => '1'
                ],
                '<p>Комната успешно создана</p>'
            ],
        ];
    }

    public static function additionBuildingProvider(): array
    {
        return [
            ['GET',
                [
                    'name' => '',
                    'address' => ''
                ],
                '<h2>Создание здания</h2>'
            ],
            ['POST',
                [
                    'name' => 'a',
                    'address' => 'a'
                ],
                [
                    '<p>Поле name должно быть не меньше 3 символов</p>',
                    '<p>Поле address должно быть не меньше 3 символов</p>'
                ]
            ],
            ['POST',
                [
                    'name' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
                    'address' => 'aaaa'
                ],
                '<p>Поле name должно быть не больше 50 символов</p>'
            ],
            ['POST',
                [
                    'name' => 'крутое здание',
                    'address' => 'за углом'
                ],
                '<p>Здание успешно создано</p>'
            ],
        ];
    }

    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/..';
        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
        ]));
        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }

}