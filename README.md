# Installation and configuration

## Install Symfony 3.2 et get the bundle here
Get the Jmn/ProductBundle and put it in the bundles repository in the vendor
vendor/bundles/Jmn/ProductBundle

## Add JmnProductBundle to your application kernel

``` php
<?php

  // app/AppKernel.php
  public function registerBundles()
  {
    return array(
      // ...
      new Jmn\ProductBundle\JmnProductBundle(),
      // ...
      );
  }
```

## Register the namespace

``` php
<?php

  // app/autoload.php
  $loader->registerNamespaces(array(
      'Jmn' => __DIR__.'/../vendor/bundles',
      // your other namespaces
      ));
```

## Update the database

Assuming you are working with Dcotrine 2 for Symfony 3.2 you need to update your schema as follows:

### Confirm the schema needs update
``` 
bin/console doctrine:schema:update
```

### Update the schema 
``` 
bin/console doctrine:schema:update --force
```
### Publish the assets 
``` 
bin/console assets:install web
```

## Routing

Register the routing in app/config/routing.yml

jmn_product:
    resource: "@JmnProductBundle/Resources/config/routing.yml"
    prefix: /

## Translations

Modify the file app/config/config.yml in adding this line :  translator:      { fallbacks: ['%locale%'] }

framework:
   ...
    translator:      { fallbacks: ['%locale%'] }
   ...
