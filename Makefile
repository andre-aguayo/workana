copy_env:
	cp ./.env.example ./.env

core_install:
	cd ./core && composer install && cd ../

frontend_install:
	cd ./frontend && yarn install && cd ../

up_containers:
	docker compose up -d

fast_install:
	make copy_env
	make core_install 
	make frontend_install 
	make up_containers

run_tests:
	./core/vendor/bin/phpunit  ./core/Tests 
