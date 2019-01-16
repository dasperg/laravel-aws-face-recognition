#!/usr/bin/env bash
if [ ! -d "laradock" ]; then
  # Control will enter here if $DIRECTORY doesn't exist.
  git submodule add https://github.com/Laradock/laradock.git
  cp .env.laradock ./laradock/.env
  cp docker-compose-laradock.yml ./laradock/docker-compose.yml
fi
cd laradock
docker-compose up
docker-compose exec workspace composer install
docker-compose exec workspace php artisan migrate
