### Тестовые задание

Для развертывания проекта необходимо использовать команду

```shell
docker-compose up --build -d && docker exec laravel_app php artisan migrate
```

Для решения первой задачи была создана миграция для создания таблицы по данной структуре с примерами данных.
К базе данных пожно подключиться по адресу `localhost:3306`.
В качестве решения задачи можно использовать следующий запрос:

```sql
SELECT shop.article, GROUP_CONCAT(shop.dealer) as dealers, shop.price
FROM shop
         JOIN (SELECT article, MAX(price) as max_price FROM shop GROUP BY article) s2
              ON shop.article = s2.article AND price = s2.max_price
GROUP BY shop.article;
```

Для решения второй задачи создан новый проект из шаблона Laravel и изменен в соответствии с тебованиями задачи.
Была создана форма для отправки данных на сервер, реализован запрос к API яндекса, сохранение данных и вывод ответа
пользователю.
Для работы проекта необходимо указать в переменной окружения YA_API_KEY рабочий ключ к API яндекса.

Проект доступен по адресу <a href="http://localhost:8000">`localhost:8000`</a>
