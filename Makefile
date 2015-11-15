all: test

test:
	php vendor/bin/phpunit --coverage-clover build/logs/clover.xml

coverage:
	./vendor/bin/phpunit --coverage-html build/coverage

api:
	apigen generate --source src --destination build/api

clean:
	rm -rf build

pages: clean api
	git checkout gh-pages
	rm -rf api
	mv build/api api
