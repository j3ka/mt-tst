up: docker-up
down: docker-down
restart: docker-down docker-up
init: docker-down-clear docker-down docker-pull docker-build docker-up

docker-up:
	docker-compose up

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

