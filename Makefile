.PHONY: deploy
.PHONY: php php-composer
.PHONY: php-laminas php-laravel php-lumen php-nette-tracy php-phalcon php-satis php-slim php-symfony-micro1 php-symfony-micro2

deploy:
	cd ${PROJECT} && vc -c -n ${PROJECT} -S xorg ${NOW}

deploy-all:
	$(MAKE) cache
	$(MAKE) php
	$(MAKE) php-composer
	$(MAKE) php-laminas
	$(MAKE) php-laravel
	$(MAKE) php-lumen
	$(MAKE) php-nette-tracy
	$(MAKE) php-phalcon
	$(MAKE) php-satis
	$(MAKE) php-slim
	$(MAKE) php-sqlite
	$(MAKE) php-symfony-micro1
	$(MAKE) php-symfony-micro2

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

php-laminas:
	PROJECT=php-laminas $(MAKE) deploy

php-laravel:
	PROJECT=php-laravel $(MAKE) deploy

php-lumen:
	PROJECT=php-lumen $(MAKE) deploy

php-nette-tracy:
	PROJECT=php-nette-tracy $(MAKE) deploy

php-phalcon:
	PROJECT=php-phalcon $(MAKE) deploy

php-satis:
	PROJECT=php-satis $(MAKE) deploy

php-slim:
	PROJECT=php-slim $(MAKE) deploy

php-sqlite:
	PROJECT=php-sqlite $(MAKE) deploy

php-symfony-micro1:
	PROJECT=php-symfony-micro1 $(MAKE) deploy

php-symfony-micro2:
	PROJECT=php-symfony-micro2 $(MAKE) deploy
