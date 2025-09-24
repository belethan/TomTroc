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

    public function showLivreReadOnly() : void{
        $livreManager = new livreManager;
        $livrework=$livreManager->getLivreById($_GET['keybook']);
        $dialogAuthorise = "Vous devez vous identifier pour envoyer un message" ;
        if (isset($_SESSION['user'])){
            $dialogAuthorise= $_SESSION['keyIdUser'] != $livrework->getIdUtilisateur() ? "" : "Vous ne pouvez pas vous envoyer un message !";
        }
        $view = new View("Détails d'un livre");
        $view->render("pagelivre", ['livre' => $livrework,'msgdial'=>$dialogAuthorise]);
    }


    public function addNewLivre() : void
    {
        $keyiduser =utils::request('utilisateur');
        $mode=utils::request('mode');
        $view = new View("Nouveau Livre");
        $view->render("newLivreProfil", ['idkeyuser' => $keyiduser, 'titre'=>"Création d'un livre"]);
    }

    public function editLivre() : void{
        $livreManager = new livreManager;
        $mode = utils::request('mode');
        $keydata = utils::request('keyinfo');
        $livrework=$livreManager->getLivreById($keydata);
        $view = new View("Editer le livre");
        $view->render("editUpdatelivre", ['livredata' => $livrework, 'titre'=>"Editer le livre", 'mode'=>$mode]);
    }

    public function saveLivre() : void{
        $mode=utils::request('mode');
        $livredata = new livre($_POST);
        $livreManager = new livreManager;
        if ($mode==1) {
            $livredata->setIdUtilisateur($_SESSION['keyIdUser']);
            $valueinit="../images/livre-neutre.png";
            $livredata->setphotoLivre($valueinit);
            $livreManager->LivreSauvegarder($livredata,$mode,-1);
        }
        if ($mode==2) {
            $idkey=utils::request('keylivre');
            $livreOrigine = $livreManager->getLivreById($idkey);
            $valueinit = $livreOrigine->getphotoLivre();
            $imglivre = utils::uploadImage($idkey, $valueinit, "LIVRE-");
            $livredata->setphotoLivre($imglivre);
            $livredata->setIdUtilisateur($_SESSION['keyIdUser']);
            $livreManager->LivreSauvegarder($livredata,$mode,$idkey);
        }

        /* affichage de la page profil utilisateur */
        header("Location: index.php?action=infouser");

    }

    public function livredelete() : void
    {
        $livreManager = new livreManager;
        $keydata = utils::request('keylivre');
        $livreManager->DelLivreByid($keydata);
        header("Location: index.php?action=infouser");
    }

    public function showAllLivre() : void{
        $livreManager = new livreManager;
        $filtre= utils::request('filtre') ?? '';
        $livres = $livreManager->getAllLivre($filtre);
        $view = new View("Nos livres");;
        $view->render("echangeBook", ['livredata' => $livres]);
    }
}