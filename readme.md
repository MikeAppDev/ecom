## creation nouveau projet ##

composer create-project symfony/skeleton:"6.2.*" ecom
cd ecom
composer require webapp

## Add git

Ajout du Git 
git init ...
ajout des contributors

## Npm install
Ajout de npm pour encore

## Default Controller
creation default controller
template création pour modifier afficher

## Base de donnée

Création de la base de donnée
php bin/console doctrine:database:create

## Création Entité

php bin/console make:entity


php bin/console make:migration 
php bin/console doctrine:migrations:migrate

