#!/bin/bash

DOCKER_ENV=''
DOCKER_TAG=''

case "$TRAVIS_BRANCH" in
   "master")
       DOCKER_ENV=production
       DOCKER_TAG=latest
     ;;
    "dev")
       DOCKER_ENV=dev
       DOCKER_TAG=dev
     ;;
esac

docker login -u "$DOCKER_USERNAME" --password-stdin "$DOCKER_PASSWORD"

docker build -f ./Dockerfile -t car-rental:$DOCKER_TAG . --no-cache
docker tag  car-rental:$DOCKER_TAG $DOCKER_USERNAME/car-rental:$DOCKER_TAG
docker push $DOCKER_USERNAME/car-rental:$DOCKER_TAG

echo "DONE!"
