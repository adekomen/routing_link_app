# Projet de Gestion de Réseau de Routeurs

## LES MEMBRES DU GROUPE

1. ADESU Kokouvi
2. AYIDEDJI Florent
3. BOSSOU Gémisse
4. KPADJOUDA Enock




### Application de Gestion de Réseau de Routage à état de lien

Bienvenue dans l'application de gestion de réseau de routage à état de lien, une solution web complète pour la gestion et la visualisation des connexions de routeurs. Conçue avec Laravel, cette application permet d'ajouter des routeurs, de configurer leurs liens, de visualiser le réseau sous forme de graphe et de calculer les chemins les plus courts entre les routeurs.

#### Fonctionnalités Clés

Cette application offre les fonctionnalités suivantes pour gérer efficacement un réseau de routeurs :

- **Ajout de Routeurs** : Ajoutez un nombre défini de routeurs avec des noms uniques et personnalisables.
- **Connexion entre Routeurs** : Configurez les liens entre routeurs en définissant des coûts spécifiques pour chaque connexion.
- **Calcul des Chemins les Plus Courts (SPF)** : Visualisez les chemins les plus courts entre les routeurs grâce à l'algorithme Shortest Path First (SPF).
- **Visualisation Graphique du Réseau** : Affichez le réseau avec les routeurs et les connexions sous forme de graphe interactif avec D3.js.

#### Technologies Utilisées

- **Backend** : [Laravel 10](https://laravel.com/)
- **Frontend** : [Bootstrap 5](https://getbootstrap.com/) pour le style, 
[D3.js](https://d3js.org/) pour la visualisation graphique
- **Base de Données** : [MySQL](https://www.mysql.com/)

#### Installation et Configuration

Suivez les étapes ci-dessous pour configurer et exécuter l'application en local.


#### 1. Cloner le dépôt
git clone https://github.com/adekomen/routing_link_app.git
cd lien_routing_app

#### 2. Installer les dépendances
Assurez-vous d'avoir Composer et Node.js installés
composer install
npm install && npm run dev

#### 3. Configurer le fichier `.env`
Copier le fichier `.env.example` et le renommer en `.env`
cp .env.example .env

Configurer les paramètres de base de données dans le fichier `.env`
Modifiez `DB_DATABASE`, `DB_USERNAME`, et `DB_PASSWORD` selon votre configuration

#### 4. Générer la clé d'application
php artisan key:generate

#### 5. Migrer la base de données
php artisan migrate


##### Utilisation de l'Application
##### 1. Ajout de Routeurs
1. Accédez à la page d'accueil et entrez le nombre de routeurs à ajouter.
2. Remplissez le formulaire pour chaque routeur en veillant à utiliser des noms uniques de deux caractères.

##### 2. Configuration des Liens entre Routeurs
1. Après avoir ajouté les routeurs, configurez les liens entre eux.
2. Pour chaque lien, sélectionnez le routeur source, le routeur de destination, et attribuez un coût et aussi l'adresse du réseau dans lequel ils sont connectés.

##### 3. Visualisation et Calcul des Chemins les Plus Courts
1. Accédez à la page de visualisation graphique pour afficher le réseau de routeurs.
2. Cliquez sur un routeur pour afficher son arborescence SPF, indiquant les chemins les plus courts vers les autres routeurs avec les coûts associés.

##### 4. Structure des Routes et des Contrôleurs
Cette application repose sur trois contrôleurs principaux pour gérer les fonctionnalités de base :

###### 1. RouteurController
1. Assure l'unicité des noms de routeurs et limite leur longueur à deux caractères.
2. Supprime les anciens routeurs et liens avant de générer un nouveau réseau, assurant ainsi que le réseau actuel correspond toujours aux données fournies.

###### 2. SpfController
1. Calcule les chemins les plus courts entre un routeur source et les autres routeurs du réseau.
2. Génère les données pour la visualisation graphique et le calcul du coût des chemins les plus courts.

###### 3. LienController
1. Gestion des Connexions entre Routeurs :
Permet d'ajouter, éditer et supprimer des liens entre les routeurs en définissant le routeur source, le routeur de destination, et le coût du lien.
2. Validation et Unicité des Connexions :
Assure que chaque lien est valide avec des règles, comme l'unicité du routeur source et du routeur de destination et un coût minimal, pour maintenir l'intégrité des données du réseau.
3. Mises à Jour Dynamiques du Réseau :
Après chaque modification, le contrôleur met à jour la liste des connexions, assurant que l'utilisateur puisse visualiser et manipuler un réseau de routeurs actuel et cohérent.

###### Routes Principales
1. GET /routeurs : Affiche le formulaire d'ajout de routeurs.
2. POST /routeurs/store : Enregistre les nouveaux routeurs en supprimant les anciens pour redéfinir le réseau.
3. GET /liens : Affiche la liste des liens configurés et permet l'ajout de nouvelles connexions entre routeurs.
4. GET /spf/{sourceId} : Calcule et affiche les chemins les plus courts pour un routeur source donné.

### Contribution
Les contributions à ce projet sont les bienvenues ! Pour proposer une amélioration, signaler un problème ou soumettre une pull request, merci de passer par le dépôt GitHub du projet.

### A savoir
Ce guide vous fournit toutes les informations nécessaires pour utiliser et étendre l'application de gestion de réseau de routeurs. Pour des personnalisations avancées, n'hésitez pas à consulter la documentation de Laravel et de D3.js.