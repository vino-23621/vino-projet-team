# Projet Web 2 : Gestion de cave à vin

## Description

Ce projet a pour objectif le développement et la bonification d’une application web transactionnelle de gestion de cave à vin, répondant aux besoins d’un client.  
En équipe de 3 à 5 personnes, nous poursuivons le développement de cette solution à partir d’un devis détaillé présentant les exigences fonctionnelles et techniques, ainsi que des items de backlog.

Le site est conçu pour être compatible avec les principales plateformes (Mac, PC, Android, iOS) et les navigateurs modernes (Edge, Chrome, Firefox, Safari).  
Le suivi du projet et sa réalisation s’appuient sur les principes AGILE/SCRUM, l’utilisation de Git pour la gestion de code et le travail collaboratif à distance.

## Stack technologique

- **Laravel** (Backend et logique applicative)
- **JavaScript Vanilla** (Interactions dynamiques côté client)
- **CSS Vanilla** (Mise en forme et design responsive)

## Objectifs principaux

- Permettre aux utilisateurs de gérer facilement leur collection de vins (ajout, modification, suppression, consultation)
- Offrir une interface conviviale et moderne
- Assurer la compatibilité multiplateforme et multidevice
- Mettre en œuvre un processus de développement agile et collaboratif

## Équipe de développement

- [Patricia](https://github.com/patrihow)
- [Juan](https://github.com/juahzm)
- [Amir](https://github.com/Amir-nkn)
- [Marc-Olivier](https://github.com/marcbab01)
- [Mathieu](https://github.com/TekGeekdev)

## Liens et ressources

- **Jira (Suivi du backlog et des sprints) :**  
  [Consulter le tableau Jira](https://mledeurpro.atlassian.net/jira/software/projects/VC/boards/35/backlog?selectedIssue=VC-81&atlOrigin=eyJpIjoiOWViZjI5YjRmZTE0NDBmZTgzY2QyZDNkZDIzY2VlNWEiLCJwIjoiaiJ9)

- **Figma (Wireframes et maquettes) :**  
  [Accéder aux wireframes Figma](https://www.figma.com/design/zI2qs2UFT3FLhqtUoLZk1p/Wireframes?node-id=6-57&t=7RboUvMxFl4pQnHm-1)

## Installation du projet

### Prérequis

- PHP >= 8.x
- Composer
- Base de données MySQL/MariaDB

### Étapes d’installation

1. **Cloner le dépôt**

   ```bash
   git clone https://github.com/votre-organisme-ou-utilisateur/nom-du-repo.git
   cd nom-du-repo
   ```

2. **Installer les dépendances PHP**

   ```bash
   composer install
   ```

3. **Configurer l’environnement**

   Copier le fichier `.env.example` en `.env` puis modifier les variables selon votre configuration (base de données, mail, etc.)

   ```bash
   cp .env.example .env
   ```

4. **Générer la clé d’application**

   ```bash
   php artisan key:generate
   ```

5. **Lancer les migrations**

   ```bash
   php artisan migrate
   ```

6. **Démarrer le serveur de développement**

   ```bash
   php artisan serve
   ```
