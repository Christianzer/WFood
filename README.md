# Comment utiliser

- Cloner le dépôt avec git clone https://github.com/Christianzer/Fodtest

## Backend

- Allez dans le sous-dossier cd foodBack
- Avoir au moins la version php 8
- Créer une base de données au nom de food dans phpMyAdmin
- Copiez le fichier .env.example dans .env et modifiez-y les informations d'identification de la base de données
- Exécuter composer install (Composer doit être installer sur votre machine)
- Exécuter php artisan key:generate
- Exécuter php artisan migrate --seed
- Exécuter php artisan serve et recupérer le port

## Frontend

- Allez dans le sous-dossier cd gfood
- Ouvrir le fichier src/main.js
- Remplacer baseURl par le port récuperer
- Revenir sur le dossier cd gfood
- Exécuter npm install
- Exécuter npm run serve

## Données de Test

- Salarié : email : christian@gmail.com , mot de passe : admin
- Administrateur :  email : cedric@gmail.com , mot de passe : admin 

