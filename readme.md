## creation nouveau projet

composer create-project symfony/skeleton:"6.2.*" ecom
cd ecom
composer require webapp

## Add git

Ajout du Git 
git init ...
ajout des contributors

## Npm install
Ajout de npm pour encore

composer require symfony/webpack-encore-bundle

npm install

npm install @symfony/webpack-encore --save-dev

## Default Controller
creation default controller
template création pour modifier afficher



## Base de donnée

Création de la base de donnée
php bin/console doctrine:database:create

## User et conection

composer require symfony/security-bundle

php bin/console make:user
 The name of the security user class (e.g. User) [User]:
 > User

 Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
 > yes

 Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
 > email

 Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).

 Does this app need to hash/check user passwords? (yes/no) [yes]:
 > yes

 php bin/console make:migration
 php bin/console doctrine:migrations:migrate

 composer require symfonycasts/verify-email-bundle

 composer require --dev symfony/profiler-pack

 php bin/console make:controller Login  

 A REVOIR POUR UTILISATION AVEC RETOUR DE MAIL

 ### mailer 
 composer require symfony/mailer


## Création Entité

php bin/console make:entity


php bin/console make:migration
php bin/console doctrine:migrations:migrate

### restaurant
    name
    cp


## Git Clone
git clone + le nom du projet.
composer install

composer require symfony/webpack-encore-bundle
npm install
npm install @symfony/webpack-encore --save-dev

php bin/console doctrine:database:create