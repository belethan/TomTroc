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
        $mode=utils::request('mode');
        $view = new View("Nouveau Livre");
        $view->render("newUpdateLivreProfil", ['idkeyuser' => $keyiduser, 'titre'=>"Création d'un livre"]);
    }

    public function saveLivre() : void{
        $mode=utils::request('mode');
        //var_dump(' MODE = '.$mode);
        // Taille de $_POST (nombre d'éléments)
//        $taillePost = count($_POST);
//        var_dump('Taille de \$_POST : '. $taillePost . ' éléments\n');
//        $tailleRequest = count($_REQUEST);
//        var_dump('Taille de \$_REQUEST : '. $tailleRequest . ' éléments\n');

        if ($_POST['statut_Livre']=="indisponible") {
            $_POST['statut_Livre']=0;
        }
        else{
            $_POST['statut_Livre']=1;
        }
        var_dump($_POST);
        $livredata = new livre($_POST);
        var_dump($livredata);
        die;
        $livreManager = new livreManager;
        $livreManager->LivreSauvegarder($livredata);
    }

}