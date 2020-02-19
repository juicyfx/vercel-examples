.PHONY: deploy
.PHONY: now-php now-php-composer
.PHONY: now-php-framework-lumen now-php-framework-nette now-php-framework-phalcon now-php-framework-slim now-php-framework-symfony-microservice

deploy:
	cd ${PROJECT} && now -c -n now-examples-${PROJECT} -S juicyfx

##################
# Basic examples #
##################

now-php:
	PROJECT=php $(MAKE) deploy

now-php-composer:
	PROJECT=php-composer $(MAKE) deploy

##################
# Basic examples #
##################

now-php-framework-lumen:
	PROJECT=php-framework-lumen $(MAKE) deploy

now-php-framework-nette:
	PROJECT=php-framework-nette $(MAKE) deploy

now-php-framework-phalcon:
	PROJECT=php-framework-phalcon $(MAKE) deploy

now-php-framework-slim:
	PROJECT=php-framework-slim $(MAKE) deploy

now-php-framework-symfony-microservice:
	PROJECT=php-framework-symfony-microservice $(MAKE) deploy
