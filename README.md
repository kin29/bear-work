# MyVendor.WellSaid

## Installation

    composer install

## Usage

### Run server

    COMPOSER_PROCESS_TIMEOUT=0 composer serve

### Console

    composer web get /
    composer api get /

### QA

    composer test       // phpunit
    composer coverage   // test coverate
    composer cs         // lint
    composer cs-fix     // lint fix
    vendor/bin/phptest  // test + cs
    vendor/bin/phpbuild // phptest + doc + qa

## Usage
    php bootstrap/api.php get '/said?mode=show'
    php bootstrap/api.php get '/said?mode=random'
    php bootstrap/api.php get '/said?mode=delete&id=1'
    php bootstrap/api.php get '/said?mode=insert&said=time is money&who=unknown'
      
    php -S 127.0.0.1:8080 bootstrap/api.php
    curl -i 'http://127.0.0.1:8080/said?mode=show'

## test data
    mkdir db
    sqlite3 db/said.sqlite3
      
    CREATE TABLE said_table (
     id integer primary key,
     said text, who text,
     create_date text,
     del_flg integer
    );
    INSERT INTO said_table (id, said, who, create_date, del_flg)
    VALUES (1, 'Time is money(時は金なり)', 'unknown', CURRENT_TIMESTAMP, 0);
    INSERT INTO said_table (id, said, who, create_date, del_flg)
    VALUES (2, 'Leap before you look(見る前に飛べ))', 'W・H・オーデン', CURRENT_TIMESTAMP, 0);