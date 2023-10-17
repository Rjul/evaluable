# Installing from source

## Requirements
- php 8.2
- composer 2
- node 16
- extension php-pgsql

## Installation

```bash
git clone https://github.com/HummelJulien/evaluable.git
cd evaluable && \
docker-compose up -d && \
composer install && \
npm install && \
bin/console doctrine:migrations:migrate && \
npm run dev & symfony server:start
```

## Configuration

- Activate the extension php-pgsql

