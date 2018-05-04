# MyVendor.WellSaid

## Installation

    composer install

### API
    php bootstrap/index.php get '/said?mode=show'
    php bootstrap/index.php get '/said?mode=random'
    php bootstrap/index.php put '/said?mode=delete&id=1'
    php bootstrap/index.php post '/said?mode=insert&said=time is money&who=unknown'
    
    php -S 127.0.0.1:8080 bootstrap/index.php
    curl -i 'http://127.0.0.1:8080?mode=show'

### test saying data
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

### memo
    herokuでのdeploy用にProcfile追加してます。
    bootstrap/api.php→bootstrap/index.phpに変更してます