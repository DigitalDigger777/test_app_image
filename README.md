Test image application
===============

##Install dependencies
```sh
composer install && bower install
```
##Assets install

```sh
 ./app/console assets:install
```
##Download test images

```sh
 wget -i src/ImageBundle/DataFixtures/ORM/images/source.txt -P src/ImageBundle/DataFixtures/ORM/images
```
##Create and init database
 ```sh
 ./app/console doctrine:database:create
 ```  
 ```sh 
 ./app/console doctrine:schema:update --force
 ```  
 ```sh 
 ./app/console doctrine:fixtures:load
 ```  
 