# TomTroc
## Gestion projet soutenance TomTroc échange de livres.

### Le site a été developpé en PHP et MySQL et il est responsive.

>Vous trouverez ci-dessous les instructions pour installer le projet sur votre serveur.
ne pas oublier de modifier le fichier de configuration.
> Vous pouvez aussi vous connecter au GitHub en cliquant sur le lien suivant :
> https://github.com/belethan/TomTroc

Pour commencer nous allons installer la base de données MYSQL Version 8.4.4.
L' utilisateur principal pour MYSQL est root avec root en mot de passe, il est conseillé de modifier.
Attention, il faut aussi modifier dans le fichier **config.php** dans le dossier __*php/config*__ pour la connexion à la base de données.
en ligne de commande faire :
mysql -u root -p TOMTROC < backuptomtroc.sql

Une fois la base de données est installée, vous pouvez installer le projet.
(peut être que vous devrez configurer le serveur web pour que le projet puisse fonctionner
pour cela modifier le fichier .htaccess ou httpd-vhosts.conf 
Exemple :
```
<VirtualHost *:80>
ServerName tomtroc.local
DocumentRoot "/Users/tonuser/Sites/tomtroc"
<Directory "/Users/tonuser/Sites/tomtroc">
Options Indexes FollowSymLinks
AllowOverride All
Require all granted
</Directory>
</VirtualHost>
```

copiez le dossier php dans le dossier web de votre serveur et vous pourrez lancer le projet et arriver sur la page d'accueil.

Exemple :http://localhost/public/index.php

la base est préremplie avec des livres. vous pourrez accéder au menu "Nos livres à l'échange".
Pour vous connecter, vous pouvez utiliser les identifiants suivants :
ludo@free.fr - ludo9729


