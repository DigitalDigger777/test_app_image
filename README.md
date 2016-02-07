image_test_task
===============

##Install dependencies
composer install
bower install


##Assets install
./app/console assets:install

##Download test images
 wget -i src/ImageBundle/DataFixtures/ORM/images/source.txt -P src/ImageBundle/DataFixtures/ORM/images

##Create and init database 
 ./app/console doctrine:database:create
 ./app/console doctrine:schema:update --force
 ./app/console doctrine:fixtures:load