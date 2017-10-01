up:
	cd laradock && docker-compose up -d nginx mysql redis workspace

down:
	cd laradock && docker-compose down

restart: down up

bash:
	cd laradock && docker-compose exec workspace bash
