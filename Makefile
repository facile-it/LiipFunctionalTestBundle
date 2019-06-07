pre-commit-check: code-style-fix phpstan test

phpstan:
	@vendor/bin/phpstan analyse

code-style-fix:
	@vendor/bin/php-cs-fixer fix --verbose --ansi

test:
	@vendor/bin/phpunit

test-stop-on-failure:
	@vendor/bin/phpunit --stop-on-failure
