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


#### creation de formulairre symfony register
composer require symfony/form

#### création de login
symfony console make:auth
faire les modification necessaire

#### insere des photo

composer require vich/uploader-bundle

veuillez a bien ecrire le code de l'entité
use Vich\UploaderBundle\Form\Type\VichImageType;

class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // ...

        $builder->add('imageFile', VichImageType::class, [
            'required' => false,
            'allow_delete' => true,
            'delete_label' => '...',
            'download_label' => '...',
            'download_uri' => true,
            'image_uri' => true,
            'imagine_pattern' => '...',
            'asset_helper' => true,
        ]);
    }
}
