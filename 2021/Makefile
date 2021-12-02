.PHONY: test lint lint.php-cs-fixer lint.phpstan

test:
	vendor/bin/phpunit

lint: lint.php-cs-fixer lint.phpstan

lint.php-cs-fixer: export PHP_CS_FIXER_IGNORE_ENV=1
lint.php-cs-fixer:
	vendor/bin/php-cs-fixer fix

lint.phpstan:
	vendor/bin/phpstan
