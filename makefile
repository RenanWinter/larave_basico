include .env

db-ip:
	docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' laravel1-db

app-run:
	docker exec -i -t laravel1-app /bin/bash

db-run:
	docker exec -i -t laravel1-db /bin/bash

nginx-run:
	docker exec -i -t larave1-nginx /bin/bash
