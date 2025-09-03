<?php

class AdminController
{
    /**
     * Checks if the user is connected. If not, redirects to the connection form.
     *
     * @return void
     */
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    public function loginUser(): void
    {
        // Initialisation du gestionnaire d'utilisateurs
        $userController = new UtilisateurManager();
        // Récupération sécurisée des données d'entrée
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_REQUEST['password'];

        // Vérification si les données sont renseignées
        if (!$email || !$password) {
            $_SESSION['error'] = "Veuillez renseigner les champs requis.";
            $this->displayConnectionForm();
            return;
        }

        // Validation du login par le gestionnaire
        $isAuthenticated = $userController->login($email, $password);

        if ($isAuthenticated) {
            // Authentification réussie
            $_SESSION['error'] = ""; // Réinitialisation du message d'erreur
            $view = new View("Accueil");
            $view->render("home");
        } else {
            // Erreur d'identifiants
            $_SESSION['error'] = "Identifiants incorrects.";
            //$this->displayConnectionForm();
            Utils::redirect("connectUser");

        }
    }



    /**
     * Creates a new user based on the provided data and attempts to add it to the system.
     *
     * @param array $data The data used to create the new user.
     * @return void
     */
    public function newUtilisateur(array $data) : void
    {
        $newUser= new Utilisateurs($data);
//        var_dump($newUser);
        $adduser= new UtilisateurManager();
        unset($_SESSION['user']);;
        if($adduser->AddUtilisateur($newUser)->errorCode()==='00000'){
            $_SESSION['keyIdUser']=$newUser->getId();
            $livreController = new livreControler;
            $livreController->showHome();
        }
    }

    /**
     * Connects the user by rendering the connection form view.
     *
     * @return void
     */
    public function displayConnectionForm() : void{
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Renders the registration form view.
     *
     * @return void
     */
    public function inscription() : void{
        $view = new View("Inscription");
        $view->render("inscriptionForm");;
    }

    public function disconnectUser() : void
    {
        // On déconnecte l'utilisateur.

        unset($_SESSION['user']);
        unset($_SESSION['keyIdUser']);;
       // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }

    public function profiluser() : void
    {
        $livreUser=new livreManager();
        $datalivre = $livreUser->getalluserLivre();
        $view = new View("Profil Utilisateur");
        $view->render("infoUserForm",['livres'=>$datalivre]);;
    }

    public function saveuser() : void
    {
        $UpdateData=new UtilisateurManager();
        utils::logsuccess("Vos modifications ont été enregistrées");
        if ($UpdateData->UpdateUser()->errorCode()!='00000') {
              utils::logError("erreur de sauvegarde SQL .". $UpdateData->UpdateUser()->errorInfo());
        }
        $view = new View("Profil Utilisateur");
        $view->render("infoUserForm");;
    }

}