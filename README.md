#### *Windowsの方はGit Bash、Macの方はターミナルを開きましょう

パッケージのインストール
```
composer install
```

.env.exampleのコピー

```
cp .env.example .env
```

APP_KEYの生成

```
php artisan key:generate
```

今回はmysqlではなくsqliteというファイルへのデータ保存を行う。
```
touch database/database.sqlite
```

migration実行
```
php artisan migrate
```