.PHONY: deploy
.PHONY: php php-composer
.PHONY: php-laravel php-lumen php-nette-tracy php-phalcon php-slim php-symfony-microservice php-wordpress

deploy:
	cd ${PROJECT} && now -c -n ${PROJECT} -S xorg ${NOW}

deploy-all:
	$(MAKE) php
	$(MAKE) php-composer
	$(MAKE) php-laravel
	$(MAKE) php-lumen
	$(MAKE) php-nette-tracy
	$(MAKE) php-phalcon
	$(MAKE) php-slim
	$(MAKE) php-symfony-microservice
	$(MAKE) php-wordpress

##################
# Basic examples #
##################

php:
	PROJECT=php $(MAKE) deploy

php-composer:
	PROJECT=php-composer $(MAKE) deploy

##################
# Basic examples #
##################

php-lumen:
	PROJECT=php-lumen $(MAKE) deploy

php-nette-tracy:
	PROJECT=php-nette-tracy $(MAKE) deploy

php-phalcon:
	PROJECT=php-phalcon $(MAKE) deploy

php-slim:
	PROJECT=php-slim $(MAKE) deploy

php-symfony-microservice:
	PROJECT=php-symfony-microservice $(MAKE) deploy

php-wordpress:
	PROJECT=php-wordpress $(MAKE) deploy

php-laravel:
	PROJECT=php-laravel $(MAKE) deploy
