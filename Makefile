# Détection de l'OS
UNAME_S := $(shell uname -s)

# Configuration de DOCKER en fonction de l'OS
ifeq ($(UNAME_S),Darwin) # macOS
    DOCKER = /Applications/Docker.app/Contents/Resources/bin/docker
else # Windows et Linux
    DOCKER = docker
endif

# Variables
DOCKER_COMPOSE = $(DOCKER) compose
EXEC = $(DOCKER) exec -w /var/www/
PHP = $(EXEC) php
COMPOSER = $(EXEC) composer

APACHE = www

# Colors
GREEN = /bin/echo -e "\x1b[32m\#\# $1\x1b[0m"
RED = /bin/echo -e "\x1b[31m\#\# $1\x1b[0m"

## —— 🐳 Docker ——

version: ## Show version
	$(DOCKER) --version
	@$(call GREEN,"Docker Compose version is up to date.")

build: ## Build app
	$(DOCKER_COMPOSE) build
	@$(call GREEN,"The containers are now built.")

start: ## Start app
	$(DOCKER_COMPOSE) up -d
	@$(call GREEN,"The containers are now started.")

down: ## Stop app
	$(DOCKER_COMPOSE) down
	@$(call RED,"The containers are now stopped.")

www: ## Execute a command
	$(DOCKER_COMPOSE) exec -it $(APACHE) bash

## —— 🎻 Composer ——

composer-install: ## Install dependencies
	$(COMPOSER) install

composer-update: ## Update dependencies
	$(COMPOSER) update

## —— 🐈 NPM —————————————————————————————————————————————————————————————————

npm-dev: ## Start npm watch
	$(DOCKER_COMPOSE) exec -it $(APACHE) bash -c "cd static && npm run dev"

## —— 🐘 WordPress ————————————————————————————————————————————————————————————

core-update: ## Update core
	$(EXEC) wp-cli.phar core update

plugin-update: ## Update all plugins
	$(EXEC) $(APACHE) wp-cli.phar plugin update --all
