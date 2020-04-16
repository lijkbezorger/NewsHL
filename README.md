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
    
**Docker & usage**

- Set up project, docker, db:
    
    
    cp .env.example
    
    cd docker
    docker-compose build
    docker-compose up -d
    
    docker exec -it fpm_news bash
    cd {appRootDir}
    php yii migrate --migrationPath=@app/modules/api/migrations
    

- Load fixtures (see below) 
    
    
    docker exec -it fpm_news bash
    cd {appRootDir}
    
- Web:

    
    Home page:  localhost:8090
    
    API doc page: localhost:8090/api/v1/doc

- Set Up tests

    
    docker exec -it mysql_news bash
    mysql -u root -p 
    CREATE DATABASE newsHL_test CHARACTER SET utf8 COLLATE utf8_general_ci;
    GRANT ALL PRIVILEGES ON newsHL_test.* TO 'newsHL'@'%';
    
    docker exec -it fpm_news bash
    cd {appRootDir}
    php yiitest migrate --migrationPath=@app/modules/api/migrations | php yii test-infrastructure/run-migrations

- Run tests (commands below):
    
    docker exec -it fpm_news bash
    cd {appRootDir}
    

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
    
    php vendor/bin/codecept run unit
