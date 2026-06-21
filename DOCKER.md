# Docker setup

This project runs as a Laravel app container with a MySQL database container.

## Start the app

```bash
docker compose up --build -d
```

Open the site at:

```text
http://localhost:8000
```

The MySQL container is available from the host on port `3307`.

## Environment

The Docker stack reads `.env`. The important Docker database values are:

```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=synapse
DB_USERNAME=synapse
DB_PASSWORD=synapse_password
DB_ROOT_PASSWORD=root_password
```

Change `APP_KEY`, `APP_DEBUG`, database passwords, and `ADMIN_PASSWORD` before hosting publicly.

## Common commands

```bash
docker compose ps
docker compose logs -f app
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:status
docker compose down
```

To delete the local database data and start fresh:

```bash
docker compose down -v
```
