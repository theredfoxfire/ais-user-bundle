## ais-user-bundle
user Bundle For AIS. I use Symfony 2.7.4 in my kit. In case if you want to install Symfony follow the URL below:

[Symfony 2.7](http://symfony.com/doc/2.7/book/installation.html)


### Usage

I assume you already have composer on your dev environment. If not, please visit this URL:


[Getting started with Composer](https://getcomposer.org/doc/00-intro.md)


Add the following inside require tag in your root composer.json file:

```json
{
    "require": {
      "ais/userbundle" : "dev-master"
    },
}
```
Run composer update, and wait until composer update is finished.
```
php composer.phar update
```
Registering the bundle into your AppKernel.php 

Once the composer update is finished. If you not yet install NelmioApiDocBundle before, you need registering it too. 

Because this bundle require NelmioApiDocBundle to see the API doc. I also use JMS Serializer and FOSRestBundle.

```php
<?php
// app/AppKernel.php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
        ...
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Ais\UserBundle\AisUserBundle(),
        );
        ...

        return $bundles;
    }
}
```

Import the route to your app/config/routing.yml

```yaml
  ais_users:
    type: rest
    prefix: /api
    resource: "@AisUserBundle/Resources/config/routes.yml"
  
  NelmioApiDocBundle:
    resource: "@NelmioApiDocBundle/Resources/config/routing.yml"
    prefix:   /api/doc
```

### See what in the inside
Now you may see the available API by access your url dev

```
ex: http://localhost/web/app_dev.php/api/doc
```

### Want to join for developing this API?
user Bundle For AIS. I use Symfony 2.7.4 in my kit. In case if you want to install Symfony follow the URL below:

[Symfony 2.7](http://symfony.com/doc/2.7/book/installation.html)

Once we finished on installing Symfony 2.7.4 go to our `src/` then run `git clone https://github.com/theredfoxfire/ais-user-bundle.git Ais/UserBundle`. Go to to `Ais/UserBundle` open `Ais/UserBundle/composer.json`, and copy all require and require-dev block and replace to root `composer.json`

```json
#Ais/UserBundle/composer.json
    "require": {
        "php": ">=5.3.9",
        "symfony/symfony": "2.7.*",
        "doctrine/orm": "^2.4.8",
        "doctrine/doctrine-bundle": "~1.4",
        "symfony/assetic-bundle": "~2.3",
        "symfony/swiftmailer-bundle": "~2.3",
        "symfony/monolog-bundle": "~2.4",
        "sensio/distribution-bundle": "~4.0",
        "sensio/framework-extra-bundle": "^3.0.2",
        "incenteev/composer-parameter-handler": "~2.0",
		    "ircmaxell/password-compat"            : "~1.0",
        "leafo/scssphp"                        : "~0.1.5",
        "patchwork/jsqueeze"                   : "~1.0",
        "friendsofsymfony/rest-bundle": "@dev",
        "jms/serializer-bundle": "@dev",
        "willdurand/rest-extra-bundle": "@dev",
        "nelmio/api-doc-bundle": "@dev",
        "friendsofsymfony/oauth-server-bundle": "1.4.2"
    },
    "require-dev": {
        "sensio/generator-bundle": "~2.3",
        "symfony/phpunit-bridge": "~2.7",
        "doctrine/doctrine-fixtures-bundle": "^2.3",
        "phpunit/phpunit": "3.7.*",
        "liip/functional-test-bundle":"dev-master",
        "guzzle/plugin": "3.7.*"
    },
```
```json
#in the root app dir composer.json
    "require": {
        "php": ">=5.3.9",
        "symfony/symfony": "2.7.*",
        "doctrine/orm": "^2.4.8",
        "doctrine/doctrine-bundle": "~1.4",
        "symfony/assetic-bundle": "~2.3",
        "symfony/swiftmailer-bundle": "~2.3",
        "symfony/monolog-bundle": "~2.4",
        "sensio/distribution-bundle": "~4.0",
        "sensio/framework-extra-bundle": "^3.0.2",
        "incenteev/composer-parameter-handler": "~2.0",
		    "ircmaxell/password-compat"            : "~1.0",
        "leafo/scssphp"                        : "~0.1.5",
        "patchwork/jsqueeze"                   : "~1.0",
        "friendsofsymfony/rest-bundle": "@dev",
        "jms/serializer-bundle": "@dev",
        "willdurand/rest-extra-bundle": "@dev",
        "nelmio/api-doc-bundle": "@dev",
        "friendsofsymfony/oauth-server-bundle": "1.4.2"
    },
    "require-dev": {
        "sensio/generator-bundle": "~2.3",
        "symfony/phpunit-bridge": "~2.7",
        "doctrine/doctrine-fixtures-bundle": "^2.3",
        "phpunit/phpunit": "3.7.*",
        "liip/functional-test-bundle":"dev-master",
        "guzzle/plugin": "3.7.*"
    },

```
then run `php composer.phar update` to update the dependencies.

Configuring AppKernel.php, app/config/security.yml, and app/config/config.yml.

[my AppKernel.php](https://gist.github.com/theredfoxfire/434a10f1c6892668551ded99c7dce0c1)

[my security.yml](https://gist.github.com/theredfoxfire/0d3a66378762ccaf361ef0134385ff6e)

[my config.yml](https://gist.github.com/theredfoxfire/f52a5a62d2abd84f93df69f6bd4c67ef)

Update the `app/config/parameters.yml`

```yml
# This file is auto-generated during the composer install
parameters:
    database_host: your-db-host
    database_port: your-db-port
    database_name: your-db-name
    database_user: your-db-user
    database_password: your-db-pass
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: [your-secret-key]
```

Build the DB structure.

```text

your-app-directory$ php app/console doctrine:database:create

your-app-directory$ php app/console doctrine:schema:update --force

your-app-directory$ php app/console doctrine:fixtures:load

```

### Ready To Deploy!

Find a typo? just ask me for PR. If you find some error please help me to fix it by email me to vizzlearn@gmail.com
