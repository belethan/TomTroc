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

    /**
     * Creates a new user based on the provided data and attempts to add it to the system.
     *
     * @param array $data The data used to create the new user.
     * @return void
     */
    public function newUtilisateur(array $data) : void
    {
        $newUser= new Utilisateurs($data);
        $adduser= new UtilisateurManager();
        if($adduser->AddUtilisateur($newUser)->errorCode()==='00000'){
            Utils::redirect("home");
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

}