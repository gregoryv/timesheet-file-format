all: test

test:
	php vendor/bin/phpunit --bootstrap vendor/autoload.php --coverage-clover build/logs/clover.xml tests

coverage:
	./vendor/bin/phpunit --bootstrap vendor/autoload.php --coverage-html build/coverage tests

api:
	apigen generate --source src --destination build/api

pages: api
	mv build/api api.bak
	git checkout gh-pages
	rm -rf api
	mv api.bak api
