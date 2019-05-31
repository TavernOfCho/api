#!/bin/sh

php bin/console doctrine:schema:update --force --no-interaction
php bin/console fos:elastica:populate
