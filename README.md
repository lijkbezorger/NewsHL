# NewsHL -> News High Load API

TODO: 
    
    Нужно сделать API новостного сайта для управления категориями, статьями
    GET /posts - получение всех статей, под high load
    POST /post - создание статьи
    DELETE /post/<id> - удаление статьи
    PUT /post/<id> - обновление статьи
    GET /categories - получение списка категорий
    Статья должна принадлежать одной категории. Категория должна иметь счетчик количества принадлежащих ей статей.
    Необходимо добавить кеширование данных, применить SOLID принципы.
    Не нужно реализовывать авторизацию, разделение на роли.
    

**Fixtures**

Generate fixtures:

    php yii fixture/generate category --count=100
    
    php yii fixture/generate post --count=1000

Load fixtures:

    php yii fixture/load "*"


**Tests**

Migrations to test db :

     php yii test-infrastructure/run-migrations

Run tests:

    php vendor/bin/codecept run apiV1
