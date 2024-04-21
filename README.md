# Online Store API

## About The Project

This project is a backend API for an online store, developed using the Symfony/Api Platform PHP framework with MySQL as database, Redis as cache service and RabbitMQ as message broker and Docker Compose. It is designed to provide all necessary functionalities for managing a digital store including product listings, user accounts, and order processing.
*almost finished*
## Features

## Features

- **Browsing Products**:
- **Ordering Products**: 
- **User Authentication**: 
- **User Registration**: 

## Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

- Docker
- Docker Compose
- PHP 8.x
- Composer

### Installation

1. Clone the repository:
   ```sh
   https://github.com/BigMop13/shop.git
2. Use Docker Compose to build and run the containers:
   ```sh
   docker compose up -d
3. Install the project dependencies:
   ```sh
    docker exec -it php composer install
4. Create the database schema:
    ```sh
   docker exec -it php bin/console doctrine:database:create
    docker exec -it php bin/console doctrine:migrations:migrate