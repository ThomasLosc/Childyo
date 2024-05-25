# Childyo

## Introduction

Childyo est une application conçue pour simplifier la gestion des rendez-vous médicaux pour les parents et les tuteurs d'enfants. Cette plateforme conviviale permet d'organiser les soins de santé des enfants de manière efficace et pratique.

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- Node.js et Yarn
- MySQL

## Installation

Suivez ces étapes pour configurer et lancer le projet :

### 1. Récupération du projet

Clonez le dépôt de projet sur votre machine locale :

```bash
git clone https://github.com/ThomasLosc/Childyo.git
cd Childyo
```

### 2. Installation des dépendances PHP

```bash
composer install
```

### 3. Installation des dépendances JavaScript

```bash
yarn install
```

### 4. Configuration de l'environnement

Créez un fichier .env.dev.local à la racine du projet et configurez votre base de données et votre DSN de mailer.

Note : Pour les mails, vous pouvez utiliser Mailtrap. Créez un compte et allez dans "Email Testing" -> "Inboxes" -> "My Inbox".
Sélectionnez symfony + 5 à droite et copiez les informations de connexion.

DATABASE_URL=""
MAILER_DSN=""

### 5. Création de la base de donnée

```php
php bin/console d:d:c
```

### 6. Exécuter la migration

php bin/console make:migration

### 7. Lancer le serveur de développement

```php
symfony server:start
```

Une fois le serveur démarré, vous pouvez accéder à l'application dans votre navigateur à l'adresse suivante : http://127.0.0.1:8000

## Ressources

[Symfony](https://symfony.com/)
[Mailtrap](https://mailtrap.io/)
