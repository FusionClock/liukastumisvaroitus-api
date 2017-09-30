up:
	cd laradock && docker-compose up -d nginx mysql redis

down:
	cd laradock && docker-compose down

restart: down up

bash:
	cd laradock && docker-compose exec workspace bash
