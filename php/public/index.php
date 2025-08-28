<?php
require_once '../config/config.php';
require_once '../config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $livreController = new livreControler;
            $livreController->showHome();
            break;
        case 'connectUser':
            $adminController = new AdminController();
            $adminController->displayConnectionForm();
            break;
       case 'login':
           $userController = new AdminController();
           $userController->loginUser();
           break;
        case 'disconnectUser':
            $adminController = new AdminController();
            $adminController->disconnectUser();
            break;
        Case 'inscription' :
            $adminController = new AdminController();
            $adminController->inscription();
            break;
        Case 'newUtilisateur' :
               $adminController = new AdminController();
               $adminController->newUtilisateur($_REQUEST);;
                break;
        Case 'infouser' :
            $adminController = new AdminController();
            $adminController->profiluser();
            break;
        Case 'saveuser' :
            $adminController = new AdminController();
            $adminController->saveuser();
            break;
        Case 'newlivre' :
            $LivreController = new LivreControler();
            $LivreController->addNewLivre();
            break;
        Case 'livresave' :
            $LivreController = new LivreControler();
            $LivreController->saveLivre();
            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorMessage', ['errorMessage' => $e->getMessage()]);
}
