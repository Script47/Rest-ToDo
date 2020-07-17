##Rest ToDo

#### Philosophy

- I tend to follow the "skinny controllers, fat services, and fat repositories" structure
- Controllers handle the routing and passing info both ways
- Services handle the business logic
- Repositories handle querying the db
- Entities handle mapping the table structure

#### Pros

- Extensible, handles multiple data formats and can be expanded further easily (SOLID)
- Clean, concerns have been separated (SOLID)
- Simple, easy to use, easy to understand (KISS)

#### Setup

**Note:** Set your db credentials in both `.env` and `.env.test` prior

Install dependencies:

```cmd
composer install
```

Create db:

```cmd
php bin/console doctrine:database:create
```

Run migrations:

```cmd
php bin/console do:mi:mi
```

Run fixtures:

```cmd
php bin/console do:fi:lo
```

Run server:

```cmd
symfony server:start
```

#### Endpoints

`GET /tasks` - List all tasks

`POST /tasks` - Create tasks

#### Testing

Of course, much more testing could be added, but I've kept it minimal but meaningful.

Create db:

```cmd
php bin/console doctrine:database:create --env=test
```

Run migrations:

```cmd
php bin/console do:mi:mi --env=test
```

Run fixtures:

```cmd
php bin/console do:fi:lo --env=test
```

Run tests:

```cmd
php bin/phpunit
```
