## create migration

```
vendor/bin/phinx create Order
```

## run migration

```
vendor/bin/phinx migrate -e development
```

## rollback migration

```
vendor/bin/phinx rollback -e development
```

## create seeder

```
vendor/bin/phinx seed:create Product
```

## run seeder

```
vendor/bin/phinx seed:run

vendor/bin/phinx seed:run -e development -s KindProduct
```
