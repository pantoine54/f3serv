# f3serv

Ce projet est une démo pour présenter mes compétences en programmation.

## Technologies utilisées

- HTML
- CSS
- PHP

## Installation

1. Clonez ce dépôt : `git clone https://github.com/phantoine/f3serv
2. Ouvrez index.php dans votre navigateur.

## Auteur

Philippe ANTOINE - phantoine@etik.com
Mini serveur de fichier écrit avec Fat Free Framework et pure Css
Ce serveur permet de charger un fichier dans le répertoire files (menu Télécharger) et permet de le récupérer sur une autre machine (menu Fichiers) en cliquanr sur le nom du fichier. Il est possible également de le supprimer du répertoire "files" une fois le téléchargment réalisé.

L'authentification se fait depuis une base de type fichier (driver Jig) contenu dans le fichier Users du répertoire data.
Le fichier putuse.php permet de modifier le mot de passe qui est codé en md5 dans le fichier Users. Par défaut le login est "admin" et le mot de passe est "123". Il suffit de modifier le fichier putuse.php en modifiant le mot de passe et de lancer putuse.php.

Le framework f3 (fat free framework) peut être chargé à l'aide de composer avec la commande:
composer require bcosca/fatfree-core
Les différentes librairies sont alors installées dans le répertoire "vendor".
