# ECF STUDI Juin 2023
Le projet est un site de reservation de restaurant
Technologie utilisées :

## Partie gestion de projet:
- Trello pour la gestion globale du projet
- Visual Paradigm pour les diagramme de de classe et de sequences
- Figma pour les wireframes

## Partie developpement 
- HTMLS/CSS/JS 
- Symfony6 pour la partie back-end
- MySQL pour le gestion de la base de données

## Deploiment
- Projet deployer sur Hostinger
- Filezilla 
- Composer

La création de l'admin se fait comme suit :
Créé un utilisateur grace au formulaire d'inscription et faire la commande sql dans le terminal
UPDATE `user` SET `roles` = '[\"ROLE_ADMIN\"]' WHERE `user`.`id` = 1;
