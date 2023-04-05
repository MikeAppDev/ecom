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

npm run dev

### Utiliser SASS

* npm install sass-loader@^13.0.0 sass --save-dev
* Modifier la configuration dans le fichier *webpack.config.js* à la racine du projet (décommenter la ligne "enableSassLoader" pour compiler le sass)
* Dans le fichier *assets/app.js*, changer l'import et importer un fichier *app.scss*
* Dans le dossiers assets, créer un fichier *app.scss* avec votre SASS

## Default Controller
creation default controller
template création pour modifier afficher



## Base de donnée

Création de la base de donnée
php bin/console doctrine:database:create

## serveur
php -S localhost:8000 -t public/


## User et conection

composer require symfony/security-bundle

### make:User
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

### Make Auth
 php bin/console make:auth

What style of authentication do you want? [Empty authenticator]:
 [0] Empty authenticator
 [1] Login form authenticator
> 0

The class name of the authenticator to create (e.g. AppCustomAuthenticator):
> LoginFormAuthenticator

Choose a name for the controller class (e.g. SecurityController) [SecurityController]:
> SecurityController

Do you want to generate a '/logout' URL? (yes/no) [yes]:
> yes

 created: src/Security/LoginFormAuthenticator.php
 updated: config/packages/security.yaml
 created: src/Controller/SecurityController.php
 created: templates/security/login.html.twig

#### pour vérifier email a tester ????
 composer require symfonycasts/verify-email-bundle

 composer require --dev symfony/profiler-pack

 <!-- php bin/console make:controller Login   -->

 A REVOIR POUR UTILISATION AVEC RETOUR DE MAIL

 ## mailer 

  composer require symfony/mailer


### MailTrap
 https://mailtrap.io/blog/send-emails-in-symfony/



## Création Entité

php bin/console make:entity


php bin/console make:migration
php bin/console doctrine:migrations:migrate

### restaurant
    name
    cp

## Creation restaurant Controler

php bin/console make:controller
ceci génère automatiquement un template


## Git Clone Recup projet
git clone + le nom du projet.
composer install

composer require symfony/webpack-encore-bundle
npm install
npm install @symfony/webpack-encore --save-dev

php bin/console doctrine:database:create