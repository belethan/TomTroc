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

    public function showLivre() : void{
        $livreManager = new livreManager;
        $livrework=$livreManager->getLivreById($_GET['id']);
        $view = new View("Editer le livre");
        $view->render("newUpdateLivreProfil", ['livrework' => $livrework, 'titre'=>"Editer le livre"]);
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
        $_POST['id_utilisateur']=$_SESSION['user']->getId();
//        var_dump($_FILES);
//        var_dump($_POST);
//        var_dump($_REQUEST);
        $valueinit=JS_IMAGE."livre-neutre.png";
        if ($mode==2) {
            $valueinit=$_POST['photo_Livre'];
        }
        $imglivre=utils::uploadImage($_POST['id_utilisateur'], $valueinit, "LIVRE-");
        $_POST['photo_Livre']=$imglivre;
        $livredata = new livre($_POST);
        $livreManager = new livreManager;
        $livreManager->LivreSauvegarder($livredata);

    }

}