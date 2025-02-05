cs:
	php vendor/bin/php-cs-fixer fix

qa:
	php vendor/bin/rector process src
	php vendor/bin/phpstan analyse

lint:
	php bin/console lint:yaml config
	php bin/console lint:twig templates
	php bin/console lint:container


db-restore:
	bin/console db-tools:restore --yes-i-am-sure-of-what-i-am-doing

