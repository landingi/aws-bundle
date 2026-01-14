ci:
	composer validate
	vendor/bin/phpunit --testsuite all
	vendor/bin/phpstan analyze -c phpstan.neon --memory-limit=256M
	vendor/bin/ecs check
fix:
	vendor/bin/ecs check --fix
run:
	composer install --no-interaction --prefer-dist
