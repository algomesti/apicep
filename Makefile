up:
	docker build -t api-cep .

	docker run -d -p $(PORT_LOC):80 -p 6379:6379 --name=rpgal$(PORT_LOC) -v $(PWD)/src:/var/www/html/api-cep api-cep
	docker exec rpgal$(PORT_LOC) composer install --prefer-dist --working-dir=/var/www/html/api-cep
	docker exec rpgal$(PORT_LOC) redis-server --daemonize yes --protected-mode no
    
down:
	docker rm -f rpgal$(PORT_LOC)

