build:
	poetry version $(version)
	poetry build

publish:
	poetry publish -u $(user) -p $(pass)

build-publish: build publish
