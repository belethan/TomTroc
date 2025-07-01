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
}