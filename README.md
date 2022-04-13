# Wiggli - Coding challenge
<p align="center">
<img alt="PHP" src="https://img.shields.io/badge/php-%23777BB4.svg?&style=for-the-badge&logo=php&logoColor=white"/> <img alt="Laravel" src="https://img.shields.io/badge/laravel%20-%23FF2D20.svg?&style=for-the-badge&logo=laravel&logoColor=white"/> <img alt="MySQL" src="https://img.shields.io/badge/mysql-%2300f.svg?&style=for-the-badge&logo=mysql&logoColor=white"/>  <img alt="MongoDB" src="https://img.shields.io/badge/MongoDB-%234ea94b.svg?style=for-the-badge&logo=mongodb&logoColor=white"/> <img alt="ReactJS" src="https://img.shields.io/badge/-ReactJs-61DAFB?logo=react&logoColor=white&style=for-the-badge"/>
</p>

## Requirements

- Docker


## Get started

### Setup

1. Clone the repository into `~/dev`

```bash
git clone git@github.com:customer-care-ai/tripetto-demo.git
```

2. To avoid user/group permissions issues, let's export your user ID & group ID

```bash
export WWWUSER=$(id -u ${USER}) WWWGROUP=$(id -g ${USER})
```

3. Copy `.env.example` to `.env`

```bash
cp .env.example .env
```

4. Build docker containers

```bash
docker-compose up -d
```

5. Check all containers are running

```bash
docker-compose ps
```

| NAME          |        COMMAND         |       SERVICE |            STATUS |                                          PORTS |
|---------------|:----------------------:|--------------:|------------------:|-----------------------------------------------:|
| mongo-express | "tini -- /docker-ent…" | mongo-express | running (healthy) |                         0.0.0.0:8081->8081/tcp |
| mongodb       | "docker-entrypoint.s…" |       mongodb | running (healthy) |                       0.0.0.0:27017->27017/tcp |
| wiggli   |   "start-container"    |         php81 |           running |                             0.0.0.0:80->80/tcp |

6. Connect to app container via SSH

```bash
docker-compose exec wiggli /bin/bash
```

7. Install project dependencies

```bash
> composer install && php artisan key:generate && php artisan storage:link
```

8. Run migration and seed default data

```bash
> php artisan migrate && php artisan db:seed && php artisan passport:install
```

9. Build front end

```bash
> npm install && npm run dev
```

Here we're, you can go to [http://localhost:8088](http://localhost:8088)

### Notes

You can use [Laravel Valet](https://laravel.com/docs/9.x/valet) to link the application with a hostname easily.

### Resources

- [Docker Compose](https://docs.docker.com/compose/install)
- [Laravel](https://laravel.com/docs/9.x)
- [Laravel Sail](https://laravel.com/docs/9.x/sail)
- [Laravel Valet](https://laravel.com/docs/9.x/valet)
- [MongoDB and Laravel Integration](https://www.mongodb.com/compatibility/mongodb-laravel-intergration)