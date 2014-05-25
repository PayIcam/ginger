Ginger
======

Ginger est une application Web qui va permettre de récupérer l'association UID de la carte étudiante Icam à son étudiant Icam

Utilisation
===========

Ginger fonctionne sous le modèle des web services. Il suffit de rentrer la bonne URL et vous obtiendrez en retour le tableau Json des informations sur l'utilisateur souhaité

De plus, Ginger va ici intéroger une base de donnée dans laquelle seront stoqué les informations, à savoir UID - login utilisateur.

#### Recherche de l'utilisateur possédant le badge 12346578 :
`http://localhost/ginger/index.php/v1/badge/12345678?key=cleAuthentificationApp`

#### Recherche de l'utilisateur ayant le login prenom.nom@icam.fr
`http://localhost/ginger/index.php/v1/prenom.nom@icam.fr?key=cleAuthentificationApp`

#### Remarque sur la sécurité
Tout le monde ne peut pas utiliser Ginger, il faut être enregistré auprès de lui, à savoir avoir une entrée dans la base de donnée : une application et sa clé d'application. D'où le `?key=cleAuthentificationApp` à la fin de l'URL
