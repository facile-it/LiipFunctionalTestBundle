phpstan:
	@vendor/bin/phpstan analyse

code-style-fix:
	@vendor/bin/php-cs-fixer fix --verbose --ansi

tests:
	@vendor/bin/phpunit

pre-commit-check: code-style-fix phpstan tests
