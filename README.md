お問い合わせフォーム

環境構築

Dockerビルド
1.docker-compose up -d --build

＊　MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

Laravelの環境構築
1. docker-compose exec php bash
2. composer install
3. php aritsan　key:generate
4. php artisan migrate
5. php artisan db:seed

使用技術　
・PHP 8.0
・laravel 10.0
・MySQL 8.0

URL
・　開発環境　：　http://localhost/
・ phpMyAdmin 　http://localhost:8080/

