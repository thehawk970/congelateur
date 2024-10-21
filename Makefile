
.PHONY: predeploy
pre-deploy:
	php bin/console db-tools:backup;
	mkdir -p var/{cache, log};
	chmod -R 0777 var;
	@echo "Pre-deploy done";


.PHONY: post-deploy
post-deploy:
	chmod -R 0777 var;
	bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration --all-or-nothing
	bin/console cache:clear --env=prod
	bin/console cache:warmup --env=prod
	bin/console asset-map:compile
	@echo "Post-deploy done";

cs:
	php vendor/bin/php-cs-fixer fix

qa:
	php vendor/bin/rector process src
	php vendor/bin/phpstan analyse

lint:
	php bin/console lint:yaml config
	php bin/console lint:twig templates
	php bin/console lint:container




