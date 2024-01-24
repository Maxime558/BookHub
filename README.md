# Nom de Votre Projet

## Description

Ce projet est une application web développée avec Symfony permettant de gérer un catalogue de livres. Les fonctionnalités principales incluent l'affichage des livres, l'emprunt de livres par les utilisateurs, et la gestion des dates de rendu.

## Fonctionnalités

- Affichage des livres avec détails.
- Emprunt de livres par les utilisateurs.
- Affichage des utilisateurs et gestion des prêts.
- Gestion des dates de rendu.

## Technologies Utilisées

- Symfony: Framework PHP utilisé pour le développement de l'application.
- Twig: Moteur de template utilisé pour la gestion des vues.
- Doctrine: ORM utilisé pour interagir avec la base de données.
- EasyAdminBundle: Bundle utilisé pour créer une interface d'administration conviviale.

## Installation

Clonez le dépôt Git :

```bash
git clone https://github.com/votre-utilisateur/votre-projet.git
```
Installez les dépendances :

```bash
composer install
```

### Configurez la base de données :


```bash
php bin/console doctrine:database:create
```
```bash
php bin/console make:migration
```
```bash
php bin/console doctrine:migrations:migrate
```

### Lancez le serveur de développement :

```bash
symfony server:start
```

- Accédez à l'application dans votre navigateur à l'adresse http://localhost:8000.


### Configuration
Assurez-vous de configurer correctement votre base de données dans le fichier .env et d'ajuster les paramètres de sécurité selon vos besoins.

### Utilisation
- Connectez-vous à l'application en tant qu'administrateur.
- Explorez le catalogue de livres et gérez les emprunts.
- Vérifiez la gestion des dates de rendu.

- Si vous souhaitez contribuer à ce projet, veuillez ouvrir une issue ou soumettre une demande de tirage avec vos modifications.

Auteur :
[Maxime558](https://github.com/Maxime558)

Licence
Ce projet est sous licence [Creative Commons](LICENCE)