<?php
/**
 * Système d'autoload.
 * A chaque fois que PHP va avoir besoin d'une classe, il va appeler cette fonction
 * et chercher dans les divers dossiers (ici models, controllers, views, services) s'il trouve
 * un fichier avec le bon nom. Si c'est le cas, il l'inclut avec require_once.
 */
spl_autoload_register(function($className) {
    // On va voir dans le dossier Service si la classe existe.
    if (file_exists(MAIN_SERVICES . $className . '.php')) {
        require_once MAIN_SERVICES . $className . '.php';
    }

    // On va voir dans le dossier Model si la classe existe.
    if (file_exists(MAIN_MODELS . $className . '.php')) {
        require_once MAIN_MODELS . $className . '.php';
    }

    // On va voir dans le dossier Controller si la classe existe.
    if (file_exists(MAIN_CTRLS . $className . '.php')) {
        require_once MAIN_CTRLS . $className . '.php';
    }

    // On va voir dans le dossier View si la classe existe.
    if (file_exists(MAIN_VIEW_PATH . $className . '.php')) {
        require_once MAIN_VIEW_PATH . $className . '.php';
    }

    // On va voir dans le dossier View si la classe existe.
    if (file_exists(TEMPLATE_VIEW_PATH . $className . '.php')) {
        require_once TEMPLATE_VIEW_PATH . $className . '.php';
    }

});
