### Create new migration
```
php vendor/bin/phinx create CreateTestTable -c config/config-phinx.php
```

### Run migrations
```
php vendor/bin/phinx migrate -c config/config-phinx.php
```