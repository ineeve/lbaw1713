#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=ineeve # Replace by your docker hub username
IMAGE_NAME=lbaw1713

# Ensure that dependencies are available
composer install
php artisan clear-compiled
php artisan optimize

sudo docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
sudo docker push $DOCKER_USERNAME/$IMAGE_NAME
