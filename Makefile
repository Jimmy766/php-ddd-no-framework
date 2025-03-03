up:
	docker-compose up -d --build

down:
	docker-compose down

logs:
	docker-compose logs -f

bash-php:
	docker-compose exec php bash

bash-db:
	docker-compose exec db bash

test:
	docker-compose exec php ./vendor/bin/phpunit