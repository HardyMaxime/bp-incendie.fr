# Définition d'une règle pour démarrer le serveur PHP
serve:
	php -S localhost:8000 -t web

coreupdate:
	php wp-cli.phar core update

pluginupdate:
	php wp-cli.phar plugin update --all