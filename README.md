# Mefolio – Plateforme de Portfolio pour Créatifs

## À propos du projet

**Mefolio** est une plateforme web conçue pour permettre aux créatifs (développeurs, designers, étudiants, artistes…) de :

* Créer un **profil professionnel en ligne**
* **Partager leurs projets**
* **Recevoir des commentaires**
* **Découvrir et explorer** les réalisations d'autres utilisateurs
* **Trouver et publier des missions freelance**
* **Participer à des challenges et découvrir des programmes d'accompagnement africains**

L'objectif est de valoriser les talents et favoriser une communauté active autour de la création.

---

## Fonctionnalités principales

### Fonctionnalités implémentées

* Authentification (inscription / connexion) avec Laravel Breeze
* Gestion de profil utilisateur et de profil créatif (photo, bio, informations, disponibilité)
* Publication de projets (titre, description, catégorie, technologies, liens, médias)
* Système de likes et de commentaires (avec réponses) sur les projets
* Classement des créatifs (Builder Score)
* Missions freelance : publication, candidature, gestion des candidatures
* Challenges créatifs : publication et participation
* Programmes & hackathons référencés (ASSIN, Sèmè City, etc.)
* Blog piloté par une base de données
* Talent of the Week et nominations de talents
* Newsletter
* Espace administrateur complet (utilisateurs, créatifs, projets, commentaires, blog, missions,
  challenges, programmes, mises en avant, nominations, newsletter)
* Interface moderne avec Tailwind CSS
* Design responsive (mobile, tablette, desktop)

### Fonctionnalités à venir

* Intégration réelle des paiements Mobile Money
* Notifications en temps réel
* Recherche avancée multi-critères
* Suivi d'utilisateurs

---

## Technologies utilisées

* Backend : Laravel
* Frontend : Tailwind CSS, JavaScript (Vite)
* Base de données : MySQL (local) / PostgreSQL (production)
* Authentification : Laravel Breeze

---

## Installation en local

### 1. Cloner le projet

```bash
git clone https://github.com/rolnelh/mefolio.git
cd mefolio
```

---

### 2. Installer les dépendances

```bash
composer install
npm install
```

---

### 3. Générer la clé de l'application

```bash
php artisan key:generate
```

---

### 4. Lancer les migrations

```bash
php artisan migrate --seed
```

Le seeder crée un compte administrateur par défaut (voir `database/seeders/DatabaseSeeder.php`).

---

### 5. Lancer le projet

```bash
php artisan serve
npm run dev
```

---

## Déploiement

* Build automatisé via GitHub

---

## Aperçu

<img width="1368" height="768" alt="mefolio-deskop" src="https://github.com/user-attachments/assets/ce0e2b9d-6a6c-43c6-b312-536cb729f006" />

---

## Ce que j'ai appris

Ce projet m'a permis de :

* Structurer une application complète avec Laravel
* Gérer l'authentification et les relations entre modèles
* Concevoir une interface moderne et responsive
* Déployer une application en production (Render + PostgreSQL)

---

## Contribution

Les contributions sont les bienvenues !
N'hésite pas à ouvrir une issue ou proposer une pull request.

---

## Contact

Développeur : **Houndagnon Dieudonné**
Email : houndagnondieudonne4@gmail.com
LinkedIn : [(ton profil)](https://www.linkedin.com/in/dieudonn%C3%A9-houndagnon-093387250)

---

## Support

Si tu aimes ce projet, n'hésite pas à laisser une étoile sur le repo !
