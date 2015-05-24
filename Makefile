all: test

test:
	php vendor/bin/phpunit --bootstrap vendor/autoload.php tests

api:
	apigen generate --source src --destination api

pages: api
	mv api api.bak
	git checkout gh-pages
	rm -rf api
	mv api.bak api
