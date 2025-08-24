<?php

class LivreControler
{
    public function showHome() : void
    {
        $livreManager = new livreManager;
        $livres = $livreManager->getFourPicture();
        $view = new View("Accueil");
        $view->render("home", ['livres' => $livres]);
    }

    public function addNewLivre() : void
    {
        $keyiduser =utils::request('utilisateur');
        $view = new View("Nouveau Livre");
        $view->render("newUpdateLivreProfil", ['idkeyuser' => $keyiduser, 'titre'=>'Création de livre']);
    }
}