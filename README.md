IUT-MP-PHP
==========

A Symfony project created by MarvinLockwood, axellebot.

#Install
##For devs
* clone the project
* install composer
* run "composer install"
* create "symfony" database 
* generate all table with Doctrine : "php bin/console doctrine:schema:update --force"

##To deploy Production
###On Apache 2
- follow the official tuto : http://symfony.com/doc/current/cookbook/deployment/tools.html
- made redirection on "web" directory :
- change access to the project directory : run "sudo setfacl -dR -m u:www-data:rwX path_of_directory"
- run "sudo a2enmod rewrite"
- restart apache "sudo service apache2 restart"
(or https://www.digitalocean.com/community/tutorials/how-to-deploy-a-symfony-application-to-production-on-ubuntu-14-04)

Lien du dossier du projet : https://drive.google.com/open?id=0B9IaJWWo5LxfWWFqVlBkemw4QlE
