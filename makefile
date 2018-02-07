up:
	cd laradock && docker-compose up -d nginx mysql redis workspace

down:
	cd laradock && docker-compose down

restart: down up

bash:
	cd laradock && docker-compose exec workspace bash

mysqldump:
	cd laradock && docker-compose exec mysql mysqldump -u default -psecret default > dump.sql
