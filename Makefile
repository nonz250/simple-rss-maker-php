.PHONY: setup
setup:
	cp docker-compose.yml.example docker-compose.yml && \
	docker-compose build && \
	docker-compose run --rm composer setup

.PHONY: test
test:
	docker-compose exec php php -version && \
	docker-compose exec php php-cs-fixer fix && \
	docker-compose exec php ./vendor/bin/phpunit

.PHONY: prod
prod:
	docker-compose exec php php -version && \
	docker-compose exec php php-cs-fixer fix -vv && \
	docker-compose exec php ./vendor/bin/phpunit --coverage-text

.PHONY: fix
fix:
	docker-compose exec php php -version && \
	docker-compose exec php php-cs-fixer fix
