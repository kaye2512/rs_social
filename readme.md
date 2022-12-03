# kaye

## Environnement de développement

DATABASE_URL="mysql://database:mdp@127.0.0.1:3306/rs_social"
### Pré-requis

- PHP 7.4
- Composer
- Symphony CLI


vous pouvez verifier les pré-requis

***bash
symfony check:requirements
***

### Lancer l'environnement de développement 

***bash
symfony server:start


### Creation des entité dans la base

***bash
symfony console make:entity

symfony console make:migration

symfony console doctrine:migrations:migrate

#### des dependence
****bash
composer require symfony/webpack-encore-bundle


#### installer bootstrap
npm install bootstrap --save-dev
npm install jquery @popperjs/core --save-dev

npm run watch

#### creer un controller
symfony console make:controller nomducontroller


##### configure app.js

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');