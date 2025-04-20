# Job Board Platform

A Laravel 12 based job board platform with Docker configuration for development and deployment.

## Prerequisites

Before you begin, ensure you have the following installed:
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/downloads)

## Stack

- PHP 8.2 (FPM)
- Nginx
- MySQL 8.0
- Redis
- Laravel 12.9.2

## Installation

1. Clone the repository:
   

```bash git clone <repository-url> cd job-board-platform```

2. Copy the environment file:


``` cp.env.example .env```

3. Configure your `.env` file with the following settings:

```env 
DB_CONNECTION=mysql 
DB_HOST=mysql 
DB_PORT=3306 
DB_DATABASE=your_database 
DB_USERNAME=your_username 
DB_PASSWORD=your_password
REDIS_HOST=redis 
REDIS_PASSWORD=null 
REDIS_PORT=6379
```


4. Build and start the Docker containers:

```bash
docker-compose build 
docker-compose up -d
```

5. Install dependencies:

```bash 
docker-compose exec app composer install
```

6. Set proper permissions:

```bash 
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache 
docker-compose exec app chmod -R 775 storage bootstrap/cache

```

7. Generate application key:

```bash
docker-compose exec app php artisan key:generate
```

8. Run database migrations:

```bash 
docker-compose exec app php artisan migrate

```


## Usage

The application will be available at:
- Website: `http://localhost`
- MySQL: localhost:3306
- Redis: localhost:6379

## Docker Commands

### Container Management
- Start containers: `docker-compose up -d`
- Stop containers: `docker-compose down`
- Rebuild containers: `docker-compose build`
- View logs: `docker-compose logs -f`

### Access Containers
- PHP container: `docker-compose exec app bash`
- MySQL container: `docker-compose exec mysql mysql -u your_username -p`
- Redis CLI: `docker-compose exec redis redis-cli`

### Laravel Commands
Run Laravel commands through the PHP container:
```bash
docker-compose exec app php artisan
```



## Design Choices

The application is structured using the HMVC (Hierarchical Model-View-Controller) architecture, which organizes the code into self-contained modules. Each module manages its own controllers, models, and views, making the codebase more modular, readable, and easier to scale or maintain over time.

I also applied the Service-Repository pattern to separate business logic from data access. Services handle the application's core logic, while repositories manage database interactions. This separation of concerns makes the codebase cleaner, more testable, and easier to extend in the future.

## Improvements

1. For the filtering and search of Jobs, Elasticsearch can be used to index the Jobs which will be more efficient for full-text search
2. The locations can have their separate entity which will be more efficient during filtering
3. Job posting can be made into a feed that can be generated for each user using workers and it should be tailored to each specific user
