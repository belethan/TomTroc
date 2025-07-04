<?php
// En fonction des routes utilisées, il est possible d'avoir besoin de la session ; on la démarre dans tous les cas.
session_start();

// Ici on met les constantes utiles,
// les données de connexions à la bdd
// et tout ce qui sert à configurer.

//Chemin Principal
define('MAIN_PATH', './php/');
//Autres
define('MAIN_MODELS', MAIN_PATH . 'models/'); // Le chemin vers les models.
define('MAIN_CTRLS', MAIN_PATH . 'controllers/'); // Le chemin vers les contrôleurs.
define('MAIN_VIEWS', MAIN_PATH . 'views/'); // Le chemin vers les contrôleurs.
define('MAIN_SERVICES', MAIN_PATH . 'services/'); // Le chemin vers les contrôleurs.
//Chemin accès aux différentes informations
define('TEMPLATE_VIEW_PATH', MAIN_PATH.'views/templates/'); // Le chemin vers les templates de vues.
define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'model_page_main.php'); // Le chemin vers le template principal.



// Cpnnexion à la base de données login standard
define('DB_HOST', 'localhost');
define('DB_NAME', 'TOMTROC');
define('DB_USER', 'root');
define('DB_PASS', 'root');
