# 🎬 projet\_progWeb\_GHAMAT – Site de Présentation de Films

**Note importante**
Veuillez utiliser les identifiants suivants pour accéder à la page de connexion et ajouter vos contenus favoris sur le site :

* **Adresse e-mail** : `admin@gmail.com`
* **Mot de passe** : `AsdfZxcv`


## 📝 À propos du projet

Ce site web a été développé dans le cadre du projet **PROGRAMMATION\_WEB2\_FILM\_PRESENTATION** à l’aide de l’IDE **Visual Studio Code (VS Code)**. Il propose une plateforme bilingue (français et anglais) pour présenter des films à travers une interface simple et interactive.


## 🌐 Fonctionnalités principales

Le site est structuré autour de plusieurs sections :

### 1. **Page d’accueil**

* Affiche une sélection de films.
* Présente les **titres** et une **brève description** de chaque film.

### 2. **Page de détails**

* Affiche des informations complémentaires sur chaque film :

  * **Année de production**
  * **Réalisateur**
  * **Langue du film**

### 3. **Page "À propos"**

* Contient une brève présentation du propriétaire du site.

### 4. **Section Administrateur**

* Interface dédiée à la gestion des contenus dynamiques du site.
* Permet d’ajouter, modifier ou supprimer des films via une interface sécurisée.


## 🛠️ Spécifications techniques

* **Base de données** : SQLite
* **Backend** : PHP, avec appels **AJAX** pour charger dynamiquement les données.
* **Interface utilisateur (IHM)** :

  * Développée en PHP.
  * Design **responsive**, compatible avec tous types d’écrans (desktop, tablette, mobile).
* **Sécurité** :

  * Tous les champs de saisie sont vérifiés pour éviter les **caractères spéciaux**.
  * Protection contre les **injections SQL** lors de la saisie des données par l’administrateur.


## 📦 Déploiement & Utilisation

1. Cloner le projet dans un serveur local (ex : XAMPP, WAMP).
2. Assurez-vous que la base de données SQLite est accessible.
3. Lancez le site via un navigateur en accédant à `index.php`.
4. Connectez-vous en tant qu’administrateur pour gérer le contenu.
