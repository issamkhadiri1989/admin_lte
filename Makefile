install: build recreate composer-install assets-install

assets-install: npm-install encore

encore:
	docker compose exec www npm run dev

npm-install:
	docker compose exec www npm install

build:
	docker compose build

recreate:
	docker compose up -d --force-recreate

composer-install:
	docker compose exec www composer install

enter:
	docker compose exec www bash
	
start:
	docker compose start

reload-apache:
	docker compose exec www service apache2 reload