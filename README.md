IUT-MP-PHP
==========

A Symfony project created by MarvinLockwood, axellebot.

[Site officiel symfony.com](http://symfony.com/)

#Install
##For devs
* clone the project
* install composer
* run "composer install"
* create "symfony" database 
* generate all table with Doctrine : "php bin/console doctrine:schema:update --force"

##To deploy Production
###On Apache 2 :
* create your database for the application
* follow the official tuto [here](http://symfony.com/doc/current/cookbook/deployment/tools.html)
* generate all tables : run "php bin/console doctrine:schema:update --force"
* made redirection on "web" directory 
* change access to the project directory : run "sudo setfacl -dR -m u:www-data:rwX path_of_directory"
* run "sudo a2enmod rewrite"
* restart apache "sudo service apache2 restart"

(or [other tutorial here](https://www.digitalocean.com/community/tutorials/how-to-deploy-a-symfony-application-to-production-on-ubuntu-14-04))

#Debriefing
Link [here](https://drive.google.com/open?id=0B9IaJWWo5LxfWWFqVlBkemw4QlE)

#Example
Deployed on :

* [lebot.xyz](qcm.lebot.xyz)

##Try as :
* Admin :
  * login : admin
  * password : admin
* Professor :
  * login : prof
  * password : prof
* Student :
  * login : eleve
  * password : eleve
