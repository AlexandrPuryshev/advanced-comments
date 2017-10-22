# Установка:

Чтобы запустить этот проект нужно сначала выполнить такие команды (по порядку):

1) Выполнить команду: composer global require "fxp/composer-asset-plugin:^1.2.0"

2) Выполнить команду: composer update или composer install

3) Выполнить команду: php init

4) следовать инструкциям php init

5) зайти в папку по адресу (папка проекта)\common\config

6) открыть файл main-local, сам файл должен содрежать следующее( пример):
```php
      <?php
        return [
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                    'tablePrefix' => 'social_',
                ],
                'mailer' => [
                    'class' => 'yii\swiftmailer\Mailer',
                    'viewPath' => '@common/mail',
                    // send all mails to a file by default. You have to set
                    // 'useFileTransport' to false and configure a transport
                    // for the mailer to send real emails.
                    'useFileTransport' => true,
                ],
            ],
        ];
```
7) Указать данные для подключения к базе данным "dbname=yii2advanced" -> имя базы данных, остальные 2 строки ниже, это имя пользователя и пароль

8) выполнить команду php yii migrate

# Тестирование

1) Тестирование проводится с помощью плагина yii2-codeception

2) Чтобы запустить тесты, нужно для начала выполнить команду composer update

3) Потом зайти либо в папку frontend либо в папку backend.

4) Чтобы запускать тесты через команду codecept в папках frontend или backend необходимо выполнить следующее:
      - Для Windows:  добавьте путь к файлу codecept.bat в системную переменную PATH.
      
            Должно получиться примерно так: D:\wamp64\www\advanced-comments\vendor\bin
            
      - Для Linux:  запуск программы codecept можно выполнить из самого проекта:
      
            vendor/bin/codecept run unit

5) Выполнить комманду codecept build

6) В папках frontend или backend/tests/unit.suite.yml указать свои данный для подключение к базе данных (yii2advacned -> yii2advanced_test)

7) Запустить codecept run unit

### Полный dump базы данных храниться в папке "full_dump" в папке самого проекта
